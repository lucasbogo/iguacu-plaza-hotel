<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Video;

class AdminVideoContoller extends Controller
{
    public function index()
    {
        $videos = Video::get();
        return view('admin.videos.video_view', compact('videos'));
    }
}
