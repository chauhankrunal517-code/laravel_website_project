<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf;

class CheckoutController extends Controller
{
    // Checkout page
    public function index()
    {
        // Get cart items
        $items = DB::table('carts')
            ->where('session_id', session()->getId())
            ->get();

        // Calculate total
        $total = $items->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        // Check empty cart
        if ($items->isEmpty()) {
            return redirect()
                ->route('cart.index')
                ->with('error', 'Your cart is empty.');
        }

        // Support both variable names in payment.blade.php
        $cartItems = $items;

        // Send items and total to payment page
        return view('payment', compact('items', 'cartItems', 'total'));
    }

    // Alternative checkout method
    public function checkout()
    {
        return $this->index();
    }

    // Place Order
    public function placeOrder(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|digits:10',
            'address' => 'required|string|max:1000',
            'city' => 'required|string|max:100',
            'pincode' => 'required|digits:6',
            'payment_method' => 'required|in:upi,card,cod',
        ]);

        try {

            // Get cart items
            $cartItems = DB::table('carts')
                ->where('session_id', session()->getId())
                ->get();

            if ($cartItems->isEmpty()) {
                return back()
                    ->withInput()
                    ->with('error', 'Your cart is empty.');
            }

            // Prepare order items
            $items = $cartItems->map(function ($item) {

                return [
                    'name' => $item->name,
                    'price' => (float) $item->price,
                    'quantity' => (int) $item->quantity,
                    'subtotal' => (float) $item->price *
                        (int) $item->quantity,
                ];

            })->values()->all();

            // Calculate total
            $total = collect($items)->sum('subtotal');

            // Generate order number
            $orderNumber = 'GG' .
                now()->format('YmdHis') .
                random_int(100, 999);

            // Save order in database
            $orderId = DB::transaction(function () use (
                $validated,
                $items,
                $total,
                $orderNumber
            ) {

                $id = DB::table('orders')->insertGetId([

                    'order_number' => $orderNumber,
                    'user_id' => Auth::id(),
                    'session_id' => session()->getId(),

                    'customer_name' => $validated['customer_name'],
                    'email' => $validated['email'],
                    'phone' => $validated['phone'],

                    'address' => $validated['address'],
                    'city' => $validated['city'],
                    'pincode' => $validated['pincode'],

                    'items' => json_encode($items),
                    'total' => $total,

                    'payment_method' => $validated['payment_method'],
                    'payment_status' => 'Pending',
                    'order_status' => 'Pending',

                    'created_at' => now(),
                    'updated_at' => now(),

                ]);

                // Remove ordered items from cart
                DB::table('carts')
                    ->where('session_id', session()->getId())
                    ->delete();

                return $id;
            });

            // Get saved order
            $order = DB::table('orders')
                ->where('id', $orderId)
                ->first();

            if (!$order) {
                throw new \Exception('Order could not be found.');
            }

            // Convert JSON items into array
            $order->items = json_decode($order->items, true) ?? [];

            // Generate PDF and send email
            try {

                $pdf = Pdf::loadView(
                    'invoices.order',
                    ['order' => $order]
                )->setPaper('a4', 'portrait');

                $pdfContent = $pdf->output();

                Mail::send(
                    'emails.order-invoice',
                    ['order' => $order],
                    function ($message) use ($order, $pdfContent) {

                        $message->to($order->email);

                        $message->subject(
                            'GourmetGo - Order Invoice ' .
                            $order->order_number
                        );

                        $message->attachData(
                            $pdfContent,
                            'GourmetGo-Invoice-' .
                            $order->order_number . '.pdf',
                            [
                                'mime' => 'application/pdf'
                            ]
                        );
                    }
                );

                // Email successfully sent
                return redirect()
                    ->route('payment.success', ['id' => $orderId])
                    ->with(
                        'success',
                        'Your order was placed successfully. Invoice sent to your email.'
                    );

            } catch (\Throwable $emailError) {

                Log::error('GOURMETGO INVOICE EMAIL ERROR', [
                    'message' => $emailError->getMessage(),
                    'file' => $emailError->getFile(),
                    'line' => $emailError->getLine(),
                ]);

                // Order is already saved
                return redirect()
                    ->route('payment.success', ['id' => $orderId])
                    ->with(
                        'email_warning',
                        'Your order was saved, but the invoice email failed. Please check your email settings.'
                    );
            }

        } catch (\Throwable $e) {

            Log::error('GOURMETGO ORDER ERROR', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            return back()
                ->withInput()
                ->with(
                    'error',
                    'Unable to process your order. Please check the Laravel log.'
                );
        }
    }

    // Order Success
    public function success($id)
    {
        $order = DB::table('orders')
            ->where('id', $id)
            ->where('session_id', session()->getId())
            ->first();

        if (!$order) {
            abort(404);
        }

        $orderItems = json_decode($order->items, true) ?? [];

        return view(
            'payment-success',
            compact('order', 'orderItems')
        );
    }
}
