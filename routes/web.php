<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\FeatureController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\BlogsController;
use App\Http\Controllers\Admin\ImageController;
use App\Http\Controllers\Admin\VideoController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\PagesController;

use App\Http\Controllers\Frontend\WebsiteController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\ContactController;



/* Frontend Routes */

Route::get('/', [WebsiteController::class, 'index'])->name('home');

// Routes for blogs

Route::get('/blog', [BlogController::class, 'index'])->name('blog');

Route::get('/blog/{id}', [BlogController::class, 'post'])->name('post');

// Routes for contact
Route::get('/contact', [ContactController::class, 'index'])->name('contact');

Route::post('/contact/send-email', [ContactController::class, 'send_email'])->name('contact_send_email');

// Routes for pages

Route::get('/image-gallery', [PageController::class, 'image_gallery'])->name('image_gallery');

Route::get('/video-gallery', [PageController::class, 'video_gallery'])->name('video_gallery');

Route::get('/about', [PageController::class, 'about'])->name('about');

Route::get('/terms', [PageController::class, 'terms'])->name('terms');

Route::get('/privacy', [PageController::class, 'privacy'])->name('privacy');

Route::get('/faq', [PageController::class, 'faq'])->name('faq');


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

Route::get('/admin/home', [HomeController::class, 'index'])->name('admin_home')->middleware('admin:admin');

Route::get('/admin/login', [AdminController::class, 'login'])->name('admin_login');

Route::post('/admin/login-submit', [AdminController::class, 'login_submit'])->name('admin_login_submit');

Route::get('/admin/forget-password', [AdminController::class, 'forget_password'])->name('admin_forget_password');

Route::post('/admin/forget-password-submit', [AdminController::class, 'forget_password_submit'])->name('admin_forget_password_submit');

Route::get('/admin/reset-password/{token}/{email}', [AdminController::class, 'reset_password'])->name('admin_reset_password');

Route::post('/admin/reset-password-submit', [AdminController::class, 'reset_password_submit'])->name('admin_reset_password_submit');

Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin_logout');

Route::get('/admin/profile', [ProfileController::class, 'index'])->name('admin_profile')->middleware('admin:admin');

Route::post('/admin/profile-update', [ProfileController::class, 'update'])->name('admin_profile_update')->middleware('admin:admin');

/* Routes Admin Slider Photos*/

Route::get('/admin/slide/view', [SliderController::class, 'index'])->name('admin_slider')->middleware('admin:admin');

Route::get('/admin/slide/add', [SliderController::class, 'add'])->name('admin_slider_add')->middleware('admin:admin');

Route::post('/admin/slide/store', [SliderController::class, 'store'])->name('admin_slider_store')->middleware('admin:admin');

Route::get('/admin/slide/edit/{id}', [SliderController::class, 'edit'])->name('admin_slider_edit')->middleware('admin:admin');

Route::post('/admin/slide/update/{id}', [SliderController::class, 'update'])->name('admin_slider_update')->middleware('admin:admin');

Route::put('/admin/slider/activate/{id}', [SliderController::class, 'activate'])->name('admin_slider_activate')->middleware('admin:admin');

Route::get('/admin/slide/delete/{id}', [SliderController::class, 'delete'])->name('admin_slider_delete')->middleware('admin:admin');

/* Routes Admin Features */

Route::get('/admin/feature/view', [FeatureController::class, 'index'])->name('admin_feature')->middleware('admin:admin');

Route::get('/admin/feature/add', [FeatureController::class, 'add'])->name('admin_feature_add')->middleware('admin:admin');

Route::post('/admin/feature/store', [FeatureController::class, 'store'])->name('admin_feature_store')->middleware('admin:admin');

Route::get('/admin/feature/edit/{id}', [FeatureController::class, 'edit'])->name('admin_feature_edit')->middleware('admin:admin');

