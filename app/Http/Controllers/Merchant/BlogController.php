<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Auth::user()->blogs()->latest()->paginate(10);
        //dd($blogs);
        return view('merchant.blogs.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Retrieve all categories to populate a dropdown in the form
        $categories = Category::all();
        //dd($categories);
        return view('merchant.blogs.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         // 2. Validation
        $request->validate([
            'title' => 'required|string|max:255',
            'quote' => 'nullable|string',
            'content' => 'required|string',
            'slug' => 'required|string|max:255|unique:blogs,slug',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:categories,id',
            // Add validation for product image/slug here
        ]);
        // 3. Create the product and link it to the current merchant (user)
        Auth::user()->blogs()->create([
            'title' => $request->title,
            'quote'=> $request->quote,
            'content' => $request->content, 
            'slug' => $request->slug,
            'image' => $request->image,
            'category_id' => $request->category_id,
        ]);
        //dd($request->all());
        // 4. Redirect to the dashboard with a success message
        return redirect()->route('merchant.blogs.index')->with('success', 'Blog created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        if ($blog->user_id !== Auth::id()) {
            abort(403, 'You are not authorized to view this blog.');
        }
        // Enforce ownership:
        // Abort if the blog does not belong to the current merchant
        
        //dd($product);
        return view('merchant.blogs.show', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
          // Enforce ownership: Abort if the blog does not belong to the current merchant
        if ($blog->user_id !== Auth::id()) {
            abort(403, 'You are not authorized to edit this blog.');
        }
        
        $categories = Category::all();

        return view('merchant.blogs.edit', compact('blog', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
         if ($blog->user_id !== Auth::id()) {
        abort(403, 'You are not authorized to update this blog.');
    }

    // Validation
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'quote' => 'nullable|string',
        'content' => 'required|string',
        'slug' => 'required|string|max:255|unique:blogs,slug',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        'category_id' => 'required|exists:categories,id',]);

    // Handle image upload if present
    if ($request->hasFile('image')) {
        // Delete old image if exists
        if ($blog->image) {
            Storage::delete('public/' . $blog->image);
        }
        $validated['image'] = $request->file('image')->store('blogs', 'public');
    }

    $blog->update($validated);

    return redirect()->route('merchant.blogs.index')
        ->with('success', 'Blog updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
         // Enforce ownership before deletion
        if ($blog->user_id !== Auth::id()) {
            abort(403);
        }

        $blog->delete();

        return redirect()->route('merchant.blogs.index')
                        ->with('success', 'Blog deleted successfully!');
    }
}
