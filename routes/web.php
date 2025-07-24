<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KebayaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PenyewaanController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\UlasanController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\KatalogController;

use App\Http\Controllers\FavoriteController;

Route::get('/favorite', [FavoriteController::class, 'index'])->name('favorite');



Route::redirect('/admin', '/admin/login'); 

Route::get('/admin/login', [App\Http\Controllers\Auth\AdminLoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [App\Http\Controllers\Auth\AdminLoginController::class, 'login'])->name('admin.login.submit');

Route::post('admin/logout', [App\Http\Controllers\Auth\AdminLoginController::class, 'logout'])->name('admin.logout');

// Halaman depan (untuk publik)
Route::get('/', [HomeController::class, 'index']);
Route::get('/katalog', [KatalogController::class, 'index'])->name('katalog');
Route::get('admin/kebayas/favorite', [KebayaController::class, 'favorite'])->name('admin.kebayas.favorite');




// Route ulasan tetap di luar admin (asumsinya publik)
Route::post('/ulasan', [UlasanController::class, 'store'])->name('ulasan.store');

// Group route admin
    Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('kebayas', KebayaController::class);
    Route::resource('penyewaan', PenyewaanController::class);
    Route::resource('pelanggan', PelangganController::class);
    Route::resource('pembayaran', PembayaranController::class);
    Route::get('laporan/export-csv', [LaporanController::class, 'exportCsv'])->name('laporan.exportCsv');
    Route::resource('laporan', LaporanController::class);

});;

// Profile routes (akses setelah login)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Otentikasi default Laravel (login, register, dll)
require __DIR__.'/auth.php';
