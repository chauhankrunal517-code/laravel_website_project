<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    // Show food items in admin menu
    public function index()
    {
        $foods = Food::latest()->get();

        return view('admin.menu', compact('foods'));
    }

    // Save new food item
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'status' => 'required|in:Available,Unavailable',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imageName = null;

        if ($request->hasFile('image')) {
            $uploadPath = public_path('uploads/foods');

            if (!file_exists($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            $image = $request->file('image');

            $imageName = time() . '_' . uniqid() . '.' .
                $image->getClientOriginalExtension();

            $image->move($uploadPath, $imageName);
        }

        // Save food item in database
        Food::create([
            'name' => $request->name,
            'category' => $request->category,
            'price' => $request->price,
            'status' => $request->status,
            'description' => $request->description,
            'image' => $imageName,
        ]);

        // Redirect to admin dashboard
        return redirect()->route('admin.dashboard')
            ->with('success', 'Food item added successfully!');
    }

    // Delete food item
    public function destroy($id)
    {
        $food = Food::findOrFail($id);

        // Delete food image
        if (
            $food->image &&
            file_exists(public_path('uploads/foods/' . $food->image))
        ) {
            unlink(public_path('uploads/foods/' . $food->image));
        }

        // Delete food record
        $food->delete();

        // Redirect to admin dashboard
        return redirect()->route('admin.dashboard')
            ->with('success', 'Food item deleted successfully!');
    }
}
