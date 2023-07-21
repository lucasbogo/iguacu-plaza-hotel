<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Image;

class AdminImageController extends Controller
{
    public function index()
    {
        $images = Image::get();
        return view('admin.images.image_view', compact('images'));
    }

    public function add()
    {
        return view('admin.images.image_add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required',
        ]);

        $image = new Image();
        $image->image = $request->image;
        $image->caption = $request->caption;
        $image->status = $request->has('status'); // Set the status based on the checkbox value (true or false)
        $image->save();

        return back()->with('success', 'Imagem Adicionada com Sucesso!');
    }

    public function edit($id)
    {
        $image = Image::findOrFail($id);
        return view('admin.images.image_edit', compact('image'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'image' => 'sometimes|required',
        ]);

        $image = Image::findOrFail($request->id);

        // Update image if provided
        if ($request->has('image')) {
            $image->image = $request->image;
        }

        // Update caption if provided
        if ($request->has('caption')) {
            $image->caption = $request->caption;
        }

        // Update status if provided
        if ($request->has('status')) {
            $image->status = $request->has('status');
        }

        $image->save();

        return back()->with('success', 'Imagem Atualizada com Sucesso!');
    }

    public function toggleStatus($id)
    {
        $image = Image::findOrFail($id);
        $image->status = !$image->status;
        $image->save();

        return back()->with('success', 'Status da Imagem Atualizado com Sucesso!');
    }

    public function delete($id)
    {
        $image = Image::findOrFail($id);
        $image->delete();

        return back()->with('success', 'Imagem Deletada com Sucesso!');
    }
}
