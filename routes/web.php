<?php

use App\Http\Controllers\Admin\AdminDashboardController; // Import the AdminDashboardController
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

// Load authentication routes
require __DIR__ . '/auth.php';
