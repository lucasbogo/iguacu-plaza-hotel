<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;

class AdminSliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::get();
        return view('admin.slide_view', compact('sliders'));
    }

    public function add()
    {
        return view('admin.slide_add');
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
        $slider->save();

        return redirect()->back()->with('success', 'Foto Adicionado ao Slider com Sucesso!');
    }

    public function edit($id)
    {
        $slider = Slider::where('id', $id)->first();
        return view('admin.slide_edit', compact('slider'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'photo' => 'image|mimes:jpg,jpeg,png,gif,svg|max:2048',

        ]);

        $slider = Slider::where('id', $request->id)->first();

        if ($request->file('photo')) {
            $image = $request->file('photo');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/slider'), $image_name);
            $slider->photo = $image_name;
        }

        $slider->heading = $request->heading;
        $slider->text = $request->text;
        $slider->button_text = $request->button_text;
        $slider->button_url = $request->button_url;
        $slider->save();

        return redirect()->back()->with('success', 'Foto Atualizada com Sucesso!');
    }

    public function delete($id)
    {
        $slider = Slider::where('id', $id)->first();
        $slider->delete();
        return redirect()->back()->with('success', 'Foto Excluída com Sucesso!');
    }
}
