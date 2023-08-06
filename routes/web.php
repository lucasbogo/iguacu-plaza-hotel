<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\AdminSliderController;
use App\Http\Controllers\Admin\AdminFeatureController;
use App\Http\Controllers\Admin\AdminTestimonialController;
use App\Http\Controllers\Admin\AdminBlogController;
use App\Http\Controllers\Admin\AdminImageController;
use App\Http\Controllers\Admin\AdminVideoController;
use App\Http\Controllers\Admin\AdminFaqController;
use App\Http\Controllers\Admin\AdminPageController;

use App\Http\Controllers\Frontend\WebsiteController;
use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\ImageGalleryController;
use App\Http\Controllers\Frontend\VideoGalleryController;
use App\Http\Controllers\Frontend\FaqController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\TermsController;


/* Frontend Routes */

Route::get('/', [WebsiteController::class, 'index'])->name('home');

Route::get('/blog', [BlogController::class, 'index'])->name('blog');

Route::get('/blog/{id}', [BlogController::class, 'post'])->name('post');

// Routes for pages

Route::get('/image-gallery', [PageController::class, 'image_gallery'])->name('image_gallery');

Route::get('/video-gallery', [PageController::class, 'video_gallery'])->name('video_gallery');

Route::get('/about', [PageController::class, 'about'])->name('about');

Route::get('/terms', [PageController::class, 'terms'])->name('terms');

Route::get('/privacy', [PageController::class, 'privacy'])->name('privacy');

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

Route::put('/admin/slider/activate/{id}', [AdminSliderController::class, 'activate'])->name('admin_slider_activate')->middleware('admin:admin');

Route::get('/admin/slide/delete/{id}', [AdminSliderController::class, 'delete'])->name('admin_slider_delete')->middleware('admin:admin');

/* Routes Admin Features */

Route::get('/admin/feature/view', [AdminFeatureController::class, 'index'])->name('admin_feature')->middleware('admin:admin');

Route::get('/admin/feature/add', [AdminFeatureController::class, 'add'])->name('admin_feature_add')->middleware('admin:admin');

Route::post('/admin/feature/store', [AdminFeatureController::class, 'store'])->name('admin_feature_store')->middleware('admin:admin');

Route::get('/admin/feature/edit/{id}', [AdminFeatureController::class, 'edit'])->name('admin_feature_edit')->middleware('admin:admin');

Route::post('/admin/feature/update/{id}', [AdminFeatureController::class, 'update'])->name('admin_feature_update')->middleware('admin:admin');

Route::put('admin/features/{id}/toggle', [AdminFeatureController::class, 'toggleStatus'])->name('admin_feature_toggle')->middleware('admin:admin');

Route::get('/admin/feature/delete/{id}', [AdminFeatureController::class, 'delete'])->name('admin_feature_delete')->middleware('admin:admin');

/* Routes Admin Testimonials */

Route::get('/admin/testimonial/view', [AdminTestimonialController::class, 'index'])->name('admin_testimonial')->middleware('admin:admin');

Route::get('/admin/testimonial/add', [AdminTestimonialController::class, 'add'])->name('admin_testimonial_add')->middleware('admin:admin');

Route::post('/admin/testimonial/store', [AdminTestimonialController::class, 'store'])->name('admin_testimonial_store')->middleware('admin:admin');

Route::get('/admin/testimonial/edit/{id}', [AdminTestimonialController::class, 'edit'])->name('admin_testimonial_edit')->middleware('admin:admin');

Route::post('/admin/testimonial/update/{id}', [AdminTestimonialController::class, 'update'])->name('admin_testimonial_update')->middleware('admin:admin');

Route::get('/admin/testimonial/activate/{id}', [AdminTestimonialController::class, 'activate'])->name('admin_testimonial_activate')->middleware('admin:admin');

Route::get('/admin/testimonial/delete/{id}', [AdminTestimonialController::class, 'delete'])->name('admin_testimonial_delete')->middleware('admin:admin');

/* Routes Admin Blogs */

Route::get('/admin/blog/view', [AdminBlogController::class, 'index'])->name('admin_blog')->middleware('admin:admin');

Route::get('/admin/blog/add', [AdminBlogController::class, 'add'])->name('admin_blog_add')->middleware('admin:admin');

Route::post('/admin/blog/store', [AdminBlogController::class, 'store'])->name('admin_blog_store')->middleware('admin:admin');

Route::get('/admin/blog/edit/{id}', [AdminBlogController::class, 'edit'])->name('admin_blog_edit')->middleware('admin:admin');

Route::post('/admin/blog/update/{id}', [AdminBlogController::class, 'update'])->name('admin_blog_update')->middleware('admin:admin');

Route::get('/admin/blog/activate/{id}', [AdminBlogController::class, 'activate'])->name('admin_blog_activate')->middleware('admin:admin');

Route::get('/admin/blog/delete/{id}', [AdminBlogController::class, 'delete'])->name('admin_blog_delete')->middleware('admin:admin');

/* Routes Admin Images */

Route::get('/admin/image/view', [AdminImageController::class, 'index'])->name('admin_image')->middleware('admin:admin');

