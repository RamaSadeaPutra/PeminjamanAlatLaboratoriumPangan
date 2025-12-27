<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ToolController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\Admin\DashboardController;

use App\Http\Controllers\User\ToolController as UserToolController;

use App\Http\Controllers\AuthController;

use App\Http\Controllers\Admin\LoanApprovalController;
use App\Http\Controllers\User\ToolController as UserToolController;

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


/*
|--------------------------------------------------------------------------
| USER AREA
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'user'])
    ->prefix('user')
    ->name('user.')
    ->group(function () {

aSadeaPutra
Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');


Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('admin.dashboard');

    Route::resource('tools', ToolController::class);
});


Route::middleware(['auth', 'user'])->prefix('user')->group(function () {
    Route::get('/tools', [UserToolController::class, 'index'])
        ->name('user.tools.index');

    Route::post('/loans', [LoanController::class, 'store'])
        ->name('loans.store');
});

    // tools (lihat alat)
    Route::get('/tools', [UserToolController::class, 'index'])
        ->name('tools.index');


    // loans (peminjaman)
    Route::get('/loans', [LoanController::class, 'index'])
        ->name('loans.index');


Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');



Route::get('/user/tools', [UserToolController::class, 'index'])
    ->name('user.tools.index');



Route::get('/admin/dashboard', [DashboardController::class, 'index'])
    ->name('admin.dashboard');



Route::get('/loans/create', [LoanController::class, 'create'])->name('loans.create');
Route::post('/loans', [LoanController::class, 'store'])->name('loans.store');

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

    // kelola alat
    Route::resource('tools', ToolController::class);

    // pengajuan peminjaman
    Route::get('/loans', [LoanApprovalController::class, 'index'])
        ->name('admin.loans.index');

    Route::post('/loans/{loan}/approve', [LoanApprovalController::class, 'approve'])
        ->name('admin.loans.approve');

    Route::post('/loans/{loan}/reject', [LoanApprovalController::class, 'reject'])
        ->name('admin.loans.reject');
});

/*
|--------------------------------------------------------------------------
| HOME
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});