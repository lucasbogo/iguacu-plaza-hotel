<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AuthController as AdminAuthController;
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
use App\Http\Controllers\Admin\SubscribersController;
use App\Http\Controllers\Admin\AmenityController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DateController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\SettingController;


use App\Http\Controllers\Frontend\WebsiteController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\BookingController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\Frontend\RoomsController;
use App\Http\Controllers\Frontend\SubscriberController;

use App\Http\Controllers\Customer\AuthController as CustomerAuthController;
use App\Http\Controllers\Customer\HomeController as CustomerHomeController;
use App\Http\Controllers\Customer\ProfileController as CustomerProfileController;
use App\Http\Controllers\Customer\OrderController as CustomerOrderController;

use App\Http\Controllers\Receptionist\ReceptionistAuthController;
use App\Http\Controllers\Receptionist\DashboardController;
use App\Http\Controllers\Receptionist\ProfileController as ReceptionistProfileController;


/* Frontend Routes */

Route::get('/', [WebsiteController::class, 'index'])->name('home');

// Routes for blogs
Route::get('/blog', [BlogController::class, 'index'])->name('blog');

Route::get('/blog/{id}', [BlogController::class, 'post'])->name('post');

// Routes for contact
Route::get('/contact', [ContactController::class, 'index'])->name('contact');

Route::post('/contact/send-email', [ContactController::class, 'send_email'])->name('contact_send_email');

// Routes for Newsletter Subscribers
Route::post('/subscriber/send-email', [SubscriberController::class, 'send_email'])->name('subscriber_send_email');

Route::get('/subscriber/verify/{email}/{token}', [SubscriberController::class, 'verify'])->name('subscriber_verify');

// Routes for room page on front end
Route::get('/rooms', [RoomsController::class, 'rooms'])->name('rooms');

Route::get('/room/{id}', [RoomsController::class, 'room'])->name('room_detail');

// Routes for Pages
Route::get('/image-gallery', [PageController::class, 'image_gallery'])->name('image_gallery');

Route::get('/video-gallery', [PageController::class, 'video_gallery'])->name('video_gallery');

Route::get('/about', [PageController::class, 'about'])->name('about');

Route::get('/terms', [PageController::class, 'terms'])->name('terms');

Route::get('/privacy', [PageController::class, 'privacy'])->name('privacy');

Route::get('/faq', [PageController::class, 'faq'])->name('faq');

/* Customer Routes */
Route::get('/customer/login', [CustomerAuthController::class, 'login'])->name('customer_login');
Route::post('/customer/login-submit', [CustomerAuthController::class, 'login_submit'])->name('customer_login_submit');
Route::get('/customer/logout', [CustomerAuthController::class, 'logout'])->name('customer_logout');
Route::get('/customer/signup', [CustomerAuthController::class, 'signup'])->name('customer_signup');
Route::post('/customer/signup-submit', [CustomerAuthController::class, 'signup_submit'])->name('customer_signup_submit');
Route::get('/customer/signup-verify/{email}/{token}', [CustomerAuthController::class, 'signup_verify'])->name('customer_signup_verify');
Route::get('/customer/forget-password', [CustomerAuthController::class, 'forget_password'])->name('customer_forget_password');
Route::post('/customer/forget-password-submit', [CustomerAuthController::class, 'forget_password_submit'])->name('customer_forget_password_submit');
Route::get('/customer/reset-password/{token}/{email}', [CustomerAuthController::class, 'customer_reset_password'])->name('customer_reset_password');
Route::post('/customer/reset-password-submit', [CustomerAuthController::class, 'customer_reset_password_submit'])->name('customer_reset_password_submit');

