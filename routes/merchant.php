<?php

// routes/merchant.php
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\IsMerchant;
use App\Http\Controllers\Merchant\DashboardController;
use App\Http\Controllers\Merchant\ProductController;


Route::get('/merchant', function () {
    return "Welcome to the merchant Panel";
});


        
//برجاء تعديل الراوتس بداخل ملف التجار في البلايد لتشغيل ال  CRUD SYSTEM 

Route::middleware( ['auth', IsMerchant::class])->prefix('merchant')->group(function () {
        // Product Routes
        Route::resource('products', ProductController::class);



        Route::get('/merchant/dashboard', [ProductController::class, 'index'])->name('merchant.dashboard');
        
        //please test if it will work if we make dashboard controller make edit action.... بدل البروداكت كونترولر 
});
