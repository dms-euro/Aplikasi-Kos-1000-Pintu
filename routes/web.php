<?php

use App\Http\Controllers\Account\AccountController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/account/admin', [AccountController::class, 'index'])->name('account.index');
Route::post('/account/add/admin', [AccountController::class, 'store'])->name('account.store');
