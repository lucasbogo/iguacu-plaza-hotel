<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebsiteController;



Route::get('/',[WebsiteController::class,'index'])->name('home');

Route::get('/dashboard', [WebsiteController::class,'dashboard'])->name('dashboard')->middleware('auth');

Route::get('/login', [WebsiteController::class,'login'])->name('login');

Route::post('/login_submit', [WebsiteController::class,'login_submit'])->name('login_submit');

Route::get('/logout', [WebsiteController::class,'logout'])->name('logout');

Route::get('/register', [WebsiteController::class,'register'])->name('register');

Route::post('/register_submit', [WebsiteController::class,'register_submit'])->name('register_submit');

Route::get('/registration/verify/{token}/{email}', [WebsiteController::class,'registration_verify']);

Route::get('/logout', [WebsiteController::class,'logout'])->name('logout');

Route::get('/forget-password', [WebsiteController::class,'forget_password'])->name('forget_password');

Route::post('/forget_password_submit', [WebsiteController::class,'forget_password_submit'])->name('forget_password_submit');