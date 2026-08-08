<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\loginController;
use App\Http\Controllers\DashboardController;

Route::get('/', [loginController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [loginController::class, 'login'])->name('loginPost')->middleware('guest');
Route::post('/logout', [loginController::class, 'logout'])->name('logout');

Route::prefix('admin')->group(function () {
    Route::get('/', function () {
        return redirect('/admin/dashboard');
    });
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    Route::get('/kategori', [CategoryController::class, 'index'])->name('admin.kategori.index');
    Route::post('/kategori', [CategoryController::class, 'store'])->name('admin.kategori.store');
    Route::get('/kategori/data', [CategoryController::class, 'getKategoriData'])->name('admin.kategori.data');
    Route::put('/kategori/{id}', [CategoryController::class, 'update'])->name('admin.kategori.update');
    Route::get('/kategori/{id}/edit', [CategoryController::class, 'edit'])->name('admin.kategori.edit');
    Route::delete('/kategori/{id}', [CategoryController::class, 'destroy'])->name('admin.kategori.destroy');
});
