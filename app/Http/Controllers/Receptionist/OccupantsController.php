<?php

namespace App\Http\Controllers\Receptionist;

use App\Http\Controllers\Controller;
use App\Models\Occupant;
use Illuminate\Http\Request;
use App\Models\RentalUnit;
use Barryvdh\DomPDF\Facade\Pdf;


class OccupantsController extends Controller
{
    // Display a listing of the occupants
    public function index()
    {
        $occupants = Occupant::with('rentalUnit')->get();
        return view('receptionist.occupant.index', compact('occupants'));
    }

    // Show the form for creating a new occupant
    public function create()
    {
        $rentalUnits = RentalUnit::all();
        return view('receptionist.occupant.create', compact('rentalUnits'));
    }

    // Store a newly created occupant in storage
    public function store(Request $request)
    {
        $request->validate([
            'rental_unit_id' => 'required|exists:rental_units,id',
            'name' => 'required|string|max:255',
            'check_in' => 'required|date',
            'check_out' => 'nullable|date|after_or_equal:check_in',
            'rent_amount' => 'required|numeric',
            'payment_date' => 'required|date',
            'transfer_date' => 'nullable|date|after_or_equal:check_in',
            'transfer_reason' => 'nullable|string|max:1000',
        ]);

        Occupant::create($request->all());

        return redirect()->route('receptionist.occupants.index')->with('success', 'Ocupante criado com sucesso.');
    }

    // Show the form for editing the specified occupant
    public function edit(Occupant $occupant)
    {
        $rentalUnits = RentalUnit::all();
        return view('receptionist.occupant.edit', compact('occupant', 'rentalUnits'));
    }

    public function update(Request $request, Occupant $occupant)
    {
        $request->validate([
            'rental_unit_id' => 'required|exists:rental_units,id',
            'name' => 'required|string|max:255',
            'check_in' => 'required|date',
            'check_out' => 'nullable|date|after_or_equal:check_in',
            'rent_amount' => 'required|numeric',
            'payment_date' => 'required|date',
        ]);

        // Update common fields
        $occupant->update($request->only(['name', 'check_in', 'check_out', 'rent_amount', 'payment_date']));

        // Check if this is a transfer request
        if ($request->filled('new_rental_unit_id') && $request->new_rental_unit_id != $occupant->rental_unit_id) {
            // Validate transfer fields
            $request->validate([
                'new_rental_unit_id' => 'required|exists:rental_units,id',
                'transfer_date' => 'required|date',
                'transfer_reason' => 'nullable|string',
            ]);

            // Handle transfer
            $occupant->update([
                'rental_unit_id' => $request->new_rental_unit_id,
                'transfer_date' => $request->transfer_date,
                'transfer_reason' => $request->transfer_reason,
            ]);
        }

        return redirect()->route('receptionist.occupants.index')->with('success', 'Ocupante atualizado com sucesso.');
    }

    // Remove the specified occupant from storage
    public function destroy(Occupant $occupant)
    {
        $occupant->delete();
        return redirect()->route('receptionist.occupants.index')->with('success', 'Ocupante excluído com sucesso.');
    }

    public function transfer(Request $request, Occupant $occupant)
    {
        $request->validate([
            'new_rental_unit_id' => 'required|exists:rental_units,id',
            'transfer_date' => 'required|date',
            'transfer_reason' => 'nullable|string',
        ]);

        $occupant->update([
            'rental_unit_id' => $request->new_rental_unit_id,
            'transfer_date' => $request->transfer_date,
            'transfer_reason' => $request->transfer_reason,
        ]);

        return redirect()->route('receptionist.occupants.index')->with('success', 'Occupant transferred successfully.');
    }

    public function printPDF()
    {
        $occupants = Occupant::with('rentalUnit')->get();
        $pdf = PDF::loadView('receptionist.occupant.print', compact('occupants'));
        return $pdf->download('occupants.pdf');
    }
}
