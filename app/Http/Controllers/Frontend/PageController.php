<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Video;
use App\Models\Image;
use App\Models\Faq;

class PageController extends Controller
{
    public function image_gallery()
    {
        $images = Image::paginate(12);
        return view('frontend.pages.image_gallery', compact('images'));
    }

    public function video_gallery()
    {
        $videos = Video::paginate(12);
        return view('frontend.pages.video_gallery', compact('videos'));
    }

    public function faq()
    {
        $faqs = Faq::get();
        return view('frontend.pages.faq', compact('faqs'));
    }

    public function about()
    {
        $about = Page::where('id',  1)->first();
        return view('frontend.pages.about', compact('about'));
    }

    public function terms()
    {
        $terms = Page::where('id',  1)->first();
        return view('frontend.pages.terms', compact('terms'));
    }

    public function privacy()

    {
        $privacy = Page::where('id',  1)->first();
        return view('frontend.pages.privacy', compact('privacy'));
    }
}
