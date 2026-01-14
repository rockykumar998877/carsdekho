<?php

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\BookingController;
use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\CarCategoryController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Frontend Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/booking', [BookingController::class, 'create'])->name('booking.create');
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
Route::get('/get-cars', [BookingController::class, 'getCars'])->name('get.cars');

// Admin - Public routes (Login)
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [\App\Http\Controllers\Admin\AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [\App\Http\Controllers\Admin\AuthController::class, 'login'])->name('post-login');
    
    // Password Reset Routes
    Route::get('/forgot-password', [\App\Http\Controllers\Admin\AuthController::class, 'showForgotPassword'])->name('forgot-password');
    Route::post('/forgot-password', [\App\Http\Controllers\Admin\AuthController::class, 'sendResetLink'])->name('password.email');
    Route::get('/reset-password/{token}', [\App\Http\Controllers\Admin\AuthController::class, 'showResetPassword'])->name('password.reset');
    Route::post('/reset-password', [\App\Http\Controllers\Admin\AuthController::class, 'resetPassword'])->name('password.update');
});

// Logout route  
Route::post('/logout', [\App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('logout');

// Admin - Protected routes
Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->name('admin.')->group(function () {
        /** dashboard routes */
        Route::get('dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard.index');
        
        /** profile routes */
        Route::get('/profile/edit', [\App\Http\Controllers\Admin\ProfileController::class, 'edit'])->name('user.profile.edit');
        Route::put('/profile/update', [\App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('user.profile.update');
        
        /** change password routes */
        Route::get('/change-password', [\App\Http\Controllers\Admin\ProfileController::class, 'changePassword'])->name('change-password');
        Route::post('/update-password', [\App\Http\Controllers\Admin\ProfileController::class, 'updatePassword'])->name('update-password');
        
        /**user management routes */
        Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
        Route::resource('roles', \App\Http\Controllers\Admin\RoleController::class);
        Route::resource('permissions', \App\Http\Controllers\Admin\PermissionController::class);
        
        // TODO: Create Role, Permission, User controllers
        // For now, these routes are disabled until controllers are created
        
        /** car categories routes */
        Route::resource('categories', CarCategoryController::class);

        /** cars routes */
        Route::resource('cars', CarController::class);

        /** bookings routes */
        Route::get('bookings', [AdminBookingController::class, 'index'])->name('bookings.index');
        Route::get('bookings/{id}', [AdminBookingController::class, 'show'])->name('bookings.show');
        Route::post('bookings/{id}/status', [AdminBookingController::class, 'updateStatus'])->name('bookings.updateStatus');
        Route::delete('bookings/{id}', [AdminBookingController::class, 'destroy'])->name('bookings.destroy');
    });
});
