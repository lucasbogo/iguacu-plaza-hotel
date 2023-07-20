<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Mail\Websitemail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Models\Slider;
use App\Models\Feature;
use App\Models\Testimonial;


class WebsiteController extends Controller
{
    public function index()
    {
        $sliders = Slider::get();
        $features = Feature::get();
        $testimonials = Testimonial::get();

        return view('frontend.home', compact('sliders', 'features', 'testimonials'));
    }
}
