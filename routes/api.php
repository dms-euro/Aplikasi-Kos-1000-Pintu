<?php

use App\Http\Controllers\api\acoount\PenghuniController;
use App\Http\Controllers\api\acoount\UserController;
use App\Http\Controllers\api\auth\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);


Route::middleware('auth:sanctum')->group(function (){
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);
});

Route::get('/users/get', [UserController::class, 'index']);
Route::post('/user/add', [UserController::class, 'store']);
Route::get('/user/{id}/detail', [UserController::class, 'show']);
Route::put('/user/{id}/update', [UserController::class, 'update']);
Route::delete('/user/{id}/delete', [UserController::class, 'destroy']);

Route::get('/penghuni/get', [PenghuniController::class, 'index']);
Route::post('/penghuni/register', [PenghuniController::class, 'register']);
