<?php

namespace App\Http\Controllers\Receptionist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RentalUnit;

class RentalUnitsController extends Controller
{
    // Display a listing of the rental units.
    public function index()
    {
        $rentalUnits = RentalUnit::all();
        return view('receptionist.rental-units.index', compact('rentalUnits'));
    }

    // Show the form for creating a new rental unit.
    public function create()
    {
        return view('receptionist.rental-units.create');
    }

    // Store a newly created rental unit in storage.
    public function store(Request $request)
    {
        $request->validate([
            'number' => 'required|string|max:255|unique:rental_units,number',
            'type' => 'required|in:single,double,couple,triple,quadruple,couple_plus_one,couple_plus_two',
            'status' => 'required|in:available,occupied,maintenance,housekeeping',
            'observations' => 'nullable|string',
        ]);        

        RentalUnit::create($request->all());

        return redirect()->route('receptionist.rental-units.index')->with('success', 'Unidade de locação criada com sucesso.');
    }

    // Show the form for editing the specified rental unit.
    public function edit(RentalUnit $rentalUnit)
    {
        return view('receptionist.rental-units.edit', compact('rentalUnit'));
    }

    // Update the specified rental unit in storage.
    public function update(Request $request, RentalUnit $rentalUnit)
    {
        $request->validate([
            'number' => 'required|string|max:255|unique:rental_units,number',
            'type' => 'required|in:single,double,couple,triple,quadruple,couple_plus_one,couple_plus_two',
            'status' => 'required|in:available,occupied,maintenance,housekeeping',
            'observations' => 'nullable|string',
        ]);
        

        $rentalUnit->update($request->all());

        return redirect()->route('receptionist.rental-units.index')->with('success', 'Unidade de locação atualizada com sucesso.');
    }

    // Remove the specified rental unit from storage.
    public function destroy(RentalUnit $rentalUnit)
    {
        $rentalUnit->delete();
        return redirect()->route('receptionist.rental-units.index')->with('success', 'Unidade de locação excluída com sucesso.');
    }
}
