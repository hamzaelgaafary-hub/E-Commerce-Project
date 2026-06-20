<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Product;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        //dd($categories);
        return view('site.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category): View
    {
        // استدعاء المنتجات الرائجة الخاصة بهذا القسم فقط من قاعدة البيانات
        $category->load('products');
        $trendingProducts = $category->products()
            ->trend('1') // Assuming 'trend' is a scope defined in the Product model
            ->latest()
            ->cursorPaginate(5);

        return view('site.category.show', [
            'category' => $category,
            'products' => $trendingProducts,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
}
