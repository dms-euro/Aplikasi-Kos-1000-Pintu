<?php

use App\Http\Controllers\Account\AccountController;
use App\Http\Controllers\Account\PenghuniAuthController;
use App\Http\Controllers\Admin\DashboardCpntroller;
use App\Http\Controllers\Admin\KamarController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\SewaController as AdminSewaController;
use App\Http\Controllers\Penghuni\DashboardController as PenghuniDashboardController;
use App\Http\Controllers\Penghuni\KamarController as PenghuniKamarController;
use App\Http\Controllers\Penghuni\PembayaranController;
use App\Http\Controllers\Penghuni\PemesananController as PenghuniPemesananController;
use App\Http\Controllers\Staf\DashboardController;
use App\Http\Controllers\Staf\KamarController as StafKamarController;
use App\Http\Controllers\Staf\Pemesanan;
use App\Http\Controllers\Staf\PemesananController;
use App\Http\Controllers\Staf\PenghuniController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PenghuniDashboardController::class, 'index'])->name('dashboard.penghuni');

//Ketika Belum Login
Route::middleware('guest')->group(function () {
    Route::get('/login', [AccountController::class, 'showlogin'])->name('login');
    Route::post('/login', [AccountController::class, 'login'])->name('login.post');
    Route::get('/register', [PenghuniAuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [PenghuniAuthController::class, 'register'])->name('register.post');
});

//Role:admin
Route::middleware(['auth', 'role:owner'])->prefix('admin')->name('admin.')->group(function () {
    //dashboard
    Route::get('/dashboard', [DashboardCpntroller::class, 'index'])->name('dashboard.admin');
    //account
    Route::get('/account', [AccountController::class, 'index'])->name('account.index');
    Route::post('/account', [AccountController::class, 'store'])->name('account.store');
    Route::delete('/account/{id}', [AccountController::class, 'destroy'])->name('account.delete');
    //penghuni
    Route::get('/penghuni', [AccountController::class, 'penghuni'])->name('account.penghuni');
    Route::put('/account/{id}', [AccountController::class, 'update'])->name('account.update');
    //kategori kamar
    Route::get('/Kategori', [KategoriController::class, 'index'])->name('kategori.index');
    Route::post('/Kategori', [KategoriController::class, 'store'])->name('kategori.store');
    Route::put('/Kategori/{id}', [KategoriController::class, 'update'])->name('kategori.update');
    Route::delete('/Kategori/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');
    //kamar
    Route::get('/kamar', [KamarController::class, 'index'])->name('kamar.index');
    Route::post('/kamar/add', [KamarController::class, 'store'])->name('kamar.store');
    Route::put('/kamar/{id}', [KamarController::class, 'update'])->name('kamar.update');
    Route::delete('/kamar/{id}', [KamarController::class, 'destroy'])->name('kamar.destroy');
    //laporan
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/export-pdf', [LaporanController::class, 'exportPdf'])->name('laporan.export-pdf');
    Route::get('/laporan/export-excel', [LaporanController::class, 'exportExcel'])->name('laporan.export-excel');
    // //pemesanan
    // Route::get('/pemesanan', [AdminSewaController::class, 'index'])->name('pemesanan.index');
    // Route::post('/pemesanan', [AdminSewaController::class, 'store'])->name('pemesanan.store');
    // Route::get('/pemesanan/{id}', [AdminSewaController::class, 'show'])->name('pemesanan.show');
    // Route::get('/pemesanan/history', [AdminSewaController::class, 'history'])->name('pemesanan.history');
    // Route::get('/pemesanan/confirm/{id}', [AdminSewaController::class, 'confirm'])->name('pemesanan.confirm');
    // Route::get('/pemesanan/cancel/{id}', [AdminSewaController::class, 'cancel'])->name('pemesanan.cancel');
    // //pembayaran
    // Route::get('/pembayaran/{id}', [PembayaranController::class, 'form'])->name('pembayaran.form');
    // Route::post('/pembayaran/{id}', [PembayaranController::class, 'store'])->name('pembayaran.store');
});

//Role:staf
Route::middleware(['auth', 'role:staf'])->prefix('staf')->name('staf.')->group(function () {
    //dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.staf');
    //pemesanan
    Route::get('/pemesanan', [PemesananController::class, 'index'])->name('pemesanan.index');
    Route::post('/pemesanan/{id}/confirm', [PemesananController::class, 'confirm'])->name('pemesanan.confirm');
    Route::post('/pemesanan/{id}/cancel', [PemesananController::class, 'cancel'])->name('pemesanan.cancel');
    //penghuni
    Route::get('/penghuni', [PenghuniController::class, 'index'])->name('penghuni.index');
    Route::get('/penghuni/{id}', [PenghuniController::class, 'show'])->name('penghuni.show');
    //kamar
    Route::get('/kamar', [StafKamarController::class, 'index'])->name('kamar.index');
});

//Role:penghuni
Route::middleware(['auth', 'role:penghuni'])->prefix('penghuni')->name('penghuni.')->group(function () {
    //kamar
    Route::get('/kamar', [PenghuniKamarController::class, 'index'])->name('kamar.index');
    Route::get('/kamar/{id}', [PenghuniKamarController::class, 'show'])->name('kamar.show');
    Route::get('/kamar-saya', [PenghuniKamarController::class, 'saya'])->name('kamar.saya');
    Route::get('/detail-kamar/{id}', [PenghuniDashboardController::class, 'show'])->name('detail.kamar');
    //pemesanan
    Route::get('/pemesanan/{id}/create', [PenghuniPemesananController::class, 'create'])->name('pemesanan.create');
    Route::post('/pemesanan', [PenghuniPemesananController::class, 'store'])->name('pemesanan.store');
    Route::get('/pemesanan/{id}', [PenghuniPemesananController::class, 'show'])->whereNumber('id')->name('pemesanan.show');
    //pembayaran
    Route::post('/pembayaran/{id}/cash', [PembayaranController::class, 'cash'])->name('pembayaran.cash');
    Route::post('/pembayaran/{id}/qris', [PembayaranController::class, 'qris'])->name('pembayaran.qris');
});

//Logout
Route::middleware(['auth', 'role:owner,staf,penghuni'])->group(function () {
    Route::post('/logout', [AccountController::class, 'logout'])->name('logout');
});