/* Customer Routes with Middleware */
Route::group(['middleware' => ['customer:customer'], 'as' => 'customer.'], function () {
    Route::get('/customer/home', [CustomerHomeController::class, 'index'])->name('customer_home');
    Route::get('/customer/edit-profile', [CustomerProfileController::class, 'profile'])->name('customer_profile');
    Route::post('/customer/edit-profile-submit', [CustomerProfileController::class, 'profile_submit'])->name('customer_profile_submit');
    Route::get('/customer/order/view', [CustomerOrderController::class, 'index'])->name('customer_order_view');
    Route::get('/customer/invoice/{id}', [CustomerOrderController::class, 'invoice'])->name('customer_invoice');
});

/* User Routes */
Route::get('/dashboard', [AdminAuthController::class, 'dashboard'])->name('dashboard')->middleware('auth');

Route::get('/login', [AdminAuthController::class, 'login'])->name('login');

Route::post('/login_submit', [AdminAuthController::class, 'login_submit'])->name('login_submit');

Route::get('/logout', [AdminAuthController::class, 'logout'])->name('logout');

Route::get('/register', [AdminAuthController::class, 'register'])->name('register');

Route::post('/register_submit', [AdminAuthController::class, 'register_submit'])->name('register_submit');

Route::get('/registration/verify/{token}/{email}', [AdminAuthController::class, 'registration_verify']);

Route::get('/logout', [AdminAuthController::class, 'logout'])->name('logout');

Route::get('/forget-password', [AdminAuthController::class, 'forget_password'])->name('forget_password');

Route::post('/forget_password_submit', [AdminAuthController::class, 'forget_password_submit'])->name('forget_password_submit');

Route::get('/reset-password/{token}/{email}', [AdminAuthController::class, 'reset_password'])->name('reset_password');

Route::post('/reset_password_submit', [AdminAuthController::class, 'reset_password_submit'])->name('reset_password_submit');

// Booking functions
Route::post('/booking/submit', [BookingController::class, 'cart_submit'])->name('cart_submit');

Route::get('/cart', [BookingController::class, 'cart_view'])->name('cart');

Route::get('/cart/delete/{id}', [BookingController::class, 'cart_delete'])->name('cart_delete');

Route::get('/checkout', [BookingController::class, 'checkout'])->name('checkout');

Route::post('/payment', [BookingController::class, 'payment'])->name('payment');

Route::post('/payment/stripe/{price}', [BookingController::class, 'stripe'])->name('stripe');


/* Admin Routes */

Route::get('/admin/home', [HomeController::class, 'index'])->name('admin_home')->middleware('admin:admin');

Route::get('/admin/login', [AdminAuthController::class, 'login'])->name('admin_login');

Route::post('/admin/login-submit', [AdminAuthController::class, 'login_submit'])->name('admin_login_submit');

Route::get('/admin/forget-password', [AdminAuthController::class, 'forget_password'])->name('admin_forget_password');

Route::post('/admin/forget-password-submit', [AdminAuthController::class, 'forget_password_submit'])->name('admin_forget_password_submit');

Route::get('/admin/reset-password/{token}/{email}', [AdminAuthController::class, 'reset_password'])->name('admin_reset_password');

Route::post('/admin/reset-password-submit', [AdminAuthController::class, 'reset_password_submit'])->name('admin_reset_password_submit');

Route::get('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin_logout');

Route::get('/admin/profile', [ProfileController::class, 'index'])->name('admin_profile')->middleware('admin:admin');

Route::post('/admin/profile-update', [ProfileController::class, 'update'])->name('admin_profile_update')->middleware('admin:admin');

Route::get('/admin/setting', [SettingController::class, 'index'])->name('admin_setting');

Route::post('/admin/setting/update', [SettingController::class, 'update'])->name('admin_setting_update');

/* Routes Admin Slider Photos*/

Route::get('/admin/slide/view', [SliderController::class, 'index'])->name('admin_slider')->middleware('admin:admin');

Route::get('/admin/slide/add', [SliderController::class, 'add'])->name('admin_slider_add')->middleware('admin:admin');

Route::post('/admin/slide/store', [SliderController::class, 'store'])->name('admin_slider_store')->middleware('admin:admin');

