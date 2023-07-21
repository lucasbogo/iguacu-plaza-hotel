<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Feature;

class AdminFeatureController extends Controller
{
    public function index()
    {
        $features = Feature::get();
        return view('admin.features.feature_view', compact('features'));
    }

    public function add()
    {
        return view('admin.features.feature_add');
    }

    // AdminFeatureController.php

    // ...

    public function store(Request $request)
    {
        $request->validate([
            'icon' => 'required',
            'heading' => 'required',
        ]);

        $feature = new Feature();
        $feature->icon = $request->icon;
        $feature->heading = $request->heading;
        $feature->text = $request->text;
        $feature->status = $request->has('status'); // Set the status based on the checkbox value (true or false)
        $feature->save();

        return back()->with('success', 'Ícone Adicionado com Sucesso!');
    }

    public function update(Request $request)
    {
        $request->validate([
            'icon' => 'sometimes|required',
            'heading' => 'sometimes|required',
        ]);

        $feature = Feature::findOrFail($request->id);

        // Update icon if provided
        if ($request->has('icon')) {
            $feature->icon = $request->icon;
        }

        // Update heading if provided
        if ($request->has('heading')) {
            $feature->heading = $request->heading;
        }

        // Update text if provided
        if ($request->has('text')) {
            $feature->text = $request->text;
        }

        // Update status if provided
        if ($request->has('status')) {
            $feature->status = $request->has('status');
        }

        $feature->save();

        return back()->with('success', 'Ícone Atualizado com Sucesso!');
    }

    public function toggleStatus($id)
    {
        $feature = Feature::findOrFail($id);
        $feature->status = !$feature->status; // Toggle the status (active to inactive or vice versa)
        $feature->save();

        return back()->with('success', 'Status do Ícone Atualizado com Sucesso!');
    }


    public function delete($id)
    {
        $feature = Feature::where('id', $id)->first();
        $feature->delete();

        return back()->with('success', 'Ícone Deletado com Sucesso!');
    }
}
