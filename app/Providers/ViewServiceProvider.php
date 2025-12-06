<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Category;


class ViewServiceProvider extends ServiceProvider
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
        //لاضافة الكود التالي في جميع المشروع دون استثناء 
        //View::share('categories', Category::all());

        //لاضافته في مكان محدد انا اللي احدده 
        View::composer(['site.layouts.app', 'welcome', 'site.blogs.index'], function ($view) {
            $view->with('categories', Category::all());
        });
    }
}
