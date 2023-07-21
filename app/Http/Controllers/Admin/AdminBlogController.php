<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;

class AdminBlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::get();
        return view('admin.blog.blog_view', compact('blogs'));
    }

    public function add()
    {
        return view('admin.blog.blog_add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'photo' => 'required',
            'title' => 'required',
            'author' => 'required',
            'short_content' => 'required',
            'content' => 'required',
        ]);

        $image = $request->file('photo');
        $image_name = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('uploads/blog'), $image_name);

        $blog = new Blog();
        $blog->photo = $image_name;
        $blog->title = $request->title;
        $blog->author = $request->author;
        $blog->short_content = $request->short_content;
        $blog->content = $request->content;
        $blog->save();

        return redirect()->route('admin_blog')->with('success', 'Blog Adicionado com Sucesso!');
    }

    public function edit($id)
    {
        $blog = Blog::find($id);
        return view('admin.blog.blog_edit', compact('blog'));
    }

    public function update(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);

        $request->validate([
            'photo' => 'sometimes|required',
            'title' => 'sometimes|required',
            'author' => 'sometimes',
            'short_content' => 'sometimes|required',
            'content' => 'sometimes|required',
        ]);

        if ($request->hasFile('photo')) {
            // Process and save the uploaded photo
            $image = $request->file('photo');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/blog'), $image_name);
            $blog->photo = $image_name;
        }

        // Update title if provided
        if ($request->has('title')) {
            $blog->title = $request->title;
        }

        // Update author if provided
        if ($request->has('author')) {
            $blog->author = $request->author;
        }

        // Update short_content if provided
        if ($request->has('short_content')) {
            $blog->short_content = $request->short_content;
        }

        // Update content if provided
        if ($request->has('content')) {
            $blog->content = $request->content;
        }

        $blog->save();

        return redirect()->route('admin_blog')->with('success', 'Blog Atualizado com Sucesso!');
    }

    public function delete($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();

        return redirect()->route('admin_blog')->with('success', 'Blog Deletado com Sucesso!');
    }
}
