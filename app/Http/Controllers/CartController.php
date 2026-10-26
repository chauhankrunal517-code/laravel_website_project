<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Food;

class CartController extends Controller
{
    // Display cart items
    public function index()
    {
        $items = DB::table('carts')
            ->where('session_id', session()->getId())
            ->orderBy('id')
            ->get();

        // Resolve the correct image URL for each cart item
        foreach ($items as $item) {
            $image = $item->image ?? null;

            // Use the food table image when available
            if (!empty($item->product_key)) {
                $food = Food::find($item->product_key);

                if ($food && !empty($food->image)) {
                    $image = $food->image;
                }
            }

            $item->image_url = asset('burger.png');

            if (!empty($image)) {
                $imageName = basename($image);

                $possiblePaths = [
                    'uploads/foods/' . $imageName,
                    ltrim($image, '/'),
                ];

                foreach (array_unique($possiblePaths) as $path) {
                    if (file_exists(public_path($path))) {
                        $item->image_url = asset($path);
                        break;
                    }
                }
            }
        }

        $total = $items->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        return view('cart', compact('items', 'total'));
    }

    // Add food to cart
    public function add(Request $request)
    {
        $request->validate([
            'food_id' => 'required|integer|min:1',
        ]);

        $food = Food::where('status', 'Available')
            ->find($request->food_id);

        if (!$food) {
            return back()->withErrors([
                'food' => 'Invalid food item.',
            ]);
        }

        $sessionId = session()->getId();

        $item = DB::table('carts')
            ->where('session_id', $sessionId)
            ->where('product_key', (string) $food->id)
            ->first();

        // Find the image path used by the admin menu
        $imagePath = null;

        if (!empty($food->image)) {
            $imageName = basename($food->image);

            if (file_exists(public_path('uploads/foods/' . $imageName))) {
                $imagePath = 'uploads/foods/' . $imageName;
            } elseif (file_exists(public_path($food->image))) {
                $imagePath = ltrim($food->image, '/');
            }
        }

        if ($item) {
            if ($item->quantity >= 99) {
                return back()->withErrors([
                    'quantity' => 'Maximum quantity is 99.',
                ]);
            }

            DB::table('carts')
                ->where('id', $item->id)
                ->where('session_id', $sessionId)
                ->update([
                    'quantity' => $item->quantity + 1,
                    'image' => $imagePath,
                    'updated_at' => now(),
                ]);

        } else {
            DB::table('carts')->insert([
                'session_id' => $sessionId,
                'product_key' => (string) $food->id,
                'name' => $food->name,
                'price' => $food->price,
                'image' => $imagePath,
                'quantity' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return back()->with(
            'success',
            $food->name . ' added to your cart!'
        );
    }

    // Update cart quantity
    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:99',
        ]);

        $sessionId = session()->getId();

        $item = DB::table('carts')
            ->where('id', $id)
            ->where('session_id', $sessionId)
            ->first();

        if (!$item) {
            return redirect()->route('cart.index')
                ->withErrors([
                    'cart' => 'Cart item not found.',
                ]);
        }

        DB::table('carts')
            ->where('id', $id)
            ->where('session_id', $sessionId)
            ->update([
                'quantity' => $request->quantity,
                'updated_at' => now(),
            ]);

        return redirect()->route('cart.index')
            ->with('success', 'Cart quantity updated!');
    }

    // Remove item from cart
    public function remove($id)
    {
        DB::table('carts')
            ->where('id', $id)
            ->where('session_id', session()->getId())
            ->delete();

        return redirect()->route('cart.index')
            ->with('success', 'Item removed from your cart!');
    }
}
