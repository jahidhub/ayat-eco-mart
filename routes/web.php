<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HomeBannerController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SizeController;
use App\Models\HomeBanner;

Route::group(['prefix' => 'admin'], function () {
    Route::group(['middleware' => 'guest'], function () {
        Route::get('/signup', [AuthController::class, 'showSignupForm'])->name('admin.signup');
        Route::post('/signup', [AuthController::class, 'signupProcess'])->name('admin.signup.process');
        Route::get('/login', [AuthController::class, 'showLoginForm'])->name('admin.login');
        Route::post('/login', [AuthController::class, 'authentication'])->name('admin.login.process');
    });

    Route::group(['middleware' => 'auth'], function () {

        // DashboardController
        Route::get('delete-data/{id?}/{table?}', [DashboardController::class, 'delete'])->name('deleteData');
        Route::get('/dashboard', [DashboardController::class, 'showDashboard'])->name('admin.dashboard');

        // AuthController
        Route::get('/logout', [AuthController::class, 'logout'])->name('admin.logout');

        // ProfileController
        Route::get('/profile', [ProfileController::class, 'index'])->name('admin.profile');
        Route::POST('/profile/save', [ProfileController::class, 'store'])->name('admin.profile.save');


        // HomeBanner
        Route::get('/banner', [HomeBannerController::class, 'index'])->name('admin.home_banner');
        Route::POST('/banner/add', [HomeBannerController::class, 'store'])->name('admin.home_banner.store');


        Route::get('/products/sizes', [SizeController::class, 'index'])->name('admin.products.size.index');
        Route::POST('/products/sizes/add', [SizeController::class, 'store'])->name('admin.products.size.store');
    });
});






// Route::get('createAdmin', [authController::class, 'createAdmin'])->name('adminCreate');
