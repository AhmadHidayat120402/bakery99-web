<?php

use App\Http\Controllers\Admin\BannerController as AdminBannerController;
use App\Http\Controllers\Admin\ProductBadgeController as AdminProductBadgeController;
use App\Http\Controllers\Admin\ProductCategoryController as AdminProductCategoryController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\ProductController as PublicProductController;
use App\Http\Controllers\Public\SitemapController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

// Batch Image Compression Utility Route
// Route::get('/resize', [App\Http\Controllers\ImageResizeController::class, 'resizeAll'])->name('resize');

/*
|--------------------------------------------------------------------------
| Admin CMS Routes
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('admin.login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('admin.login.process');

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');

Route::middleware('auth')
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {


        Route::get('/', function () {
            return redirect()->route('admin.dashboard');
        });

        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        // Admin Banner Routes
        Route::get('/banner', [AdminBannerController::class, 'index'])->name('banner');
        Route::post('/banner', [AdminBannerController::class, 'store'])->name('banner.store');
        Route::post('/banner/reorder', [AdminBannerController::class, 'reorder'])->name('banner.reorder');
        Route::put('/banner/{banner}', [AdminBannerController::class, 'update'])->name('banner.update');
        Route::delete('/banner/{banner}', [AdminBannerController::class, 'destroy'])->name('banner.destroy');

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
        Route::post('/produk/reorder', [AdminProductController::class, 'reorder'])->name('produk.reorder');
        Route::post('/produk/{product}/toggle-featured', [AdminProductController::class, 'toggleFeatured'])->name('produk.toggle-featured');
        Route::put('/produk/{product}', [AdminProductController::class, 'update'])->name('produk.update');
        Route::delete('/produk/{product}', [AdminProductController::class, 'destroy'])->name('produk.destroy');

        Route::get('/outlet', function () {
            return view('admin.outlet');
        })->name('outlet');

        Route::get('/tentang', function () {
            return view('admin.tentang');
        })->name('tentang');

        // Admin User Routes
        Route::get('/pengguna', [UserController::class, 'index'])->name('pengguna');
        Route::post('/pengguna', [UserController::class, 'store'])->name('pengguna.store');
        Route::put('/pengguna/{user}', [UserController::class, 'update'])->name('pengguna.update');
        Route::delete('/pengguna/{user}', [UserController::class, 'destroy'])->name('pengguna.destroy');
    });
