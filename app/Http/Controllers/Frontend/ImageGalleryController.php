<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Image;

class ImageGalleryController extends Controller
{
    public function index()
    {
        $images = Image::paginate(12);
        return view('frontend.image_gallery', compact('images'));
    }
}
