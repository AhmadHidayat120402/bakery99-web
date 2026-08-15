<?php

use App\Http\Controllers\Admin\AboutContentController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BannerController as AdminBannerController;
use App\Http\Controllers\Admin\ProductBadgeController as AdminProductBadgeController;
use App\Http\Controllers\Admin\ProductCategoryController as AdminProductCategoryController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\OutletController;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\ProductController as PublicProductController;
use App\Http\Controllers\Public\SitemapController;
use App\Models\AboutContent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashboardController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/produk', [PublicProductController::class, 'index'])->name('produk');

Route::get('/tentang', function () {
    $about = AboutContent::first();
    $activeOutlets = \App\Models\Outlet::where('is_active', true)->get();
    $outletsCount = $activeOutlets->count();
    $outletNames = $activeOutlets->pluck('name')->implode(' & ');

    return view('public.tentang', compact('about', 'outletsCount', 'outletNames'));
})->name('tentang');

Route::get('/outlet', [App\Http\Controllers\Public\OutletController::class, 'index'])
    ->name('outlet');

Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

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

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

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

        Route::get('/outlet', [OutletController::class, 'index'])
            ->name('outlets.index');

        Route::post('/outlet', [OutletController::class, 'store'])
            ->name('outlets.store');

        Route::put('/outlet/{outlet}', [OutletController::class, 'update'])
            ->name('outlets.update');

        Route::delete('/outlet/{outlet}', [OutletController::class, 'destroy'])
            ->name('outlets.destroy');

        Route::get('/about', [AboutContentController::class, 'index'])
            ->name('about.index');

        Route::post('/about', [AboutContentController::class, 'store'])
            ->name('about.store');

        Route::put('/about/{id}', [AboutContentController::class, 'update'])
            ->name('about.update');

        // Admin User Routes
        Route::get('/pengguna', [UserController::class, 'index'])->name('pengguna');
        Route::post('/pengguna', [UserController::class, 'store'])->name('pengguna.store');
        Route::put('/pengguna/{user}', [UserController::class, 'update'])->name('pengguna.update');
        Route::delete('/pengguna/{user}', [UserController::class, 'destroy'])->name('pengguna.destroy');
    });
