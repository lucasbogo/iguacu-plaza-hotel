<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebsiteController;



Route::get('/',[WebsiteController::class,'index'])->name('home');

Route::get('/dashboard', [WebsiteController::class,'dashboard'])->name('dashboard');

Route::get('/login', [WebsiteController::class,'login'])->name('login');

Route::get('/register', [WebsiteController::class,'register'])->name('register');
Route::post('/register_submit', [WebsiteController::class,'register_submit'])->name('register_submit');

Route::get('/logout', [WebsiteController::class,'logout'])->name('logout');

Route::get('/forget-password', [WebsiteController::class,'forget_password'])->name('forget-password');