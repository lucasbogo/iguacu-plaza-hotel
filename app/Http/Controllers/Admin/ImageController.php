<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Image;

class ImageController extends Controller
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
            'photo' => 'required|image|mimes:jpg,jpeg,png,gif,svg|max:2048',

        ]);

        $image = $request->file('photo');
        $image_name = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('uploads/image'), $image_name);

        $newImage = new Image();
        $newImage->photo = $image_name;
        $newImage->caption = $request->caption;
        $newImage->status = $request->has('status'); // Set the status based on the checkbox value (true or false)
        $newImage->save();

        return back()->with('success', 'Imagem Adicionada com Sucesso!');
    }

    public function update(Request $request)
    {
        $request->validate([
            'image' => 'sometimes|required',
            'caption' => 'required',
        ]);

        $image = Image::findOrFail($request->id);

        if ($request->hasFile('photo')) {
            // Process and save the uploaded photo
            $uploadedImage = $request->file('photo');
            $image_name = time() . '.' . $uploadedImage->getClientOriginalExtension();
            $uploadedImage->move(public_path('uploads/image'), $image_name);
            $image->photo = $image_name;
        }

        // Update caption if provided
        $image->caption = $request->caption;

        // Update status if provided
        $image->status = $request->has('status');

        $image->save();

        return back()->with('success', 'Imagem Atualizada com Sucesso!');
    }

    public function toggleStatus($id)
    {
        $image = Image::findOrFail($id);
        $image->status = !$image->status;
        $image->save();
        
        $message = $image->status ? 'Imagem Ativada com Sucesso' : 'Imagem Desativa com Sucesso';
        return back()->with('success', $message);
    }

    public function delete($id)
    {
        $image = Image::findOrFail($id);
        $image->delete();

        return back()->with('success', 'Imagem Deletada com Sucesso!');
    }
}