Route::post('/admin/feature/update/{id}', [FeatureController::class, 'update'])->name('admin_feature_update')->middleware('admin:admin');

Route::put('admin/features/{id}/toggle', [FeatureController::class, 'toggleStatus'])->name('admin_feature_toggle')->middleware('admin:admin');

Route::get('/admin/feature/delete/{id}', [FeatureController::class, 'delete'])->name('admin_feature_delete')->middleware('admin:admin');

/* Routes Admin Testimonials */

Route::get('/admin/testimonial/view', [TestimonialController::class, 'index'])->name('admin_testimonial')->middleware('admin:admin');

Route::get('/admin/testimonial/add', [TestimonialController::class, 'add'])->name('admin_testimonial_add')->middleware('admin:admin');

Route::post('/admin/testimonial/store', [TestimonialController::class, 'store'])->name('admin_testimonial_store')->middleware('admin:admin');

Route::get('/admin/testimonial/edit/{id}', [TestimonialController::class, 'edit'])->name('admin_testimonial_edit')->middleware('admin:admin');

Route::post('/admin/testimonial/update/{id}', [TestimonialController::class, 'update'])->name('admin_testimonial_update')->middleware('admin:admin');

Route::get('/admin/testimonial/activate/{id}', [TestimonialController::class, 'activate'])->name('admin_testimonial_activate')->middleware('admin:admin');

Route::get('/admin/testimonial/delete/{id}', [TestimonialController::class, 'delete'])->name('admin_testimonial_delete')->middleware('admin:admin');

/* Routes Admin Blogs */

Route::get('/admin/blog/view', [BlogsController::class, 'index'])->name('admin_blog')->middleware('admin:admin');

Route::get('/admin/blog/add', [BlogsController::class, 'add'])->name('admin_blog_add')->middleware('admin:admin');

Route::post('/admin/blog/store', [BlogsController::class, 'store'])->name('admin_blog_store')->middleware('admin:admin');

Route::get('/admin/blog/edit/{id}', [BlogsController::class, 'edit'])->name('admin_blog_edit')->middleware('admin:admin');

Route::post('/admin/blog/update/{id}', [BlogsController::class, 'update'])->name('admin_blog_update')->middleware('admin:admin');

Route::get('/admin/blog/activate/{id}', [BlogsController::class, 'activate'])->name('admin_blog_activate')->middleware('admin:admin');

Route::get('/admin/blog/delete/{id}', [BlogsController::class, 'delete'])->name('admin_blog_delete')->middleware('admin:admin');

/* Routes Admin Images */

Route::get('/admin/image/view', [ImageController::class, 'index'])->name('admin_image')->middleware('admin:admin');

Route::get('/admin/image/add', [ImageController::class, 'add'])->name('admin_image_add')->middleware('admin:admin');

Route::post('/admin/image/store', [ImageController::class, 'store'])->name('admin_image_store')->middleware('admin:admin');

Route::get('/admin/image/edit/{id}', [ImageController::class, 'edit'])->name('admin_image_edit')->middleware('admin:admin');

Route::post('/admin/image/update/{id}', [ImageController::class, 'update'])->name('admin_image_update')->middleware('admin:admin');

Route::put('admin/images/{id}/toggle', [ImageController::class, 'toggleStatus'])->name('admin_image_toggle');

Route::get('/admin/image/delete/{id}', [ImageController::class, 'delete'])->name('admin_image_delete')->middleware('admin:admin');

/* Routes Admin Videos */

Route::get('/admin/video/view', [VideoController::class, 'index'])->name('admin_video')->middleware('admin:admin');

Route::get('/admin/video/add', [VideoController::class, 'add'])->name('admin_video_add')->middleware('admin:admin');

Route::post('/admin/video/store', [VideoController::class, 'store'])->name('admin_video_store')->middleware('admin:admin');

Route::get('/admin/video/edit/{id}', [VideoController::class, 'edit'])->name('admin_video_edit')->middleware('admin:admin');

