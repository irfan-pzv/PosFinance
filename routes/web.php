<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RevenueStreamController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuditLogController;

Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/login', [AuthController::class, 'showLoginForm']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/revenue-streams', [RevenueStreamController::class, 'index'])->name('revenue-streams.index');
    Route::post('/revenue-streams', [RevenueStreamController::class, 'store'])->name('revenue-streams.store');
    Route::post('/revenue-streams/{revenueStream}/approve', [RevenueStreamController::class, 'approve'])->name('revenue-streams.approve');
    Route::post('/revenue-streams/{revenueStream}/reject', [RevenueStreamController::class, 'reject'])->name('revenue-streams.reject');
    Route::delete('/revenue-streams/{revenueStream}', [RevenueStreamController::class, 'destroy'])->name('revenue-streams.destroy');

    Route::get('/units', [UnitController::class, 'index'])->name('units.index');
    Route::post('/units', [UnitController::class, 'store'])->name('units.store');
    Route::put('/units/{unit}', [UnitController::class, 'update'])->name('units.update');
    Route::delete('/units/{unit}', [UnitController::class, 'destroy'])->name('units.destroy');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
    Route::delete('/profile/avatar', [ProfileController::class, 'destroyAvatar'])->name('profile.avatar.destroy');

    // Audit Log Routes
    Route::get('/audit-logs', [AuditLogController::class, 'index'])->name('audit-logs.index');
});

Route::get('/logout', [AuthController::class, 'logout']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

