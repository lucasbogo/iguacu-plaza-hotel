<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Amenity;

class AmenityController extends Controller
{
    public function index()
    {
        $amenities = Amenity::get();
        return view('admin.amenity.amenity_view', compact('amenities'));
    }

    public function add()
    {
        return view('admin.amenity.amenity_add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $amenities = new Amenity();
        $amenities->name = $request->name;
        $amenities->save();

        return redirect()->route('admin_amenity')->with('success', 'Comodidade Adicionado com Sucesso!');
    }

    public function edit($id)
    {
        $amenities = Amenity::findOrFail($id);
        return view('admin.amenity.amenity_edit', compact('amenities'));
    }


    public function update(Request $request, $id)
    {
        $amenities = Amenity::findOrFail($id);

        $request->validate([
            'name' => 'sometimes|required',
        ]);

        $amenities->name = $request->name;
        $amenities->save();

        return redirect()->route('admin_amenity')->with('success', 'Comodidade Atualizado com Sucesso!');
    }

    public function activate($id)
    {
        $amenities = Amenity::findOrFail($id);
        $amenities->status = !$amenities->status; // Toggle the status (if it's 1, make it 0, and vice versa)
        $amenities->save();

        return redirect()->route('admin_amenity')->with('success', 'Comodidade Ativada/Desativada com Sucesso!');
    }

    public function delete($id)
    {
        $amenities = Amenity::findOrFail($id);
        $amenities->delete();

        return redirect()->route('admin_amenity')->with('success', 'Comodidade Deletado com Sucesso!');
    }
}
