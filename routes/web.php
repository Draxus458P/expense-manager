<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminUploadRoleController;
use App\Http\Controllers\Admin\AdminUsersController;
use App\Http\Controllers\Admin\AdminCategoriesController;
use App\Http\Controllers\Admin\AdminExpensesController;
use App\Http\Controllers\User\UserCategoriesController;
use App\Http\Controllers\User\UserExpensesController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Route for the home page
Route::get('/', fn() => view('welcome'));

// Route for the user dashboard, requiring authentication and email verification
Route::get('/dashboard', fn() => view('dashboard'))
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Group of routes that require authentication
Route::middleware('auth')->group(function () {
    // User profile routes
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    // Admin dashboard
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    // Admin roles management
    Route::prefix('admin/roles')->group(function () {
        Route::get('/', [AdminUploadRoleController::class, 'index'])->name('roles.index');
        Route::post('/', [AdminUploadRoleController::class, 'store'])->name('roles.store');
        Route::put('/{user}', [AdminUploadRoleController::class, 'update'])->name('roles.update');
        Route::delete('/{user}', [AdminUploadRoleController::class, 'destroy'])->name('roles.destroy');
    });

    Route::prefix('admin/users')->group(function () {
        Route::get('/', [AdminUsersController::class, 'index'])->name('users.index');
        Route::post('/', [AdminUsersController::class, 'store'])->name('users.store');
        Route::put('/{user}', [AdminUsersController::class, 'update'])->name('users.update');
        Route::delete('/{user}', [AdminUsersController::class, 'destroy'])->name('users.destroy');
    });

    // Admin categories management
    Route::get('/admin/admincategories', [AdminCategoriesController::class, 'index'])->name('admin.admincategories');

    // Admin expenses management
    Route::get('/admin/adminexpenses', [AdminExpensesController::class, 'index'])->name('admin.adminexpenses');

    // User categories management
    Route::get('/user/usercategories', [UserCategoriesController::class, 'index'])->name('user.usercategories');

    // User expenses management
    Route::get('/user/userexpenses', [UserExpensesController::class, 'index'])->name('user.userexpenses');
});

// Load authentication routes
require __DIR__ . '/auth.php';
