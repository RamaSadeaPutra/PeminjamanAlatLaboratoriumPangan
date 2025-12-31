<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ToolController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LoanApprovalController;
use App\Http\Controllers\Admin\UserApprovalController;
use App\Http\Controllers\User\ToolController as UserToolController;
use App\Http\Controllers\RegisteredUserController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| SEARCH & FILTER
|--------------------------------------------------------------------------
*/
Route::get('/search', [SearchController::class, 'search'])->name('search');
Route::get('/search-users', [SearchController::class, 'searchUsers'])->name('search.users');
Route::get('/search-loans', [SearchController::class, 'searchLoans'])->name('search.loans');
Route::get('/search-history', [SearchController::class, 'searchHistory'])->name('search.history');
Route::get('/search-myloans', [SearchController::class, 'searchMyLoans'])->name('search.myloans');
Route::get('/search-myhistory', [SearchController::class, 'searchMyHistory'])->name('search.myhistory');

// New Detailed Filters
Route::prefix('filter')->name('filter.')->group(function() {
    Route::get('/tools', [FilterController::class, 'filterTools'])->name('tools');
    Route::get('/users', [FilterController::class, 'filterUsers'])->name('users');
    Route::get('/loans', [FilterController::class, 'filterLoans'])->name('loans');
    Route::get('/history', [FilterController::class, 'filterHistory'])->name('history');
    Route::get('/myloans', [FilterController::class, 'filterMyLoans'])->name('myloans');
    Route::get('/myhistory', [FilterController::class, 'filterMyHistory'])->name('myhistory');
});

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

// Profile routes
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/password', [ProfileController::class, 'editPassword'])->name('profile.editPassword');
    Route::post('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');
    Route::post('/profile/photo', [ProfileController::class, 'updatePhoto'])->name('profile.updatePhoto');
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
    
    Route::get('/users/active', [UserApprovalController::class, 'active'])
        ->name('admin.users.active');
    
    Route::post('/users/{user}/password', [UserApprovalController::class, 'updatePassword'])
        ->name('admin.users.password.update');

    Route::delete('/users/{user}', [UserApprovalController::class, 'destroy'])
        ->name('admin.users.destroy');

    // riwayat registrasi (akun yang disetujui atau ditolak)
    Route::get('/users/history', [UserApprovalController::class, 'history'])
        ->name('admin.users.history');
    
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

    // route untuk export PDF riwayat peminjaman (khusus admin)
    Route::get('/loans/report', [LoanApprovalController::class, 'exportPdf'])
        ->name('admin.loans.report');

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
    return view('auth.login');
});
