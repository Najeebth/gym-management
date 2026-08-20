<?php

use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\WebsiteController as AdminWebsiteController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/membership-plans', [PageController::class, 'membershipPlans'])->name('membership-plans');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    Route::resource('clients', ClientController::class);

    Route::prefix('website')->name('website.')->group(function () {
        Route::get('/', [AdminWebsiteController::class, 'index'])->name('index');
        Route::get('/home', [AdminWebsiteController::class, 'home'])->name('home');
        Route::get('/about', [AdminWebsiteController::class, 'about'])->name('about');
        Route::get('/contact', [AdminWebsiteController::class, 'contact'])->name('contact');
        Route::get('/footer', [AdminWebsiteController::class, 'footer'])->name('footer');
        Route::get('/navigation', [AdminWebsiteController::class, 'navigation'])->name('navigation');
        Route::get('/membership-plans', [AdminWebsiteController::class, 'membershipPlans'])->name('membership-plans');
    });
});

require __DIR__.'/auth.php';
