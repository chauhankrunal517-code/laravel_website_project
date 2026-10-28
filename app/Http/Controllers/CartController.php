<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Food;

class CartController extends Controller
{
    /**
     * Hardcoded products shown on the Offers page.
     * Menu products are still loaded from the foods table using food_id.
     */
    private array $offerProducts = [
        'premium-truffle-burger' => [
            'name' => 'Premium Truffle Burger',
            'price' => 145,
            'image' => 'burger.png',
        ],
        'spicy-zinger' => [
            'name' => 'Spicy Zinger',
            'price' => 145,
            'image' => 'Zinger.png',
        ],
        'classic-double' => [
            'name' => 'Classic Double',
            'price' => 135,
            'image' => 'casual-double.png',
        ],
        'garden-burger' => [
            'name' => 'The Garden Burger',
            'price' => 130,
            'image' => 'burger.png',
        ],
        'bbq-bacon-king' => [
            'name' => 'BBQ Bacon King',
            'price' => 200,
            'image' => 'bbq-bacon.png',
        ],
    ];

    // Display cart items
    public function index()
    {
        $items = DB::table('carts')
            ->where('session_id', session()->getId())
            ->orderBy('id')
            ->get();

        foreach ($items as $item) {
            $image = $item->image ?: 'burger.png';

            // For food items added from the database menu, use the latest food image.
            if (ctype_digit((string) $item->product_key)) {
                $food = Food::find((int) $item->product_key);

                if ($food && !empty($food->image)) {
                    $image = $food->image;
                }
            }

            $imageName = basename($image);
            $possiblePaths = [
                ltrim($image, '/'),
                'uploads/foods/' . $imageName,
                $imageName,
            ];

            $item->image_url = asset('burger.png');

            foreach (array_unique($possiblePaths) as $path) {
                if (is_file(public_path($path))) {
                    $item->image_url = asset($path);
                    break;
                }
            }
        }

        $total = $items->sum(function ($item) {
            return (float) $item->price * (int) $item->quantity;
        });

        return view('cart', compact('items', 'total'));
    }

    // Add a database food or a hardcoded Offers-page product to cart
    public function add(Request $request)
    {
        $request->validate([
            'food_id' => 'nullable|integer|min:1',
            'offer_key' => 'nullable|string|in:premium-truffle-burger,spicy-zinger,classic-double,garden-burger,bbq-bacon-king',
            'quantity' => 'required|integer|min:1|max:99',
        ]);

        if (!$request->filled('food_id') && !$request->filled('offer_key')) {
            return back()->withErrors([
                'food' => 'Please select a food item.',
            ]);
        }

        $quantity = (int) $request->input('quantity', 1);
        $sessionId = session()->getId();

        if ($request->filled('food_id')) {
            $food = Food::where('status', 'Available')
                ->find($request->integer('food_id'));

            if (!$food) {
                return back()->withErrors([
                    'food' => 'This food item is not available.',
                ]);
            }

            $productKey = (string) $food->id;
            $name = $food->name;
            $price = $food->price;
            $image = $food->image ?: 'burger.png';

            if (!empty($food->image)) {
                $imageName = basename($food->image);

                if (is_file(public_path('uploads/foods/' . $imageName))) {
                    $image = 'uploads/foods/' . $imageName;
                } elseif (is_file(public_path(ltrim($food->image, '/')))) {
                    $image = ltrim($food->image, '/');
                } else {
                    $image = 'burger.png';
                }
            }
        } else {
            $productKey = $request->string('offer_key')->toString();
            $product = $this->offerProducts[$productKey];

            $name = $product['name'];
            $price = $product['price'];
            $image = $product['image'];

            if (!is_file(public_path($image))) {
                $image = 'burger.png';
            }
        }

        $item = DB::table('carts')
            ->where('session_id', $sessionId)
            ->where('product_key', $productKey)
            ->first();

        if ($item) {
            $newQuantity = (int) $item->quantity + $quantity;

            if ($newQuantity > 99) {
                return back()->withErrors([
                    'quantity' => 'The maximum quantity for one item is 99.',
                ]);
            }

            DB::table('carts')
                ->where('id', $item->id)
                ->where('session_id', $sessionId)
                ->update([
                    'quantity' => $newQuantity,
                    'name' => $name,
                    'price' => $price,
                    'image' => $image,
                    'updated_at' => now(),
                ]);
        } else {
            DB::table('carts')->insert([
                'session_id' => $sessionId,
                'product_key' => $productKey,
                'name' => $name,
                'price' => $price,
                'image' => $image,
                'quantity' => $quantity,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return back()->with('success', $name . ' added to your cart!');
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
                ->withErrors(['cart' => 'Cart item not found.']);
        }

        DB::table('carts')
            ->where('id', $id)
            ->where('session_id', $sessionId)
            ->update([
                'quantity' => (int) $request->quantity,
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
