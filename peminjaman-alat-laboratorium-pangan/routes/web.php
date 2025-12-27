<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ToolController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\User\ToolController as UserToolController;

// Halaman Utama
Route::get('/', function () {
    return view('welcome');
});

// Autentikasi
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rute khusus ADMIN
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    
    // Management Tools untuk Admin
    Route::resource('tools', ToolController::class);
});

// Rute khusus USER
Route::middleware(['auth', 'user'])->prefix('user')->group(function () {
    Route::get('/tools', [UserToolController::class, 'index'])->name('user.tools.index');
    
    // Peminjaman Alat
    Route::get('/loans', [LoanController::class, 'index'])->name('loans.index');
    Route::get('/loans/create', [LoanController::class, 'create'])->name('loans.create');
    Route::post('/loans', [LoanController::class, 'store'])->name('loans.store');
});

// Rute untuk melihat daftar pengajuan
Route::get('/admin', [LoanController::class, 'indexAdmin'])->name('admin.index');

// Rute untuk aksi persetujuan
Route::post('/admin/{id}/approve', [LoanController::class, 'approve'])->name('admin.approve');
Route::post('/admin/{id}/reject', [LoanController::class, 'reject'])->name('admin.reject');