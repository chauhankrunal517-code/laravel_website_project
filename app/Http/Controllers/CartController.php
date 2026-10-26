<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    private $products = [
        'classic-burger' => [
            'name' => 'Classic Burger',
            'price' => 130,
            'image' => 'burger.png'
        ],
        'pizza' => [
            'name' => 'Pizza',
            'price' => 163,
            'image' => 'pizza.png'
        ],
        'sandwich' => [
            'name' => 'Sandwich',
            'price' => 135,
            'image' => 'sandwich.png'
        ],
        'chocolate-cake' => [
            'name' => 'Chocolate Cake',
            'price' => 191,
            'image' => 'Cake.png'
        ],
        'vada-pav' => [
            'name' => 'Vada Pav',
            'price' => 120,
            'image' => 'Vada.png'
        ],
        'dabeli' => [
            'name' => 'Dabeli',
            'price' => 130,
            'image' => 'Dabeli.png'
        ],
    ];

    public function index()
    {
        $items = DB::table('carts')
            ->where('session_id', session()->getId())
            ->orderBy('id')
            ->get();

        $total = $items->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        return view('cart', compact('items', 'total'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_key' => 'required|string'
        ]);

        $key = $request->product_key;

        if (!isset($this->products[$key])) {
            return back()->withErrors([
                'product_key' => 'Invalid food item.'
            ]);
        }

        $product = $this->products[$key];
        $sessionId = session()->getId();

        $item = DB::table('carts')
            ->where('session_id', $sessionId)
            ->where('product_key', $key)
            ->first();

        if ($item) {
            if ($item->quantity >= 99) {
                return back()->withErrors([
                    'quantity' => 'Maximum quantity is 99.'
                ]);
            }

            DB::table('carts')
                ->where('id', $item->id)
                ->increment('quantity');
        } else {
            DB::table('carts')->insert([
                'session_id' => $sessionId,
                'product_key' => $key,
                'name' => $product['name'],
                'price' => $product['price'],
                'image' => $product['image'],
                'quantity' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return back()->with(
            'success',
            $product['name'] . ' added to your cart!'
        );
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:99'
        ]);

        DB::table('carts')
            ->where('id', $id)
            ->where('session_id', session()->getId())
            ->update([
                'quantity' => $request->quantity,
                'updated_at' => now(),
            ]);

        return redirect()->route('cart.index')
            ->with('success', 'Cart quantity updated!');
    }

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