<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminRolesController;
use App\Http\Controllers\Admin\AdminUsersController;
use App\Http\Controllers\Admin\AdminCategoriesController;
use App\Http\Controllers\Admin\AdminExpensesController;
use App\Http\Controllers\User\UserCategoriesController;
use App\Http\Controllers\User\UserExpensesController;
use App\Http\Controllers\Admin\AdminUploadRoleController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Route for the home page
Route::get('/', function () {
    return view('welcome');
});

// Route for the user dashboard, requiring authentication and email verification
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Group of routes that require the user to be authenticated
Route::middleware('auth')->group(function () {
    // Route to edit the user profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    // Route to update the user profile
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Route to delete the user profile
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route for the admin dashboard, requiring authentication
Route::middleware('auth')->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
});
Route::middleware('auth')->group(function () {
    Route::get('/admin/adminroles', [AdminRolesController::class, 'index'])->name('admin.adminroles');
});
Route::middleware('auth')->group(function () {
    Route::get('/admin/adminusers', [AdminUsersController::class, 'index'])->name('admin.adminusers');
});
Route::middleware('auth')->group(function () {
    Route::get('/admin/admincategories', [AdminCategoriesController::class, 'index'])->name('admin.admincategories');
});
Route::middleware('auth')->group(function () {
    Route::get('/admin/adminexpenses', [AdminExpensesController::class, 'index'])->name('admin.adminexpenses');
});
Route::middleware('auth')->group(function () {
    Route::get('/user/usercategories', [UserCategoriesController::class, 'index'])->name('user.usercategories');
});
Route::middleware('auth')->group(function () {
    Route::get('/user/userexpenses', [UserExpensesController::class, 'index'])->name('user.userexpenses');
});

Route::prefix('admin')->group(function () {
    // Route to display roles page
    Route::get('/roles', [AdminUploadRoleController::class, 'index'])->name('roles.index');

    // Route to store a new role
    Route::post('/roles', [AdminUploadRoleController::class, 'store'])->name('roles.store');

    // Route to update an existing role
    Route::put('/roles/{role}', [AdminUploadRoleController::class, 'update'])->name('roles.update');

    // Route to delete a role
    Route::delete('/roles/{role}', [AdminUploadRoleController::class, 'destroy'])->name('roles.destroy');
});

// Load authentication routes
require __DIR__ . '/auth.php';
