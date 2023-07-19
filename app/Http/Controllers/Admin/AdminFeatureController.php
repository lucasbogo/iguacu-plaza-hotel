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
        $feature->save();

        return back()->with('success', 'Ícone Adicionado com Sucesso!');
    }

    public function edit($id)
    {
        $feature = Feature::where('id', $id)->first();
        return view('admin.features.feature_edit', compact('feature'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'icon' => 'required',
            'heading' => 'required',
        ]); 

        $feature = Feature::where('id', $request->id)->first();
        $feature->icon = $request->icon;
        $feature->heading = $request->heading;
        $feature->text = $request->text;
        $feature->save();

        return back()->with('success', 'Ícone Atualizado com Sucesso!');
    }

    public function delete($id)
    {
        $feature = Feature::where('id', $id)->first();
        $feature->delete();

        return back()->with('success', 'Ícone Deletado com Sucesso!');
    }


}