Route::get('/admin/slide/edit/{id}', [SliderController::class, 'edit'])->name('admin_slider_edit')->middleware('admin:admin');

Route::post('/admin/slide/update/{id}', [SliderController::class, 'update'])->name('admin_slider_update')->middleware('admin:admin');

Route::put('/admin/slider/activate/{id}', [SliderController::class, 'activate'])->name('admin_slider_activate')->middleware('admin:admin');

Route::put('/admin/slider/deactivate/{id}', [SliderController::class, 'deactivate'])->name('admin_slider_deactivate')->middleware('admin:admin');

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

/* Routes Admin Amenities */

Route::get('/admin/amenity/view', [AmenityController::class, 'index'])->name('admin_amenity')->middleware('admin:admin');

Route::get('/admin/amenity/add', [AmenityController::class, 'add'])->name('admin_amenity_add')->middleware('admin:admin');

Route::post('/admin/amenity/store', [AmenityController::class, 'store'])->name('admin_amenity_store')->middleware('admin:admin');

Route::get('/admin/amenity/edit/{id}', [AmenityController::class, 'edit'])->name('admin_amenity_edit')->middleware('admin:admin');

Route::post('/admin/amenity/update/{id}', [AmenityController::class, 'update'])->name('admin_amenity_update')->middleware('admin:admin');

Route::put('/admin/amenity/activate/{id}', [AmenityController::class, 'activate'])->name('admin_amenity_activate')->middleware('admin:admin');

Route::get('/admin/amenity/delete/{id}', [AmenityController::class, 'delete'])->name('admin_amenity_delete')->middleware('admin:admin');

/* Routes Admin Rooms */

Route::get('/admin/room/view', [RoomController::class, 'index'])->name('admin_room')->middleware('admin:admin');

Route::get('/admin/room/add', [RoomController::class, 'add'])->name('admin_room_add')->middleware('admin:admin');

Route::post('/admin/room/store', [RoomController::class, 'store'])->name('admin_room_store')->middleware('admin:admin');

Route::get('/admin/room/edit/{id}', [RoomController::class, 'edit'])->name('admin_room_edit')->middleware('admin:admin');

Route::post('/admin/room/update/{id}', [RoomController::class, 'update'])->name('admin_room_update')->middleware('admin:admin');

Route::put('/admin/room/activate/{id}', [RoomController::class, 'activate'])->name('admin_room_activate')->middleware('admin:admin');

Route::put('/admin/room/deactivate/{id}', [RoomController::class, 'deactivate'])->name('admin_room_deactivate')->middleware('admin:admin');

Route::get('/admin/room/delete/{id}', [RoomController::class, 'delete'])->name('admin_room_delete')->middleware('admin:admin');

Route::get('/admin/room/gallery/{id}', [RoomController::class, 'gallery'])->name('admin_room_gallery');

Route::post('/admin/room/gallery/store/{id}', [RoomController::class, 'gallery_store'])->name('admin_room_gallery_store');

Route::get('/admin/room/gallery/delete/{id}', [RoomController::class, 'gallery_delete'])->name('admin_room_gallery_delete');

/* Routes Admin Subscribers */

Route::get('/admin/subscribers', [SubscribersController::class, 'show'])->name('admin_subscribers')->middleware('admin:admin');

Route::get('/admin/subscribers/send-email', [SubscribersController::class, 'send_email'])->name('admin_subscribers_send_email')->middleware('admin:admin');

Route::post('/admin/subscribers/send-email-submit', [SubscribersController::class, 'send_email_submit'])->name('admin_subscribers_send_email_submit')->middleware('admin:admin');

/* Routes Admin Booked Rooms */

Route::get('/admin/date', [DateController::class, 'index'])->name('admin_date')->middleware('admin:admin');

Route::post('/admin/date/submit', [DateController::class, 'show'])->name('admin_date_submit')->middleware('admin:admin');

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

// Cart Page
Route::get('/admin/page/cart', [PagesController::class, 'cart'])->name('admin_page_cart')->middleware('admin:admin');

