<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebsiteController;



Route::get('/',[WebsiteController::class,'index'])->name('home');

Route::get('/dashboard-admin', [WebsiteController::class,'dashboard_admin'])->name('dashboard_admin')->middleware('auth');

Route::get('/dashboard-user', [WebsiteController::class,'dashboard_user'])->name('dashboard_user')->middleware('auth');

Route::get('/settings', [WebsiteController::class,'settings'])->name('settings')->middleware('auth');

Route::get('/login', [WebsiteController::class,'login'])->name('login');

Route::post('/login_submit', [WebsiteController::class,'login_submit'])->name('login_submit');

Route::get('/logout', [WebsiteController::class,'logout'])->name('logout');

Route::get('/register', [WebsiteController::class,'register'])->name('register');

Route::post('/register_submit', [WebsiteController::class,'register_submit'])->name('register_submit');

Route::get('/registration/verify/{token}/{email}', [WebsiteController::class,'registration_verify']);

Route::get('/logout', [WebsiteController::class,'logout'])->name('logout');

Route::get('/forget-password', [WebsiteController::class,'forget_password'])->name('forget_password');

Route::post('/forget_password_submit', [WebsiteController::class,'forget_password_submit'])->name('forget_password_submit');

Route::get('/reset-password/{token}/{email}', [WebsiteController::class,'reset_password'])->name('reset_password');

Route::post('/reset_password_submit', [WebsiteController::class,'reset_password_submit'])->name('reset_password_submit');