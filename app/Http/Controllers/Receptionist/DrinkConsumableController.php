<?php

namespace App\Http\Controllers\Receptionist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DrinkConsumable;

class DrinkConsumableController extends Controller
{
    public function index()
    {
        $drinkConsumables = DrinkConsumable::all();
        return view('receptionist.drink-consumables.index', compact('drinkConsumables'));
    }

    public function create()
    {
        return view('receptionist.drink-consumables.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'cost' => 'required|numeric',
        ]);

        DrinkConsumable::create($request->all());

        return redirect()->route('receptionist.drink-consumables.index')
            ->with('success', 'Consumível de bebida criado com sucesso.');
    }

    public function edit(DrinkConsumable $drinkConsumable)
    {
        return view('receptionist.drink-consumables.edit', compact('drinkConsumable'));
    }

    public function update(Request $request, DrinkConsumable $drinkConsumable)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'cost' => 'required|numeric',
        ]);

        $drinkConsumable->update($request->all());

        return redirect()->route('receptionist.drink-consumables.index')
            ->with('success', 'Consumível de bebida atualizado com sucesso.');
    }

    public function destroy(DrinkConsumable $drinkConsumable)
    {
        $drinkConsumable->delete();

        return redirect()->route('receptionist.drink-consumables.index')
            ->with('success', 'Consumível de bebida excluído com sucesso.');
    }
}
