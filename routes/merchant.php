<?php

// routes/merchant.php
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\IsMerchant;
use App\Http\Controllers\Merchant\DashboardController;
use App\Http\Controllers\Merchant\ProductController;
use App\Http\Controllers\Merchant\BlogController;


use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group([
    'prefix' => LaravelLocalization::setLocale(), 
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']], 
    function() 
{
    Route::get('/merchant', function () {
        return "Welcome to the merchant Panel";
    });
            
    //برجاء تعديل الراوتس بداخل ملف التجار في البلايد لتشغيل ال  CRUD SYSTEM 

    Route::middleware( ['auth', IsMerchant::class])->prefix('merchant')->group(function () {
        // Dashboard Route
            Route::get('/dashboard', [DashboardController::class, 'index'])->name('merchant.dashboard');
        
        //Merchant Products Routes
            Route::resource('products', ProductController::class);    
         //Merchant Blogs Routes
            Route::resource('blogs', BlogController::class);     

            //please test if it will work Done
            //if we make dashboard controller make edit action.... بدل البروداكت كونترولر 
    });

});