<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/about', [App\Http\Controllers\aboutcontroller::class, 'index'])->name('about');
    
    // Rute yang diamankan dengan gate 'manage-product'
    Route::middleware('can:manage-product')->group(function () {
        Route::get('/kategori', function () {
            return 'Halaman Kategori (Hanya Admin)';
        })->name('kategori');

        Route::resource('product', \App\Http\Controllers\ProductController::class)->except(['show', 'destroy']);
    });
    Route::middleware('can:manage-category')->group(function () {
        Route::resource('category', \App\Http\Controllers\CategoryController::class);
    });
});

require __DIR__.'/auth.php';
