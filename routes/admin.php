<?php

// routes/admin.php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;



Route::get('/admin', function () {
    return "Welcome to the Admin Panel";
});


Route::middleware(['auth', 'is.admin'])->prefix('admin')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('/users', UserController::class);
    // ... all other admin routes go here

});
