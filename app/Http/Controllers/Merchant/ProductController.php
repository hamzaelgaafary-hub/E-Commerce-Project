<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    
    public function index()
    {
        $products = Auth::user()->products()->latest()->paginate(10);
        //dd($products);
        return view('merchant.dashboard', compact('products'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Retrieve all categories to populate a dropdown in the form
        $categories = Category::all();
        //dd($categories);
        return view('merchant.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 2. Validation
        $request->validate([
            'name' => 'required|string|max:255',
            'trend' => 'required|integer|min:0|max:1',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0.01',
            'qty' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            // Add validation for product image/slug here
        ]);
        // 3. Create the product and link it to the current merchant (user)
        Auth::user()->products()->create([
            'name' => $request->name,
            'trend'=> $request->trend,
            'slug' => str()->slug($request->name), // Simple slug generation
            'description' => $request->description,
            'price' => $request->price,
            'qty' => $request->qty,
            'category_id' => $request->category_id,
            'image' => $request->image,
        ]);
        // 4. Redirect to the dashboard with a success message
        return redirect()->route('merchant.dashboard')->with('success', 'Product created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        if ($product->user_id !== Auth::id()) {
            abort(403, 'You are not authorized to edit this product.');
        }
        // Enforce ownership:
        // Abort if the product does not belong to the current merchant
        
        //dd($product);
        return view('merchant.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        // Enforce ownership: Abort if the product does not belong to the current merchant
        if ($product->user_id !== Auth::id()) {
            abort(403, 'You are not authorized to edit this product.');
        }
        
        $categories = Category::all();

        return view('merchant.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
    */

    public function update(Request $request, Product $product)
{
    // Authorization check
    if ($product->user_id !== Auth::id()) {
        abort(403, 'You are not authorized to update this product.');
    }

    // Validation
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'price' => 'required|numeric|min:0',
        'qty' => 'required|integer|min:0',
        'category_id' => 'required|exists:categories,id',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'trend' => 'boolean',
        'short_description' => 'nullable|string|max:255',
    ]);

    // Handle image upload if present
    if ($request->hasFile('image')) {
        // Delete old image if exists
        if ($product->image) {
            Storage::delete('public/' . $product->image);
        }
        $validated['image'] = $request->file('image')->store('products', 'public');
    }

    $product->update($validated);

    return redirect()->route('merchant.dashboard')
        ->with('success', 'Product updated successfully');
}
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product )
    {
        // Enforce ownership before deletion
        if ($product->user_id !== Auth::id()) {
            abort(403);
        }

        $product->delete();

        return redirect()->route('merchant.dashboard')
                        ->with('success', 'Product deleted successfully!');
    }
}
