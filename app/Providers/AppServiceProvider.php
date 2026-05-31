<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Category;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        
        view()->composer(['layouts.app','site.layouts.app', 'cart.*', 'checkout.*'], function ($view) {
            // Cart
            $cart      = session()->get('cart', []);
            $cartCount = collect($cart)->sum('qty');
            $total     = collect($cart)->sum(fn($item) => $item['price'] * $item['qty']);

            // Categories — مستخدمة في الـ navbar والـ search
            $categories = Category::select(['id', 'name', 'slug'])
                ->where('is_active', true)
                ->get();

            $view->with(compact('cart', 'cartCount', 'total', 'categories'));
        });
        
    }
}
