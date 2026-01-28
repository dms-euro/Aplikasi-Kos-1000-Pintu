<?php

use App\Http\Controllers\api\auth\AuthController;
use App\Http\Controllers\api\auth\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);


Route::middleware('auth:sanctum')->group(function (){
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);
});

Route::get('/users/get', [UserController::class, 'index']);
Route::post('/user/add', [UserController::class, 'store']);
