<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('public.home');
})->name('home');

Route::get('/produk', function () {
    return view('public.produk');
})->name('produk');

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

    Route::get('/banner', function () {
        return view('admin.banner');
    })->name('banner');

    Route::get('/tentang', function () {
        return view('admin.tentang');
    })->name('tentang');

    Route::get('/kategori', function () {
        return view('admin.kategori');
    })->name('kategori');

    Route::get('/produk', function () {
        return view('admin.produk');
    })->name('produk');

    Route::get('/outlet', function () {
        return view('admin.outlet');
    })->name('outlet');

    Route::get('/pengguna', function () {
        return view('admin.pengguna');
    })->name('pengguna');
});
