<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class CheckoutController extends Controller
{
    // Show payment page
    public function index()
    {
        $items = DB::table('carts')
            ->where('session_id', session()->getId())
            ->orderBy('id')
            ->get();

        if ($items->isEmpty()) {
            return redirect()->route('cart.index')
                ->withErrors(['cart' => 'Your cart is empty.']);
        }

        $total = 0;

        foreach ($items as $item) {
            $total += $item->price * $item->quantity;

            $image = $item->image ?? '';

            if ($image && file_exists(public_path('uploads/foods/' . basename($image)))) {
                $item->image_url = asset('uploads/foods/' . basename($image));
            } else {
                $item->image_url = asset('burger.png');
            }
        }

        return view('payment', compact('items', 'total'));
    }


    // Save order and process demo payment
    public function placeOrder(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_name' => 'required|string|max:255',
            'phone' => 'required|digits:10',
            'address' => 'required|string|max:1000',
            'city' => 'required|string|max:100',
            'pincode' => 'required|digits:6',

            'payment_method' => 'required|in:upi_demo,card_demo,cod',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        try {

            $orderId = DB::transaction(function () use ($request) {

                // Get current user's cart
                $cartItems = DB::table('carts')
                    ->where('session_id', session()->getId())
                    ->orderBy('id')
                    ->lockForUpdate()
                    ->get();

                if ($cartItems->isEmpty()) {
                    throw new \Exception('Your cart is empty.');
                }

                // Calculate total
                $total = 0;
                $orderItems = [];

                foreach ($cartItems as $item) {

                    $subtotal = $item->price * $item->quantity;
                    $total += $subtotal;

                    $image = $item->image ?? '';

                    if ($image && file_exists(public_path('uploads/foods/' . basename($image)))) {
                        $imageUrl = asset('uploads/foods/' . basename($image));
                    } else {
                        $imageUrl = asset('burger.png');
                    }

                    $orderItems[] = [
                        'product_key' => $item->product_key,
                        'name' => $item->name,
                        'price' => $item->price,
                        'quantity' => $item->quantity,
                        'subtotal' => $subtotal,
                        'image_url' => $imageUrl,
                    ];
                }

                // Demo payment status
                if ($request->payment_method === 'cod') {
                    $paymentMethod = 'Cash on Delivery';
                    $paymentStatus = 'Pending';
                    $paymentReference = null;
                } else {
                    $paymentMethod = $request->payment_method === 'upi_demo'
                        ? 'UPI Demo'
                        : 'Card Demo';

                    $paymentStatus = 'Paid (Demo)';

                    $paymentReference = 'DEMO-' . strtoupper(Str::random(10));
                }

                // Generate order number
                $orderNumber = 'GG-' . date('Ymd') . '-' . strtoupper(Str::random(6));

                // Insert order into database
                $orderId = DB::table('orders')->insertGetId([
                    'order_number' => $orderNumber,

                    'user_id' => Auth::id(),
                    'session_id' => session()->getId(),

                    'customer_name' => $request->customer_name,
                    'phone' => $request->phone,
                    'address' => $request->address,
                    'city' => $request->city,
                    'pincode' => $request->pincode,

                    'items' => json_encode($orderItems),
                    'total' => $total,

                    'payment_method' => $paymentMethod,
                    'payment_status' => $paymentStatus,
                    'payment_reference' => $paymentReference,

                    'order_status' => 'Confirmed',

                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                // Clear cart after saving order
                DB::table('carts')
                    ->where('session_id', session()->getId())
                    ->delete();

                return $orderId;
            });

            return redirect()->route('payment.success', $orderId)
                ->with('success', 'Your order has been placed successfully!');

        } catch (\Throwable $e) {

            report($e);

            return back()
                ->withErrors(['payment' => $e->getMessage()])
                ->withInput();
        }
    }


    // Show payment success page
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

        return view('payment-success', compact('order', 'orderItems'));
    }
}
