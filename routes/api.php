<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;

// Rute Publik (Bebas diakses tanpa login)
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Rute Terlindungi (Wajib punya Token / Wajib Login)
Route::middleware('auth:sanctum')->group(function () {
    
    // Rute yang bisa diakses user biasa
    Route::apiResource('categories', CategoryController::class)->except(['destroy']);
    Route::apiResource('items', ItemController::class)->except(['destroy']);

    // Rute super ketat (Hanya ADMIN yang boleh DELETE)
    Route::delete('categories/{category}', [CategoryController::class, 'destroy'])->middleware('role:admin');
    Route::delete('items/{item}', [ItemController::class, 'destroy'])->middleware('role:admin');
});