<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::orderBy('id', 'desc')->paginate(9);
        return view('frontend.pages.blog', compact('blogs'));
    }

    public function post($id)
    {
        $blog = Blog::find($id);

        if ($blog) {
            // Update the views count
            $blog->views = $blog->views + 1;
            $blog->save();

            return view('frontend.pages.post', compact('blog'));
        } else {
            // Blog not found, handle the error
            return redirect()->route('home')->with('error', 'Blog não encontrado.');
        }
    }
}
