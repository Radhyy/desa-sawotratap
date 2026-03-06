<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AnnouncementController as AdminAnnouncementController;
use App\Http\Controllers\Admin\UmkmController as AdminUmkmController;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/pengumuman', [HomeController::class, 'announcements'])->name('announcements');
Route::get('/pengumuman/{announcement}', [HomeController::class, 'show'])->name('announcements.show');
Route::get('/umkm', [HomeController::class, 'umkm'])->name('umkm');
Route::get('/umkm/{id}', [HomeController::class, 'umkmShow'])->name('umkm.show');

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('announcements', AdminAnnouncementController::class);
    Route::resource('umkm', AdminUmkmController::class);
});
