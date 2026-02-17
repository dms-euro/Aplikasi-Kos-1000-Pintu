<?php

use App\Http\Controllers\Account\AccountController;
use App\Http\Controllers\Admin\DashboardCpntroller;
use App\Http\Controllers\Admin\KamarController;
use App\Http\Controllers\Admin\KategoriController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardCpntroller::class, 'index'])->name('dashboard.admin');
Route::get('/account/admin', [AccountController::class, 'index'])->name('account.index');
Route::post('/account/add/admin', [AccountController::class, 'store'])->name('account.store');
Route::delete('/account/delete/{id}', [AccountController::class, 'destroy'])->name('account.delete');
Route::get('/Kategori/admin', [KategoriController::class, 'index'])->name('kategori.index');
Route::post('/Kategori/add/admin', [KategoriController::class, 'store'])->name('kategori.store');
Route::put('/Kategori/update/{id}', [KategoriController::class, 'update'])->name('kategori.update');
Route::delete('/Kategori/delete/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');
Route::get('/kamar/admin', [KamarController::class, 'index'])->name('kamar.index');
Route::post('/kamar/add/admin', [KamarController::class, 'store'])->name('kamar.store');
Route::post('/kamar/delete/{id}', [KamarController::class, 'destroy'])->name('kamar.destroy');
