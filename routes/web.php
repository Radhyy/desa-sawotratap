<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PengajuanSuratController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\PerizinanController;
use App\Http\Controllers\LaporanSayaController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AnnouncementController as AdminAnnouncementController;
use App\Http\Controllers\Admin\BeritaController as AdminBeritaController;
use App\Http\Controllers\Admin\GaleriController as AdminGaleriController;
use App\Http\Controllers\Admin\UmkmController as AdminUmkmController;
use App\Http\Controllers\Admin\KategoriUmkmController as AdminKategoriUmkmController;
use App\Http\Controllers\Admin\PengajuanSuratController as AdminPengajuanSuratController;
use App\Http\Controllers\Admin\PengaduanController as AdminPengaduanController;
use App\Http\Controllers\Admin\PerizinanController as AdminPerizinanController;
use App\Http\Controllers\Admin\UserController as AdminUserController;

use App\Http\Controllers\Kades\DashboardController as KadesDashboardController;
use App\Http\Controllers\Kades\PengajuanSuratController as KadesPengajuanSuratController;
use App\Http\Controllers\Kades\PengaduanController as KadesPengaduanController;
use App\Http\Controllers\Kades\PerizinanController as KadesPerizinanController;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/pengumuman', [HomeController::class, 'announcements'])->name('announcements');
Route::get('/pengumuman/{announcement}', [HomeController::class, 'show'])->name('announcements.show');
Route::get('/umkm', [HomeController::class, 'umkm'])->name('umkm');
Route::get('/umkm/daftar', [HomeController::class, 'createUmkm'])->name('umkm.create');
Route::post('/umkm/daftar', [HomeController::class, 'storeUmkm'])->name('umkm.store');
Route::get('/umkm/{id}', [HomeController::class, 'showUmkm'])->name('umkm.show');
Route::get('/berita', [HomeController::class, 'berita'])->name('berita');
Route::get('/berita/{id}', [HomeController::class, 'showBerita'])->name('berita.show');
Route::get('/galeri', [HomeController::class, 'galeri'])->name('galeri');
Route::get('/galeri/{id}', [HomeController::class, 'showGaleri'])->name('galeri.show');
Route::view('/profile-desa', 'profile-desa.index')->name('profile-desa.index');
Route::view('/pemerintahan', 'pemerintahan.index')->name('pemerintahan.index');
Route::get('/perizinan', [PerizinanController::class, 'index'])->name('perizinan.index');
Route::post('/perizinan', [PerizinanController::class, 'store'])->name('perizinan.store');
Route::get('/pengaduan', [PengaduanController::class, 'index'])->name('pengaduan.index');
Route::post('/pengaduan', [PengaduanController::class, 'store'])->name('pengaduan.store');

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
    
    // Laporan Saya
    Route::get('/laporan-saya', [LaporanSayaController::class, 'index'])->name('laporan-saya.index');

    // Pengajuan Surat Routes (User)
    Route::get('/pengajuan-surat/{pengajuanSurat}', [PengajuanSuratController::class, 'show'])->name('pengajuan-surat.show');
    Route::get('/pengajuan-surat/{pengajuanSurat}/edit', [PengajuanSuratController::class, 'edit'])->name('pengajuan-surat.edit');
    Route::put('/pengajuan-surat/{pengajuanSurat}', [PengajuanSuratController::class, 'update'])->name('pengajuan-surat.update');
    Route::delete('/pengajuan-surat/{pengajuanSurat}', [PengajuanSuratController::class, 'destroy'])->name('pengajuan-surat.destroy');
    Route::delete('/pengajuan-surat-dokumen/{dokumen}', [PengajuanSuratController::class, 'deleteDokumen'])->name('pengajuan-surat.dokumen.delete');
    // UMKM Saya
    Route::get('/produk-anda', [\App\Http\Controllers\UmkmSayaController::class, 'index'])->name('umkm-saya.index');
    Route::get('/produk-anda/{id}/edit', [\App\Http\Controllers\UmkmSayaController::class, 'edit'])->name('umkm-saya.edit');
    Route::put('/produk-anda/{id}', [\App\Http\Controllers\UmkmSayaController::class, 'update'])->name('umkm-saya.update');
    Route::delete('/produk-anda/{id}', [\App\Http\Controllers\UmkmSayaController::class, 'destroy'])->name('umkm-saya.destroy');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('announcements', AdminAnnouncementController::class);
    Route::resource('berita', AdminBeritaController::class);
    Route::resource('galeri', AdminGaleriController::class);
    Route::resource('umkm', AdminUmkmController::class);
    Route::put('/umkm/{umkm}/status', [AdminUmkmController::class, 'updateStatus'])->name('umkm.update-status');
    Route::resource('kategori-umkm', AdminKategoriUmkmController::class);
    Route::resource('users', AdminUserController::class);

    Route::resource('apbdes', \App\Http\Controllers\Admin\ApbdesController::class);
    Route::put('/apbdes/{apbde}/activate', [\App\Http\Controllers\Admin\ApbdesController::class, 'activate'])->name('apbdes.activate');

    // Settings Routes
    Route::get('settings', [App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings.index');
    Route::put('settings', [App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');

    // Pengajuan Surat Admin
    Route::get('/pengajuan-surat', [AdminPengajuanSuratController::class, 'index'])->name('pengajuan-surat.index');
    Route::get('/pengajuan-surat/{pengajuanSurat}', [AdminPengajuanSuratController::class, 'show'])->name('pengajuan-surat.show');
    Route::put('/pengajuan-surat/{pengajuanSurat}/status', [AdminPengajuanSuratController::class, 'updateStatus'])->name('pengajuan-surat.update-status');

    // Pengaduan Admin
    Route::get('/pengaduan', [AdminPengaduanController::class, 'index'])->name('pengaduan.index');
    Route::get('/pengaduan/{pengaduan}', [AdminPengaduanController::class, 'show'])->name('pengaduan.show');
    Route::put('/pengaduan/{pengaduan}/status', [AdminPengaduanController::class, 'updateStatus'])->name('pengaduan.update-status');

    // Perizinan Admin
    Route::get('/perizinan', [AdminPerizinanController::class, 'index'])->name('perizinan.index');
    Route::get('/perizinan/{perizinan}', [AdminPerizinanController::class, 'show'])->name('perizinan.show');
    Route::put('/perizinan/{perizinan}/status', [AdminPerizinanController::class, 'updateStatus'])->name('perizinan.update-status');
});

// Kades Routes
Route::middleware(['auth', 'kades'])->prefix('kades')->name('kades.')->group(function () {
    Route::get('/dashboard', [KadesDashboardController::class, 'index'])->name('dashboard');
    
    // Pengajuan Surat Kades
    Route::get('/pengajuan-surat', [KadesPengajuanSuratController::class, 'index'])->name('pengajuan-surat.index');
    Route::get('/pengajuan-surat/{pengajuanSurat}', [KadesPengajuanSuratController::class, 'show'])->name('pengajuan-surat.show');
    Route::put('/pengajuan-surat/{pengajuanSurat}/status', [KadesPengajuanSuratController::class, 'updateStatus'])->name('pengajuan-surat.update-status');

    // Pengaduan Kades
    Route::get('/pengaduan', [KadesPengaduanController::class, 'index'])->name('pengaduan.index');
    Route::get('/pengaduan/{pengaduan}', [KadesPengaduanController::class, 'show'])->name('pengaduan.show');
    Route::put('/pengaduan/{pengaduan}/status', [KadesPengaduanController::class, 'updateStatus'])->name('pengaduan.update-status');

    // Perizinan Kades
    Route::get('/perizinan', [KadesPerizinanController::class, 'index'])->name('perizinan.index');
    Route::get('/perizinan/{perizinan}', [KadesPerizinanController::class, 'show'])->name('perizinan.show');
    Route::put('/perizinan/{perizinan}/status', [KadesPerizinanController::class, 'updateStatus'])->name('perizinan.update-status');
});
