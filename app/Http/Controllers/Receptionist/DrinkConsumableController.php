<?php

namespace App\Http\Controllers\Receptionist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DrinkConsumable;
use App\Models\Occupant;

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
            'quantity' => 'required|numeric'
        ]);

        DrinkConsumable::create($request->all());

        return redirect()->route('receptionist.drink-consumables.index')
            ->with('success', 'Bebida criada com sucesso.');
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
            'quantity' => 'required|numeric'
        ]);

        $drinkConsumable->update($request->all());

        return redirect()->route('receptionist.drink-consumables.index')
            ->with('success', 'Bebida atualizada com sucesso.');
    }

    public function destroy(DrinkConsumable $drinkConsumable)
    {
        $drinkConsumable->delete();

        return redirect()->route('receptionist.drink-consumables.index')
            ->with('success', 'Bebida excluída com sucesso.');
    }

    public function allOccupantConsumables()
    {
        // This method retrieves all occupants along with their drink consumables,
        // including the pivot table data (quantity and paid status).
        $occupants = Occupant::with('drinkConsumables')->get();

        return view('receptionist.drink-consumables.all-occupant-consumables', compact('occupants'));
    }

    public function paidIndex()
    {
        // Fetch occupants with their drink consumables that are marked as paid
        $occupants = Occupant::whereHas('drinkConsumables', function ($query) {
            $query->where('occupant_drink_consumable.paid', true); // Correctly reference the pivot table and column
        })->with(['drinkConsumables' => function ($query) {
            $query->wherePivot('paid', true); // Filter to include only paid consumables
        }])->get();

        return view('receptionist.drink-consumables.paid-consumables', compact('occupants'));
    }

    public function markAsPaid(Request $request, $occupantId, $drinkConsumableId)
    {
        $occupant = Occupant::findOrFail($occupantId);
        $drinkConsumable = $occupant->drinkConsumables()->findOrFail($drinkConsumableId);

        // Assuming the pivot table is named 'drink_consumable_occupant' and has a 'paid' column
        $drinkConsumable->pivot->paid = true;
        $drinkConsumable->pivot->save();

        return redirect()->route('receptionist.drink-consumables.index')->with('success', 'Bebida paga com sucesso.');
    }
}
