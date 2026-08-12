<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\ProductController as PublicProductController;
use App\Http\Controllers\Admin\ProductCategoryController as AdminProductCategoryController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\ProductBadgeController as AdminProductBadgeController;

/*
|--------------------------------------------------------------------------
| Public Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/produk', [PublicProductController::class, 'index'])->name('produk');

Route::get('/tentang', function () {
    return view('public.tentang');
})->name('tentang');

Route::get('/outlet', function () {
    return view('public.outlet');
})->name('outlet');

/*
|--------------------------------------------------------------------------
| Admin CMS Routes
|--------------------------------------------------------------------------
*/
Route::get('/admin', function () {
    return redirect()->route('admin.dashboard');
})->name('admin.login');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', function () {
        return view('admin.login');
    })->name('login');

    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    });

    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Admin Product Category Routes
    Route::get('/kategori', [AdminProductCategoryController::class, 'index'])->name('kategori');
    Route::post('/kategori', [AdminProductCategoryController::class, 'store'])->name('kategori.store');
    Route::put('/kategori/{category}', [AdminProductCategoryController::class, 'update'])->name('kategori.update');
    Route::delete('/kategori/{category}', [AdminProductCategoryController::class, 'destroy'])->name('kategori.destroy');

    // Admin Product Badge Routes
    Route::get('/badge', [AdminProductBadgeController::class, 'index'])->name('badge');
    Route::post('/badge', [AdminProductBadgeController::class, 'store'])->name('badge.store');
    Route::put('/badge/{badge}', [AdminProductBadgeController::class, 'update'])->name('badge.update');
    Route::delete('/badge/{badge}', [AdminProductBadgeController::class, 'destroy'])->name('badge.destroy');

    // Admin Product Routes
    Route::get('/produk', [AdminProductController::class, 'index'])->name('produk');
    Route::post('/produk', [AdminProductController::class, 'store'])->name('produk.store');
    Route::put('/produk/{product}', [AdminProductController::class, 'update'])->name('produk.update');
    Route::delete('/produk/{product}', [AdminProductController::class, 'destroy'])->name('produk.destroy');

    Route::get('/banner', function () {
        return view('admin.banner');
    })->name('banner');

    Route::get('/outlet', function () {
        return view('admin.outlet');
    })->name('outlet');

    Route::get('/tentang', function () {
        return view('admin.tentang');
    })->name('tentang');

    Route::get('/pengguna', function () {
        return view('admin.pengguna');
    })->name('pengguna');
});
