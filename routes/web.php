<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\WebsiteController;
use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\AdminSliderController;
use App\Http\Controllers\Admin\AdminFeatureController;
use App\Http\Controllers\Admin\AdminTestimonialController;
use App\Http\Controllers\Admin\AdminBlogController;


/* Frontend Routes */

Route::get('/', [WebsiteController::class, 'index'])->name('home');

Route::get('/about', [AboutController::class, 'index'])->name('about');

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

Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin_logout');

Route::get('/admin/profile', [AdminProfileController::class, 'index'])->name('admin_profile')->middleware('admin:admin');

Route::post('/admin/profile-update', [AdminProfileController::class, 'update'])->name('admin_profile_update')->middleware('admin:admin');

/* Routes Admin Slider Photos*/

Route::get('/admin/slide/view', [AdminSliderController::class, 'index'])->name('admin_slider')->middleware('admin:admin');

Route::get('/admin/slide/add', [AdminSliderController::class, 'add'])->name('admin_slider_add')->middleware('admin:admin');

Route::post('/admin/slide/store', [AdminSliderController::class, 'store'])->name('admin_slider_store')->middleware('admin:admin');

Route::get('/admin/slide/edit/{id}', [AdminSliderController::class, 'edit'])->name('admin_slider_edit')->middleware('admin:admin');

Route::post('/admin/slide/update/{id}', [AdminSliderController::class, 'update'])->name('admin_slider_update')->middleware('admin:admin');

Route::get('/admin/slide/delete/{id}', [AdminSliderController::class, 'delete'])->name('admin_slider_delete')->middleware('admin:admin');

/* Routes Admin Features */

Route::get('/admin/feature/view', [AdminFeatureController::class, 'index'])->name('admin_feature')->middleware('admin:admin');

Route::get('/admin/feature/add', [AdminFeatureController::class, 'add'])->name('admin_feature_add')->middleware('admin:admin');

Route::post('/admin/feature/store', [AdminFeatureController::class, 'store'])->name('admin_feature_store')->middleware('admin:admin');

Route::get('/admin/feature/edit/{id}', [AdminFeatureController::class, 'edit'])->name('admin_feature_edit')->middleware('admin:admin');

Route::post('/admin/feature/update/{id}', [AdminFeatureController::class, 'update'])->name('admin_feature_update')->middleware('admin:admin');

Route::get('/admin/feature/delete/{id}', [AdminFeatureController::class, 'delete'])->name('admin_feature_delete')->middleware('admin:admin');

/* Routes Admin Testimonials */

Route::get('/admin/testimonial/view', [AdminTestimonialController::class, 'index'])->name('admin_testimonial')->middleware('admin:admin');

Route::get('/admin/testimonial/add', [AdminTestimonialController::class, 'add'])->name('admin_testimonial_add')->middleware('admin:admin');

Route::post('/admin/testimonial/store', [AdminTestimonialController::class, 'store'])->name('admin_testimonial_store')->middleware('admin:admin');

Route::get('/admin/testimonial/edit/{id}', [AdminTestimonialController::class, 'edit'])->name('admin_testimonial_edit')->middleware('admin:admin');

Route::post('/admin/testimonial/update/{id}', [AdminTestimonialController::class, 'update'])->name('admin_testimonial_update')->middleware('admin:admin');

Route::get('/admin/testimonial/delete/{id}', [AdminTestimonialController::class, 'delete'])->name('admin_testimonial_delete')->middleware('admin:admin');

/* Routes Admin Blogs */

Route::get('/admin/blog/view', [AdminBlogController::class, 'index'])->name('admin_blog')->middleware('admin:admin');

Route::get('/admin/blog/add', [AdminBlogController::class, 'add'])->name('admin_blog_add')->middleware('admin:admin');

Route::post('/admin/blog/store', [AdminBlogController::class, 'store'])->name('admin_blog_store')->middleware('admin:admin');

Route::get('/admin/blog/edit/{id}', [AdminBlogController::class, 'edit'])->name('admin_blog_edit')->middleware('admin:admin');

Route::post('/admin/blog/update/{id}', [AdminBlogController::class, 'update'])->name('admin_blog_update')->middleware('admin:admin');

Route::get('/admin/blog/delete/{id}', [AdminBlogController::class, 'delete'])->name('admin_blog_delete')->middleware('admin:admin');





