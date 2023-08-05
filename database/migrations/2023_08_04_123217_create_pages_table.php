<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->text('about_heading');
            $table->text('about_content');
            $table->boolean('about_status')->default(1);
            $table->text('terms_heading');
            $table->text('terms_content');
            $table->boolean('terms_status')->default(1);
            $table->text('privacy_heading');
            $table->text('privacy_content');
            $table->boolean('privacy_status')->default(1);
            $table->text('contact_heading');
            $table->text('contact_map')->nullable();
            $table->boolean('contact_status')->default(1);
            $table->text('photo_gallery_heading');
            $table->boolean('photo_gallery_status')->default(1);
            $table->text('video_gallery_heading');
            $table->boolean('video_gallery_status')->default(1);
            $table->text('faq_heading');
            $table->boolean('faq_status')->default(1);
            $table->text('blog_heading');
            $table->boolean('blog_status')->default(1);
            $table->text('room_heading');
            $table->text('cart_heading');
            $table->boolean('cart_status')->default(1);
            $table->text('checkout_heading');
            $table->boolean('checkout_status')->default(1);
            $table->text('payment_heading');
            $table->text('signup_heading');
            $table->boolean('signup_status')->default(1);
            $table->text('signin_heading');
            $table->boolean('signin_status')->default(1);
            $table->text('forget_password_heading');
            $table->text('reset_password_heading');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
