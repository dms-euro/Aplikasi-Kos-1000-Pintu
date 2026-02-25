<?php

use App\Http\Controllers\Account\AccountController;
use App\Http\Controllers\Account\PenghuniAuthController;
use App\Http\Controllers\Admin\DashboardCpntroller;
use App\Http\Controllers\Admin\KamarController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\SewaController as AdminSewaController;
use App\Http\Controllers\Penghuni\DashboardController as PenghuniDashboardController;
use App\Http\Controllers\Penghuni\PembayaranController;
use App\Http\Controllers\Penghuni\PemesananController as PenghuniPemesananController;
use App\Http\Controllers\Penghuni\SewaController;
use App\Http\Controllers\Staf\DashboardController;
use App\Http\Controllers\Staf\PenghuniController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PenghuniDashboardController::class, 'index'])->name('dashboard.penghuni');
Route::get('/detail-kamar/{id}', [PenghuniDashboardController::class, 'show'])->name('detail.kamar');
Route::get('/kamar/{id}/sewa', [PenghuniPemesananController::class, 'create'])->name('pemesanan.create');
Route::post('/pemesanan', [PenghuniPemesananController::class, 'store'])->name('pemesanan.store');Route::get('/pemesanan/{id}', [PenghuniPemesananController::class, 'show'])
    ->whereNumber('id')
    ->name('pemesanan.show');
Route::post('/pembayaran/{pemesanan_id}', [PenghuniPemesananController::class, 'storePembayaran'])->name('pembayaran.store');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AccountController::class, 'showlogin'])->name('login');
    Route::post('/login', [AccountController::class, 'login'])->name('login.post');
    Route::get('/register', [PenghuniAuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [PenghuniAuthController::class, 'register'])->name('register.post');
});

Route::middleware(['auth', 'role:owner'])->group(function () {
    Route::get('/dashboard/admin', [DashboardCpntroller::class, 'index'])->name('dashboard.admin');
    Route::get('/account/admin', [AccountController::class, 'index'])->name('account.index');
    Route::post('/account/add/admin', [AccountController::class, 'store'])->name('account.store');
    Route::delete('/account/delete/{id}', [AccountController::class, 'destroy'])->name('account.delete');
    Route::get('/Kategori/admin', [KategoriController::class, 'index'])->name('kategori.index');
    Route::post('/Kategori/add/admin', [KategoriController::class, 'store'])->name('kategori.store');
    Route::put('/Kategori/update/{id}', [KategoriController::class, 'update'])->name('kategori.update');
    Route::delete('/Kategori/delete/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');
    Route::get('/kamar/admin', [KamarController::class, 'index'])->name('kamar.index');
    Route::post('/kamar/add/admin', [KamarController::class, 'store'])->name('kamar.store');
    Route::put('/kamar/update/{id}', [KamarController::class, 'update'])->name('kamar.update');
    Route::delete('/kamar/delete/{id}', [KamarController::class, 'destroy'])->name('kamar.destroy');
    Route::get('/pemesanan/admin', [AdminSewaController::class, 'index'])->name('pemesanan.index');
    Route::get('/pemesanan/store', [AdminSewaController::class, 'store'])->name('pemesanan.store');
    Route::get('/pemesanan/show/{id}', [AdminSewaController::class, 'show'])->name('pemesanan.show');
    Route::get('/pemesanan/confirm/{id}', [AdminSewaController::class, 'confirm'])->name('pemesanan.confirm');
    Route::get('/pemesanan/cancel/{id}', [AdminSewaController::class, 'cancel'])->name('pemesanan.cancel');
    Route::get('/pemesanan/history', [AdminSewaController::class, 'history'])->name('pemesanan.history');
    Route::get('/pembayaran/admin/{id}', [PembayaranController::class, 'form'])->name('pembayaran.form');
    Route::post('/pembayaran/admin/{id}', [PembayaranController::class, 'store'])->name('pembayaran.store');
});

Route::middleware(['auth', 'role:staf'])->group(function () {
    Route::get('/dashboard/staf', [DashboardController::class, 'index'])->name('dashboard.staf');
    Route::get('/penghuni/staf', [PenghuniController::class, 'index'])->name('penghuni.');
});

Route::middleware(['auth', 'role:owner,staf,penghuni'])->group(function () {
    Route::post('/logout', [AccountController::class, 'logout'])->name('logout');
});
