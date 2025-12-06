<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class CartServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            
            // جلب السلة من الجلسة
            $cart = Session::get('cart', []);
            
            // حساب إجمالي عدد العناصر (المنتجات وليس الوحدات)
            
            $total = 0;
            foreach ($cart as $item) {
                $total += $item['price'] * $item['qty'];
            }
            $cartCount = count($cart);
            
            // إرسال المتغيرات إلى جميع الـ views
            $view->with('cartCount', $cartCount);
            $view->with('total', $total);
            $view->with('cart', $cart);
        });
    }
}
