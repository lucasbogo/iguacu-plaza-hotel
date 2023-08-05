<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;

class TermsController extends Controller
{
    public function index()
    {
        $terms = Page::where('id',  1)->first();
        return view('frontend.pages.terms', compact('terms'));
    }
    
}
