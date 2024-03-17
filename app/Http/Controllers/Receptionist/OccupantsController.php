<?php

namespace App\Http\Controllers\Receptionist;

use App\Http\Controllers\Controller;
use App\Models\Occupant;
use App\Models\DrinkConsumable;
use App\Models\RentalUnit;
use App\Models\RentPayment;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\CashierClosingRecord;


class OccupantsController extends Controller
{
    // Display a listing of the occupants
    public function index()
    {
        $occupants = Occupant::where('status', '!=', 'checked_out')->with('rentalUnit')->get(); // Make sure 'checked_out' matches the database value
        $drinkConsumables = DrinkConsumable::all();
        $rentalUnits = RentalUnit::all();
        return view('receptionist.occupant.index', compact('occupants', 'drinkConsumables', 'rentalUnits'));
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
            'rg' => 'nullable|string|max:255',
            'cpf' => 'nullable|string|max:255',
            'check_in' => 'required|date',
            'check_out' => 'nullable|date|after_or_equal:check_in',
            'rent_amount' => 'nullable|numeric',
            'paid_rent_amount' => 'nullable|numeric',
            'payment_date' => 'nullable|date',
            'transfer_date' => 'nullable|date|after_or_equal:check_in',
            'transfer_reason' => 'nullable|string|max:1000',
            'billing_type' => 'required|in:private,company',
            'company_name' => 'nullable|string|max:255'
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
            'rg' => 'nullable|string|max:255',
            'cpf' => 'nullable|string|max:255',
            'check_in' => 'required|date',
            'check_out' => 'nullable|date|after_or_equal:check_in',
            'rent_amount' => 'nullable|numeric',
            'payment_date' => 'nullable|date',
            'billing_type' => 'required|in:private,company',
            'company_name' => 'nullable|string|max:255'

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
        $occupant->update($request->only(['name', 'rg', 'cpf', 'check_in', 'check_out', 'rent_amount', 'paid_rent_amount', 'payment_date', 'rental_unit_id', 'billing_type', 'company_name']));

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
            return back()->with('error', 'Quantidade não disponível em estoque.');
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

    public function chargeRent($occupantId)
    {
        $occupant = Occupant::findOrFail($occupantId);
        if ($occupant->billing_type != 'private') {
            return back()->with('error', 'Aluguel só pode ser cobrado para mensalistas com faturamento particular.');
        }

        $rentPayment = RentPayment::create([
            'occupant_id' => $occupantId,
            'amount' => $occupant->rent_amount,
            'payment_date' => now(),
        ]);

        $receptionistId = Auth::user()->id;
        $currentClosingRecord = CashierClosingRecord::where('receptionist_id', $receptionistId)
            ->whereNull('closed_at')
            ->latest()
            ->first();

        if (!$currentClosingRecord) {
            $currentClosingRecord = CashierClosingRecord::create([
                'receptionist_id' => Auth::id(),
                'closed_at' => null,
                'start_amount' => 0,
                'end_amount' => 0, // Set default end amount if needed
                'total_sales' => 0,
                'total_cash_received' => 0,
                'rental_income' => 0,
                'drink_income' => 0,
                'room_service_income' => 0,
                'created_at' => now(), // Ensure correct timestamp, or adjust as necessary
                'updated_at' => now(),
            ]);
        }

        // Assuming you have corrected the field to match your database schema
        $currentClosingRecord->increment('rental_income', $rentPayment->amount);
        $currentClosingRecord->save();

        return back()->with('success', 'Aluguel cobrado com sucesso e registro de caixa atualizado.');
    }

    public function closeRoomOccupancy($occupantId)
    {
        $occupant = Occupant::with(['rentalUnit', 'drinkConsumables'])->findOrFail($occupantId);

        // Prevent checking out already checked-out occupant
        if ($occupant->status == 'checked_out') {
            return redirect()->back()->with('error', 'O check-out para este mensalista ja foi efetuado.');
        }

        // Set the check-out date to now
        $occupant->check_out = now();
        $occupant->status = 'checked_out';
        $occupant->save();

        $checkInDate = Carbon::parse($occupant->check_in);
        $checkOutDate = Carbon::parse($occupant->check_out);
        $stayDuration = $checkInDate->diffInDays($checkOutDate);

        // Calculate rental amount if private
        $rentalAmountOwed = $occupant->billing_type == 'private' ? $stayDuration * $occupant->rent_amount : 0;

        // Get consumable drinks and unpaid drinks
        $consumableDrinks = $occupant->drinkConsumables;
        $unpaidDrinks = $consumableDrinks->filter(function ($drink) {
            return !$drink->pivot->paid;
        });

        $totalUnpaid = $unpaidDrinks->sum(function ($drink) {
            return $drink->price * $drink->pivot->quantity; // Adjust according to your price attribute
        });

        // Now include transfer_date and transfer_reason in your compact statement
        return view('receptionist.occupant.close-occupancy', compact(
            'occupant',
            'stayDuration',
            'rentalAmountOwed',
            'consumableDrinks',
            'unpaidDrinks',
            'totalUnpaid'
        ));
    }

    public function showClosedOccupancies()
    {
        $closedOccupancies = Occupant::where('status', 'checked_out')->get()->map(function ($occupant) {
            $occupant->stayDuration = Carbon::parse($occupant->check_in)->diffInDays(Carbon::parse($occupant->check_out));
            return $occupant;
        });

        return view('receptionist.occupant.closed-occupancies', compact('closedOccupancies'));
    }

    public function showDetails($occupantId)
    {
        $occupant = Occupant::with(['rentalUnit', 'drinkConsumables', 'rentPayments', 'roomServices'])
            ->where('id', $occupantId)->firstOrFail();

        $checkIn = Carbon::parse($occupant->check_in);
        $checkOut = $occupant->check_out ? Carbon::parse($occupant->check_out) : Carbon::now();
        $stayDuration = $checkIn->diffInDays($checkOut);

        // Include transfer details if available
        $transferDetails = null;
        if ($occupant->transfer_date) {
            $transferDetails = [
                'date' => $occupant->transfer_date,
                'reason' => $occupant->transfer_reason,
                // Assuming the new room is the current rental_unit after transfer
                'new_room' => $occupant->rentalUnit->number,
                // Additional logic needed if you want to show previous room number
            ];
        }

        $billingType = $occupant->billing_type;
        $companyName = $billingType == 'company' ? $occupant->company_name : null;

        return view('receptionist.occupant.details', compact(
            'occupant',
            'stayDuration',
            'transferDetails',
            'billingType',
            'companyName'
        ));
    }

    public function printPDF()
    {
        $occupants = Occupant::with('rentalUnit')->get();
        $pdf = PDF::loadView('receptionist.occupant.print', compact('occupants'));
        return $pdf->download('occupants.pdf');
    }
}
