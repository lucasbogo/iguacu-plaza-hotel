<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Video;

class VideoGalleryController extends Controller
{
    public function index()
    {
        $videos = Video::paginate(12);
        return view('frontend.pages.video_gallery', compact('videos'));
    }
}
