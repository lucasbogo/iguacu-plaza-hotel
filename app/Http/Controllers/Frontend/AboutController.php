<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;

class AboutController extends Controller
{
    public function index()
    {
        $page = Page::where('id',  1)->first();
        return view('frontend.about', compact('page'));
    }
}