Route::put('/admin/video/update/{id}', [VideoController::class, 'update'])->name('admin_video_update')->middleware('admin:admin');

Route::put('admin/videos/{id}/activate', [VideoController::class, 'activate'])->name('admin_video_activate')->middleware('admin:admin');

Route::get('/admin/video/delete/{id}', [VideoController::class, 'delete'])->name('admin_video_delete')->middleware('admin:admin');

/* Routes Admin Faqs */

Route::get('/admin/faq/view', [FaqController::class, 'index'])->name('admin_faq')->middleware('admin:admin');

Route::get('/admin/faq/add', [FaqController::class, 'add'])->name('admin_faq_add')->middleware('admin:admin');

Route::post('/admin/faq/store', [FaqController::class, 'store'])->name('admin_faq_store')->middleware('admin:admin');

Route::get('/admin/faq/edit/{id}', [FaqController::class, 'edit'])->name('admin_faq_edit')->middleware('admin:admin');

Route::post('/admin/faq/update/{id}', [FaqController::class, 'update'])->name('admin_faq_update')->middleware('admin:admin');

Route::put('/admin/faq/activate/{id}', [FaqController::class, 'activate'])->name('admin_faq_activate')->middleware('admin:admin');

Route::get('/admin/faq/delete/{id}', [FaqController::class, 'delete'])->name('admin_faq_delete')->middleware('admin:admin');

/*** Routes Admin Edit Pages Frontend ***/

// About Page
Route::get('/admin/page/about', [PagesController::class, 'about'])->name('admin_page_about')->middleware('admin:admin');

Route::post('/admin/page/about/update', [PagesController::class, 'about_update'])->name('admin_page_about_update')->middleware('admin:admin');

// Terms and Conditions Page
Route::get('/admin/page/terms', [PagesController::class, 'terms'])->name('admin_page_terms')->middleware('admin:admin');

Route::post('/admin/page/terms/update', [PagesController::class, 'terms_update'])->name('admin_page_terms_update')->middleware('admin:admin');

// Privacy Policy Page
Route::get('/admin/page/privacy', [PagesController::class, 'privacy'])->name('admin_page_privacy')->middleware('admin:admin');

Route::post('/admin/page/privacy', [PagesController::class, 'privacy_update'])->name('admin_page_privacy_update')->middleware('admin:admin');

// Image Gallery Page
Route::get('/admin/page/image-gallery', [PagesController::class, 'image_gallery'])->name('admin_page_image_gallery')->middleware('admin:admin');

Route::post('/admin/page/image-gallery/update', [PagesController::class, 'image_gallery_update'])->name('admin_page_image_gallery_update')->middleware('admin:admin');

// Video Gallery Page
Route::get('/admin/page/video-gallery', [PagesController::class, 'video_gallery'])->name('admin_page_video_gallery')->middleware('admin:admin');

Route::post('/admin/page/video-gallery/update', [PagesController::class, 'video_gallery_update'])->name('admin_page_video_gallery_update')->middleware('admin:admin');

// FAQ Page
Route::get('/admin/page/faq', [PagesController::class, 'faq'])->name('admin_page_faq')->middleware('admin:admin');

Route::post('/admin/page/faq/update', [PagesController::class, 'faq_update'])->name('admin_page_faq_update')->middleware('admin:admin');

// Blog Page
Route::get('/admin/page/blog', [PagesController::class, 'blog'])->name('admin_page_blog')->middleware('admin:admin');

Route::post('/admin/page/blog/update', [PagesController::class, 'blog_update'])->name('admin_page_blog_update')->middleware('admin:admin');

// Contact Page
Route::get('/admin/page/contact', [PagesController::class, 'contact'])->name('admin_page_contact')->middleware('admin:admin');

Route::post('/admin/page/contact/update', [PagesController::class, 'contact_update'])->name('admin_page_contact_update')->middleware('admin:admin');
