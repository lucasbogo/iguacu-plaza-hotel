<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;


class AdminTestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::get();
        return view('admin.testimonial.testimonial_view', compact('testimonials'));
    }

    public function add()
    {
        return view('admin.testimonial.testimonial_add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'photo' => 'required',
            'name' => 'required',
            'designation' => 'required',
            'comment' => 'required',
        ]);

        $image = $request->file('photo');
        $image_name = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('uploads/testimonial'), $image_name);

        $testimonial = new Testimonial();
        $testimonial->photo = $image_name;
        $testimonial->name = $request->name;
        $testimonial->designation = $request->designation;
        $testimonial->comment = $request->comment;
        $testimonial->save();

        return redirect()->route('admin_testimonial')->with('success', 'Avaliação Adicionada com Sucesso!');
    }

    public function edit($id)
    {
        $testimonial = Testimonial::find($id);
        return view('admin.testimonial.testimonial_edit', compact('testimonial'));
    }

    public function update(Request $request, $id)
    {
        $testimonial = Testimonial::findOrFail($id);

        $request->validate([
            'photo' => 'sometimes|required',
            'name' => 'sometimes|required',
            'designation' => 'sometimes|required',
            'comment' => 'sometimes|required',
        ]);

        if ($request->hasFile('photo')) {
            // Process and save the uploaded photo
            $image = $request->file('photo');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/testimonial'), $image_name);
            $testimonial->photo = $image_name;
        }

        // Update name if provided
        if ($request->has('name')) {
            $testimonial->name = $request->name;
        }

        // Update designation if provided
        if ($request->has('designation')) {
            $testimonial->designation = $request->designation;
        }

        // Update comment if provided
        if ($request->has('comment')) {
            $testimonial->comment = $request->comment;
        }

        $testimonial->save();

        return redirect()->route('admin_testimonial')->with('success', 'Avaliação Atualizada com Sucesso!');
    }

    public function activate($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->status = !$testimonial->status; // Toggle the status (activate if deactivated, and vice versa)
        $testimonial->save();

        $message = $testimonial->status ? 'Avaliação Ativada com Sucesso!' : 'Avaliação Desativada com Sucesso!';
        return redirect()->back()->with('success', $message);
    }

    public function delete($id)
    {
        $testimonial = Testimonial::find($id);
        $testimonial->delete();

        return redirect()->route('admin_testimonial')->with('success', 'Avaliação Deletada com Sucesso!');
    }
}
