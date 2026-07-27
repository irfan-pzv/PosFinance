<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RevenueStreamController;

Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/login', [AuthController::class, 'showLoginForm']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/revenue-streams', [RevenueStreamController::class, 'index'])->name('revenue-streams.index');
    Route::post('/revenue-streams', [RevenueStreamController::class, 'store'])->name('revenue-streams.store');
    Route::delete('/revenue-streams/{revenueStream}', [RevenueStreamController::class, 'destroy'])->name('revenue-streams.destroy');
});

Route::get('/logout', [AuthController::class, 'logout']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