Route::post('admin/page/cart/update', [PagesController::class, 'cart_update'])->name('admin_page_cart_update')->middleware('admin:admin');

// Checkout Page
Route::get('/admin/page/checkout', [PagesController::class, 'checkout'])->name('admin_page_checkout')->middleware('admin:admin');

Route::post('admin/page/checkout/update', [PagesController::class, 'checkout_update'])->name('admin_page_checkout_update')->middleware('admin:admin');

// Payment Page
Route::get('admin/page/payment', [PagesController::class, 'payment'])->name('admin_page_payment')->middleware('admin:admin');

Route::post('admin/page/payment/update', [PagesController::class, 'payment_update'])->name('admin_page_payment_update')->middleware('admin:admin');

// Sign-Up Page
Route::get('admin/page/signup', [PagesController::class, 'signup'])->name('admin_page_signup')->middleware('admin:admin');

Route::post('admin/page/signup/update', [PagesController::class, 'signup_update'])->name('admin_page_signup_update')->middleware('admin:admin');

// Sign-In Page
Route::get('admin/page/signin', [PagesController::class, 'signin'])->name('admin_page_signin')->middleware('admin:admin');

Route::post('admin/page/signin/update', [PagesController::class, 'signin_update'])->name('admin_page_signin_update')->middleware('admin:admin');

// Room Page
Route::get('admin/page/room', [PagesController::class, 'room'])->name('admin_page_room')->middleware('admin:admin');

Route::post('admin/page/room/update', [PagesController::class, 'room_update'])->name('admin_page_room_update')->middleware('admin:admin');

// Forget Password Page
Route::get('admin/page/forget-password', [PagesController::class, 'forget_password'])->name('admin_page_forget_password')->middleware('admin:admin');

Route::post('admin/page/forget-password/update', [PagesController::class, 'forget_password_update'])->name('admin_page_forget_password_update')->middleware('admin:admin');

// Reset Password Page
Route::get('admin/page/reset-password', [PagesController::class, 'reset_password'])->name('admin_page_reset_password')->middleware('admin:admin');

Route::post('admin/page/reset-password/update', [PagesController::class, 'reset_password_update'])->name('admin_page_reset_password_update')->middleware('admin:admin');

// Customer Status Routes
Route::get('/admin/customers', [CustomerController::class, 'index'])->name('admin_customer')->middleware('admin:admin');;

Route::get('/admin/customer/change-status/{id}', [CustomerController::class, 'change_status'])->name('admin_customer_change_status')->middleware('admin:admin');

// Customer Orders Admin
Route::get('/admin/order/view', [AdminOrderController::class, 'index'])->name('admin_orders');

Route::get('/admin/order/invoice/{id}', [AdminOrderController::class, 'invoice'])->name('admin_invoice');

Route::get('/admin/order/delete/{id}', [AdminOrderController::class, 'delete'])->name('admin_order_delete');

// Receptionist Login Routes - No Middleware Required
Route::get('/receptionist/login', [ReceptionistAuthController::class, 'login'])->name('receptionist.login');
Route::post('/receptionist/login-submit', [ReceptionistAuthController::class, 'login_submit'])->name('receptionist.login_submit');

// Receptionist Authenticated Routes
Route::middleware(['auth:receptionist'])->group(function () {
    Route::get('/receptionist/dashboard', [DashboardController::class, 'index'])->name('receptionist.dashboard');
    Route::get('/receptionist/profile', [ReceptionistProfileController::class, 'show'])->name('receptionist.profile.show');
    Route::post('/receptionist/profile/update', [ReceptionistProfileController::class, 'update'])->name('receptionist.profile.update');
    Route::post('/receptionist/redefine-password', [ReceptionistAuthController::class, 'redefinePassword'])->name('receptionist.redefinePassword');
    Route::post('/receptionist/logout', [ReceptionistAuthController::class, 'logout'])->name('receptionist.logout');
});
