<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ToolController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LoanApprovalController;
use App\Http\Controllers\User\ToolController as UserToolController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\Admin\UserApprovalController;
use App\Http\Controllers\SearchController;

/*
|--------------------------------------------------------------------------
| SEARCH
|--------------------------------------------------------------------------
*/
Route::get('/search', [SearchController::class, 'search'])->name('search');
Route::get('/search-users', [SearchController::class, 'searchUsers'])->name('search.users');

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Registration
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);

/*
|--------------------------------------------------------------------------
| USER AREA
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'user'])
    ->prefix('user')
    ->name('user.')
    ->group(function () {

    // tools (lihat alat)
    Route::get('/tools', [UserToolController::class, 'index'])
        ->name('tools.index');

    // loans (peminjaman)
    Route::get('/loans', [LoanController::class, 'index'])
        ->name('loans.index');

    Route::get('/loans/history', [LoanController::class, 'history'])
        ->name('loans.history');

    Route::get('/loans/create/{tool}', [LoanController::class, 'create'])
        ->name('loans.create');

    Route::post('/loans', [LoanController::class, 'store'])
        ->name('loans.store');
});

/*
|--------------------------------------------------------------------------
| ADMIN AREA
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('admin.dashboard');

    // persetujuan akun
    Route::get('/users/pending', [UserApprovalController::class, 'index'])
        ->name('admin.users.pending');
    
    Route::post('/users/{user}/approve', [UserApprovalController::class, 'approve'])
        ->name('admin.users.approve');

    Route::post('/users/{user}/reject', [UserApprovalController::class, 'reject'])
        ->name('admin.users.reject');

    // kelola alat
    Route::resource('tools', ToolController::class);

    // pengajuan peminjaman
    Route::get('/loans', [LoanApprovalController::class, 'index'])
        ->name('admin.loans.index');

    // riwayat peminjaman
    Route::get('/loans/history', [LoanApprovalController::class, 'history'])
        ->name('admin.loans.history');

    Route::post('/loans/{loan}/approve', [LoanApprovalController::class, 'approve'])
        ->name('admin.loans.approve');

    Route::post('/loans/{loan}/reject', [LoanApprovalController::class, 'reject'])
        ->name('admin.loans.reject');

    Route::post('/loans/{loan}/borrowed', [LoanApprovalController::class, 'markAsBorrowed'])
        ->name('admin.loans.borrowed');

    Route::post('/loans/{loan}/returned', [LoanApprovalController::class, 'markAsReturned'])
        ->name('admin.loans.returned');
});

/*
|--------------------------------------------------------------------------
| HOME
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});
