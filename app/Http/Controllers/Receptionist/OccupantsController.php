<?php

namespace App\Http\Controllers\Receptionist;

use App\Http\Controllers\Controller;
use App\Models\Occupant;
use App\Models\DrinkConsumable;
use Illuminate\Http\Request;
use App\Models\RentalUnit;
use Barryvdh\DomPDF\Facade\Pdf;


class OccupantsController extends Controller
{
    // Display a listing of the occupants
    public function index()
    {
        $occupants = Occupant::with('rentalUnit')->get();
        $drinkConsumables = DrinkConsumable::all();
        return view('receptionist.occupant.index', compact('occupants', 'drinkConsumables'));
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

        // Create the occupant
        $occupant = Occupant::create($request->all());

        // Update the rental unit status to 'occupied'
        $rentalUnit = RentalUnit::find($request->rental_unit_id);
        $rentalUnit->status = 'occupied';
        $rentalUnit->save();

        return redirect()->route('receptionist.occupants.index')->with('success', 'Mensalista criado com sucesso.');
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

        // Check if this is a transfer request
        if ($request->filled('rental_unit_id') && $request->rental_unit_id != $occupant->rental_unit_id) {
            // Update the old rental unit status back to 'available' or another appropriate status
            $oldRentalUnit = RentalUnit::find($occupant->rental_unit_id);
            if ($oldRentalUnit) {
                $oldRentalUnit->status = 'available'; // Or another appropriate status
                $oldRentalUnit->save();
            }

            // Update the new rental unit status to 'occupied'
            $newRentalUnit = RentalUnit::find($request->rental_unit_id);
            if ($newRentalUnit) {
                $newRentalUnit->status = 'occupied';
                $newRentalUnit->save();
            }
        }

        // Update occupant details
        $occupant->update($request->only(['name', 'check_in', 'check_out', 'rent_amount', 'payment_date', 'rental_unit_id']));

        return redirect()->route('receptionist.occupants.index')->with('success', 'Mensalista atualizado com sucesso.');
    }

    // Remove the specified occupant from storage
    public function destroy(Occupant $occupant)
    {
        $occupant->delete();
        return redirect()->route('receptionist.occupants.index')->with('success', 'Mensalista excluído com sucesso.');
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

        return redirect()->route('receptionist.occupants.index')->with('success', 'Mensalista transferido com sucesso.');
    }

    public function buyDrink(Request $request, $occupantId)
    {
        $occupant = Occupant::findOrFail($occupantId);
        $drinkConsumableId = $request->input('drink_consumable_id');
        $quantityToBuy = $request->input('quantity', 1);

        $drink = DrinkConsumable::findOrFail($drinkConsumableId);
        if ($drink->quantity < $quantityToBuy) {
            return back()->with('error', 'Not enough stock available.');
        }

        // Decrement stock
        $drink->decrement('quantity', $quantityToBuy);

        // Record the purchase
        $occupant->drinkConsumables()->attach($drinkConsumableId, ['quantity' => $quantityToBuy]);

        return back()->with('success', 'Bebida comprada com sucesso.');
    }

    public function markAsPaid(Request $request, $occupantId, $drinkConsumableId)
    {
        // Find the occupant-drink relationship record in the pivot table
        $occupant = Occupant::findOrFail($occupantId);

        // Check if the occupant has the specified drink consumable
        $drinkConsumable = $occupant->drinkConsumables()->where('drink_consumable_id', $drinkConsumableId)->first();

        if (!$drinkConsumable) {
            return back()->with('error', 'Bebida não encontrada para este mensalista.');
        }

        // Mark as paid
        $occupant->drinkConsumables()->updateExistingPivot($drinkConsumableId, ['paid' => true]);

        return back()->with('success', 'Bebida paga com sucesso.');
    }

    public function printPDF()
    {
        $occupants = Occupant::with('rentalUnit')->get();
        $pdf = PDF::loadView('receptionist.occupant.print', compact('occupants'));
        return $pdf->download('occupants.pdf');
    }
}
