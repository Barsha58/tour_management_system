<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomerDashboardController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AdminController; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\AdminPackageController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\ReviewController;


// Home Page
Route::get('/', [PackageController::class, 'index'])->name('home');

// Fetch Packages
Route::post('/search-packages', [PackageController::class, 'searchPackages'])->name('search.packages');

// Display all packages
Route::get('/packages', [PackageController::class, 'index'])->name('packages.index');

// web.php
Route::get('/customer/dashboard', [CustomerDashboardController::class, 'index'])->name('customer.dashboard')->middleware('auth');
// Route for canceling bookings
Route::post('/booking/cancel/{id}', [BookingController::class, 'cancelBooking'])->name('booking.cancel');




// Booking Routes (Require Authentication)
Route::get('/bookings/{packageId}/customer-info', [BookingController::class, 'showCustomerInfoForm'])->name('bookings.customer-info');
Route::post('/bookings/store-customer-info', [BookingController::class, 'storeCustomerInfo'])->name('bookings.store-customer-info');
Route::get('/bookings/confirm', [BookingController::class, 'showBookingConfirmationForm'])->name('bookings.confirm');
Route::post('/bookings/store', [BookingController::class, 'store'])->name('bookings.store');

// Admin Dashboard
// Admin Dashboard Routes
Route::middleware(['auth'])->group(function () {
    // Admin Dashboard Home
    Route::get('/admin', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    Route::prefix('admin/gallery')->group(function () {
        Route::get('/', [GalleryController::class, 'index'])->name('admin.gallery.index'); // Updated to include 'admin.'
        Route::get('/create', [GalleryController::class, 'create'])->name('admin.gallery.create'); // Updated to include 'admin.'
        Route::post('/', [GalleryController::class, 'store'])->name('admin.gallery.store'); // Updated to include 'admin.'
        Route::get('/{id}/edit', [GalleryController::class, 'edit'])->name('admin.gallery.edit'); // Updated to include 'admin.'
        Route::put('/{id}', [GalleryController::class, 'update'])->name('admin.gallery.update'); // Updated to include 'admin.'
        Route::delete('/{id}', [GalleryController::class, 'destroy'])->name('admin.gallery.destroy'); // Updated to include 'admin.'
    });
    
    
    // Package Management
    Route::prefix('admin/packages')->name('admin.packages.')->group(function () {
        Route::get('/', [AdminPackageController::class, 'index'])->name('index');
        Route::get('/create', [AdminPackageController::class, 'create'])->name('create');
        Route::post('/store', [AdminPackageController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [AdminPackageController::class, 'edit'])->name('edit');
        Route::put('/{id}', [AdminPackageController::class, 'update'])->name('update');
        Route::delete('/{id}', [AdminPackageController::class, 'destroy'])->name('destroy');
    });

    // Booking Management
    Route::post('/admin/bookings/cancel/{id}', [AdminDashboardController::class, 'cancelBooking'])->name('admin.booking.cancel');
    Route::post('/admin/packages/{id}/toggleBooking', [AdminPackageController::class, 'toggleBooking'])->name('admin.packages.toggleBooking');
    Route::post('admin/bookings/{booking}/update-payment-status', [BookingController::class, 'updatePaymentStatus'])->name('admin.booking.updatePaymentStatus');



    Route::get('admin/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::post('admin/settings/contact', [SettingsController::class, 'updateContact'])->name('settings.updateContact');
    Route::post('admin/settings/about', [SettingsController::class, 'updateAbout'])->name('settings.updateAbout');
    Route::delete('admin/settings/contact', [SettingsController::class, 'deleteContact'])->name('settings.deleteContact');
    Route::delete('admin/settings/about', [SettingsController::class, 'deleteAbout'])->name('settings.deleteAbout');


    Route::get('admin/users', [UserManagementController::class, 'index'])->name('admin.users.index');
    Route::patch('admin/users/{id}/update-role', [UserManagementController::class, 'updateRole'])->name('admin.users.updateRole');
    Route::delete('/admin/users/{id}', [UserManagementController::class, 'destroy'])->name('admin.users.destroy');
    // Route to show the form to create a new user
    Route::get('admin/users/create', [UserManagementController::class, 'create'])->name('admin.users.create');

// Route to store the new user in the database
    Route::post('admin/users/store', [UserManagementController::class, 'store'])->name('admin.users.store');
    
    Route::get('/admin/users/{id}/edit', [UserManagementController::class, 'edit'])->name('admin.users.edit');
Route::patch('/admin/users/{id}', [UserManagementController::class, 'update'])->name('admin.users.update');

    


    // Password Change
    Route::get('/admin/password/change', [ChangePasswordController::class, 'showChangePasswordForm'])->name('admin.password.change');
    Route::post('/admin/password/update', [ChangePasswordController::class, 'updatePassword'])->name('admin.password.update');



    // Other necessary routes for your admin panel can go here
});
Route::middleware(['auth'])->group(function () {
    Route::get('change-password', [ChangePasswordController::class, 'showChangePasswordForm'])->name('password.change');
    Route::post('change-password', [ChangePasswordController::class, 'updatePassword'])->name('password.update');
});
Route::post('/customer/update-profile', [CustomerDashboardController::class, 'updateProfile'])->name('customer.updateProfile');

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



// Admin routes for managing reviews
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::resource('reviews', ReviewController::class)->except(['create', 'show']);
});
// Authentication Routes
require __DIR__.'/auth.php';