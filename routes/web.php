<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\siteController;
use App\Http\Controllers\blogsController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;


//site main Pages
Route::get('/', [siteController::class, 'index'])->name('index');
Route::get('/contact', [siteController::class, 'contact'])->name('site.contact');
Route::get('/about', [siteController::class, 'about'])->name('site.about');
Route::get('/category/{id}', [siteController::class, 'category'])->name('site.category');

//blogs Routes
Route::get('/blogs', [blogsController::class, 'index'])->name('site.blogs.index');
Route::get('/blog/{id}', [blogsController::class, 'show'])->name('site.blogs.show');

//search routes
//Route::get('/search/{q}', SearchController::class)->name('site.search');


Route::get('/search', [ProductController::class, 'search'])->name('products.search');


//cart routes
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
Route::delete('/cart/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::put('/cart/{id}', [CartController::class, 'update'])->name('cart.update');

//checkout routes
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'placeOrder'])->name('checkout.placeOrder');
Route::get('/order/confirmation/{order}', [CheckoutController::class, 'confirmation'])->name('order.confirmation');

//site products
Route::get('/products', [ProductController::class, 'index'])->name('site.products');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('site.product');

//admin products
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