Route::get('/admin/image/add', [AdminImageController::class, 'add'])->name('admin_image_add')->middleware('admin:admin');

Route::post('/admin/image/store', [AdminImageController::class, 'store'])->name('admin_image_store')->middleware('admin:admin');

Route::get('/admin/image/edit/{id}', [AdminImageController::class, 'edit'])->name('admin_image_edit')->middleware('admin:admin');

Route::post('/admin/image/update/{id}', [AdminImageController::class, 'update'])->name('admin_image_update')->middleware('admin:admin');

Route::put('admin/images/{id}/toggle', [AdminImageController::class, 'toggleStatus'])->name('admin_image_toggle');

Route::get('/admin/image/delete/{id}', [AdminImageController::class, 'delete'])->name('admin_image_delete')->middleware('admin:admin');

/* Routes Admin Videos */

Route::get('/admin/video/view', [AdminVideoController::class, 'index'])->name('admin_video')->middleware('admin:admin');

Route::get('/admin/video/add', [AdminVideoController::class, 'add'])->name('admin_video_add')->middleware('admin:admin');

Route::post('/admin/video/store', [AdminVideoController::class, 'store'])->name('admin_video_store')->middleware('admin:admin');

Route::get('/admin/video/edit/{id}', [AdminVideoController::class, 'edit'])->name('admin_video_edit')->middleware('admin:admin');

Route::put('/admin/video/update/{id}', [AdminVideoController::class, 'update'])->name('admin_video_update')->middleware('admin:admin');

Route::put('admin/videos/{id}/activate', [AdminVideoController::class, 'activate'])->name('admin_video_activate')->middleware('admin:admin');

Route::get('/admin/video/delete/{id}', [AdminVideoController::class, 'delete'])->name('admin_video_delete')->middleware('admin:admin');

/* Routes Admin Faqs */

Route::get('/admin/faq/view', [AdminFaqController::class, 'index'])->name('admin_faq')->middleware('admin:admin');

Route::get('/admin/faq/add', [AdminFaqController::class, 'add'])->name('admin_faq_add')->middleware('admin:admin');

Route::post('/admin/faq/store', [AdminFaqController::class, 'store'])->name('admin_faq_store')->middleware('admin:admin');

Route::get('/admin/faq/edit/{id}', [AdminFaqController::class, 'edit'])->name('admin_faq_edit')->middleware('admin:admin');

Route::post('/admin/faq/update/{id}', [AdminFaqController::class, 'update'])->name('admin_faq_update')->middleware('admin:admin');

Route::put('/admin/faq/activate/{id}', [AdminFaqController::class, 'activate'])->name('admin_faq_activate')->middleware('admin:admin');

Route::get('/admin/faq/delete/{id}', [AdminFaqController::class, 'delete'])->name('admin_faq_delete')->middleware('admin:admin');

/*** Routes Admin Edit Pages Frontend ***/

// About Page
Route::get('/admin/page/about', [AdminPageController::class, 'about'])->name('admin_page_about')->middleware('admin:admin');

Route::post('/admin/page/about/update', [AdminPageController::class, 'about_update'])->name('admin_page_about_update')->middleware('admin:admin');

// Terms and Conditions Page
Route::get('/admin/page/terms', [AdminPageController::class, 'terms'])->name('admin_page_terms')->middleware('admin:admin');

Route::post('/admin/page/terms/update', [AdminPageController::class, 'terms_update'])->name('admin_page_terms_update')->middleware('admin:admin');

// Privacy Policy Page
Route::get('/admin/page/privacy', [AdminPageController::class, 'privacy'])->name('admin_page_privacy')->middleware('admin:admin');

Route::post('/admin/page/privacy', [AdminPageController::class, 'privacy_update'])->name('admin_page_privacy_update')->middleware('admin:admin');

// Image Gallery Page
Route::get('/admin/page/image-gallery', [AdminPageController::class, 'image_gallery'])->name('admin_page_image_gallery')->middleware('admin:admin');

Route::post('/admin/page/image-gallery/update', [AdminPageController::class, 'image_gallery_update'])->name('admin_page_image_gallery_update')->middleware('admin:admin');

// Video Gallery Page
Route::get('/admin/page/video-gallery', [AdminPageController::class, 'video_gallery'])->name('admin_page_video_gallery')->middleware('admin:admin');

Route::post('/admin/page/video-gallery/update', [AdminPageController::class, 'video_gallery_update'])->name('admin_page_video_gallery_update')->middleware('admin:admin');

// FAQ Page
Route::get('/admin/page/faq', [AdminPageController::class, 'faq'])->name('admin_page_faq')->middleware('admin:admin');

Route::post('/admin/page/faq/update', [AdminPageController::class, 'faq_update'])->name('admin_page_faq_update')->middleware('admin:admin');

// Blog Page
Route::get('/admin/page/blog', [AdminPageController::class, 'blog'])->name('admin_page_blog')->middleware('admin:admin');

Route::post('/admin/page/blog/update', [AdminPageController::class, 'blog_update'])->name('admin_page_blog_update')->middleware('admin:admin');
