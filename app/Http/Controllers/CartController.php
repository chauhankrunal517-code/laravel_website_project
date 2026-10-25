<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Product details are kept on the server so users cannot submit a changed price.
    private array $products = [
        'classic-burger' => [
            'name' => 'Classic Burger',
            'price' => 14.99,
            'image' => 'burger.png',
        ],
        'pizza' => [
            'name' => 'Pizza',
            'price' => 18.50,
            'image' => 'pizza.png',
        ],
        'sandwich' => [
            'name' => 'Sandwich',
            'price' => 22.00,
            'image' => 'sandwich.png',
        ],
        'chocolate-cake' => [
            'name' => 'Chocolate Cake',
            'price' => 8.99,
            'image' => 'Cake.png',
        ],
        'vada-pav' => [
            'name' => 'Vada Pav',
            'price' => 8.99,
            'image' => 'Vada.png',
        ],
        'dabeli' => [
            'name' => 'Dabeli',
            'price' => 8.99,
            'image' => 'Dabeli.png',
        ],
    ];

    public function index()
    {
        $items = CartItem::where('user_id', Auth::id())
            ->orderBy('created_at')
            ->get();

        $total = $items->sum(fn ($item) => $item->price * $item->quantity);

        return view('cart', compact('items', 'total'));
    }

    public function add(Request $request)
    {
        $data = $request->validate([
            'product_key' => 'required|string|in:classic-burger,pizza,sandwich,chocolate-cake,vada-pav,dabeli',
        ]);

        $product = $this->products[$data['product_key']];

        $item = CartItem::where('user_id', Auth::id())
            ->where('product_key', $data['product_key'])
            ->first();

        if ($item) {
            $item->increment('quantity');
        } else {
            CartItem::create([
                'user_id' => Auth::id(),
                'product_key' => $data['product_key'],
                'name' => $product['name'],
                'price' => $product['price'],
                'image' => $product['image'],
                'quantity' => 1,
            ]);
        }

        return back()->with('success', $product['name'] . ' added to your cart.');
    }

    public function update(Request $request, CartItem $cartItem)
    {
        abort_unless($cartItem->user_id === Auth::id(), 403);

        $data = $request->validate([
            'quantity' => 'required|integer|min:1|max:99',
        ]);

        $cartItem->update(['quantity' => $data['quantity']]);

        return redirect()->route('cart.index')->with('success', 'Cart quantity updated.');
    }

    public function remove(CartItem $cartItem)
    {
        abort_unless($cartItem->user_id === Auth::id(), 403);

        $cartItem->delete();

        return redirect()->route('cart.index')->with('success', 'Item removed from cart.');
    }
}
