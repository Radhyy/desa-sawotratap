<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PengajuanSuratController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AnnouncementController as AdminAnnouncementController;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/pengumuman', [HomeController::class, 'announcements'])->name('announcements');
Route::get('/pengumuman/{announcement}', [HomeController::class, 'show'])->name('announcements.show');
Route::get('/umkm', [HomeController::class, 'umkm'])->name('umkm');
Route::get('/umkm/{id}', [HomeController::class, 'showUmkm'])->name('umkm.show');
Route::get('/berita', [HomeController::class, 'berita'])->name('berita');
Route::get('/berita/{id}', [HomeController::class, 'showBerita'])->name('berita.show');
Route::get('/galeri', [HomeController::class, 'galeri'])->name('galeri');
Route::get('/galeri/{id}', [HomeController::class, 'showGaleri'])->name('galeri.show');
Route::view('/profile-desa', 'profile-desa.index')->name('profile-desa.index');

// Pengajuan Surat Routes
Route::get('/pengajuan-surat', [PengajuanSuratController::class, 'index'])->name('pengajuan-surat.index');
Route::post('/pengajuan-surat', [PengajuanSuratController::class, 'store'])->name('pengajuan-surat.store');

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/reset-password', [ProfileController::class, 'showResetPassword'])->name('profile.reset-password');
    Route::put('/profile/reset-password', [ProfileController::class, 'resetPassword'])->name('profile.reset-password.update');
    
    // Pengajuan Surat Routes (User)
    Route::get('/pengajuan-surat/{pengajuanSurat}', [PengajuanSuratController::class, 'show'])->name('pengajuan-surat.show');
    Route::get('/pengajuan-surat/{pengajuanSurat}/edit', [PengajuanSuratController::class, 'edit'])->name('pengajuan-surat.edit');
    Route::put('/pengajuan-surat/{pengajuanSurat}', [PengajuanSuratController::class, 'update'])->name('pengajuan-surat.update');
    Route::delete('/pengajuan-surat/{pengajuanSurat}', [PengajuanSuratController::class, 'destroy'])->name('pengajuan-surat.destroy');
    Route::delete('/pengajuan-surat-dokumen/{dokumen}', [PengajuanSuratController::class, 'deleteDokumen'])->name('pengajuan-surat.dokumen.delete');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('announcements', AdminAnnouncementController::class);
});
