<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class siteController extends Controller
{

    public function __construct()
    {
        $categories = Category::all();
    }
    /*
    Home page
    */
    public function index()
    {
        $products = Product::with('category')->latest()->cursorPaginate(5);
        //$categories = Category::all();
        //dd($products);
        //dd($categories);
        return view('welcome', compact('products'));
    }
    /*
    About page
    */
    public function about()
    {
        return view('site.about');
    }
    /*
    Contact page
    */
    public function contact()
    {
        return view('site.contact');
    }

    /*
    checkout page
    */
    public function checkout()
    {
        return 'test checkout page';
    }

    /*
    order page
    */
    public function order()
    {
        return 'test Orders page';
    }

    /*
    Category page
    */
    public function category($id)
    {
        $categories = Category::all();
        $products = Product::where('category_id', $id)->with('category')->latest()->cursorPaginate(5);
        
        return view('site.category', compact('products', 'categories'));
    }
}
