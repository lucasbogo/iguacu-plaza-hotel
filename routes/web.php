<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\WebsiteController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\Admin\AdminProfileController;


/* home route */

Route::get('/', [WebsiteController::class, 'index'])->name('home');

/* User Routes */

Route::get('/dashboard', [WebsiteController::class, 'dashboard'])->name('dashboard')->middleware('auth');

Route::get('/login', [WebsiteController::class, 'login'])->name('login');

Route::post('/login_submit', [WebsiteController::class, 'login_submit'])->name('login_submit');

Route::get('/logout', [WebsiteController::class, 'logout'])->name('logout');

Route::get('/register', [WebsiteController::class, 'register'])->name('register');

Route::post('/register_submit', [WebsiteController::class, 'register_submit'])->name('register_submit');

Route::get('/registration/verify/{token}/{email}', [WebsiteController::class, 'registration_verify']);

Route::get('/logout', [WebsiteController::class, 'logout'])->name('logout');

Route::get('/forget-password', [WebsiteController::class, 'forget_password'])->name('forget_password');

Route::post('/forget_password_submit', [WebsiteController::class, 'forget_password_submit'])->name('forget_password_submit');

Route::get('/reset-password/{token}/{email}', [WebsiteController::class, 'reset_password'])->name('reset_password');

Route::post('/reset_password_submit', [WebsiteController::class, 'reset_password_submit'])->name('reset_password_submit');

/* Admin Routes */

Route::get('/admin/home', [AdminHomeController::class, 'index'])->name('admin_home')->middleware('admin:admin');

Route::get('/admin/login', [AdminController::class, 'login'])->name('admin_login');

Route::post('/admin/login-submit', [AdminController::class, 'login_submit'])->name('admin_login_submit');

Route::get('/admin/forget-password', [AdminController::class, 'forget_password'])->name('admin_forget_password');

Route::post('/admin/forget-password-submit', [AdminController::class, 'forget_password_submit'])->name('admin_forget_password_submit');

Route::get('/admin/reset-password/{token}/{email}', [AdminController::class, 'reset_password'])->name('admin_reset_password');

Route::post('/admin/reset-password-submit', [AdminController::class, 'reset_password_submit'])->name('admin_reset_password_submit');

Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin_dashboard')->middleware('admin:admin');

Route::get('/admin/settings', [AdminController::class, 'settings'])->name('admin_settings')->middleware('admin:admin');

Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin_logout');

Route::get('/admin/profile', [AdminProfileController::class, 'index'])->name('admin_profile')->middleware('admin:admin');


