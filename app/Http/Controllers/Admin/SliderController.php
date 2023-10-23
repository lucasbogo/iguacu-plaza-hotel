<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;

class SliderController extends Controller
{

    public function index()
    {
        $sliders = Slider::all();
        return view('admin.slider.slide_view', compact('sliders'));
    }

    public function add()
    {
        return view('admin.slider.slide_add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpg,jpeg,png,gif,svg|max:2048',

        ]);

        $image = $request->file('photo');
        $image_name = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('uploads/slider'), $image_name);

        $slider = new Slider();
        $slider->photo = $image_name;
        $slider->heading = $request->heading;
        $slider->text = $request->text;
        $slider->button_text = $request->button_text;
        $slider->button_url = $request->button_url;
        $slider->status = $request->has('status') ? 1 : 0;
        $slider->save();

        return redirect()->back()->with('success', 'Foto Adicionado ao Slider com Sucesso!');
    }

    public function edit($id)
    {
        $slider = Slider::where('id', $id)->first();
        return view('admin.slider.slide_edit', compact('slider'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'photo' => 'sometimes|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
        ]);

        $slider = Slider::findOrFail($request->id);

        if ($request->hasFile('photo')) {
            // Process and save the uploaded photo
            $image = $request->file('photo');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/slider'), $image_name);
            $slider->photo = $image_name;
        }

        // Update heading if provided
        if ($request->has('heading')) {
            $slider->heading = $request->heading;
        }

        // Update text if provided
        if ($request->has('text')) {
            $slider->text = $request->text;
        }

        // Update button_text if provided
        if ($request->has('button_text')) {
            $slider->button_text = $request->button_text;
        }

        // Update button_url if provided
        if ($request->has('button_url')) {
            $slider->button_url = $request->button_url;
        }

        // Update status if provided
        if ($request->has('status')) {
            $slider->status = $request->has('status') ? 1 : 0;
        }

        $slider->save();

        return redirect()->back()->with('success', 'Foto Atualizada com Sucesso!');
    }

    public function activate($id)
    {
        $slider = Slider::findOrFail($id);
        $slider->status = !$slider->status; // Toggle the status (activate if deactivated, and vice versa)
        $slider->save();

        return back()->with('success', 'Foto Ativada com Sucesso!');
    }

    public function deactivate($id)
    {
        $slider = Slider::findOrFail($id);
        $slider->status = 0; // Deactivate the slider
        $slider->save();

        return back()->with('success', 'Foto Desativada com Sucesso!');
    }

    public function delete($id)
    {
        $slider = Slider::findOrFail($id);

        // Delete associated image
        $imagePath = public_path('uploads/slider/' . $slider->photo);

        // Alternatively, you can use the Storage facade for better file handling
        // $imagePath = storage_path('app/public/uploads/slider/' . $slider->photo);

        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        // Delete slider
        $slider->delete();

        return back()->with('success', 'Foto Deletada com Sucesso!');
    }
}
