<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\blog;
use App\Models\Category;

class blogsController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth')->except('index', 'show');
        //$categories = Category::all();
        //dd($categories);

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = blog::latest()->cursorPaginate(5);
        //dd($blogs);
        return view('site.blogs.index', compact('blogs'));
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
    public function show(string $id)
    {
        $blogs = blog::findOrFail($id);
        //$categories = Category::all();
        //dd($categories);
        //dd($blogs);
        return view('site.blogs.show', compact('blogs'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
