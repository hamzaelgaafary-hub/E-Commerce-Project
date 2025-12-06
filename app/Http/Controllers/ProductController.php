<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        $products = Product::with('category')->latest()->cursorPaginate(5);
        
        return view('site.products', compact('products', 'categories'));
    }

    /**
     * Display a single category.
     */

        public function category($id)
        {
            $categories = Category::all();
            $products = Product::where('category_id', $id)->with('category')->latest()->cursorPaginate(5);

            return view('site.category', compact('products', 'categories'));
        }

    /**
     * Display a single product
     */
    public function show(Product $product,string $id)
    {
        $product = Product::with('category')->findOrFail($id);
        //dd($product);
        return view('site.product', compact('product'));
    }

    /**
     * Create new product
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
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }


    public function search(Request $request)
    {
        // 1. استقبال كلمة البحث بعد تنظيفها من المسافات البيضاء
        $query = trim($request->input('query'));

        // 2. بناء الاستعلام على نموذج المنتج
        $products = Product::query();
        //dd($products);
        // 3. تطبيق شروط البحث
        if ($query) {
            // البحث عن تطابق جزئي باستخدام LIKE ومعامل %
            $products->where(function ($q) use ($query) {
                // البحث في حقل اسم المنتج
                $q->where('name', 'LIKE', "%{$query}%")
                  // أو البحث في حقل الوصف المختصر
                  ->orWhere('short_description', 'LIKE', "%{$query}%")
                  // يمكنك إضافة المزيد من الحقول (مثل SKU) هنا
                  ->orWhere('description', 'LIKE', "%{$query}%");
            });
        }
        
        // 4. جلب النتائج مع التصفح (Pagination)
        // إذا لم يتم إدخال استعلام، سيتم جلب جميع المنتجات مع التصفح.
        $products = $products->paginate(12)->withQueryString(); 
        
        // 5. تمرير النتائج إلى الواجهة (الـ view)
        return view('site.search', ['products' => $products]);
    }
    

}
