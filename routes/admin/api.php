<?php

use App\Http\Controllers\Admin\Auth\{LoginController, NewPasswordController, PasswordResetLinkController, ResetPasswordController};
use App\Http\Controllers\Admin\ProfileController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [LoginController::class, 'login'])->name('login');

// Forget Password Routes
Route::post('/forget-password', [PasswordResetLinkController::class, 'store'])->name('forget.password');
Route::post('/reset-password', [NewPasswordController::class, 'store'])->name('reset.password');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'getProfile'])->name('get.profile');
    Route::post('/profile/update', [ProfileController::class, 'updateProfile'])->name('update.profile');
});
