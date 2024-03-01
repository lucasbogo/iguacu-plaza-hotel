<?php

namespace App\Http\Controllers\Receptionist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DrinkConsumable;
use App\Models\Occupant;
use Illuminate\Support\Facades\Auth;
use App\Models\CashierClosingRecord;
use Illuminate\Support\Facades\DB;

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

    // this method get all the paid drink consumables
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
        DB::transaction(function () use ($occupantId, $drinkConsumableId) {
            // Find the specific occupant and drink combination. Note: This assumes each combination is unique.
            $pivotRecord = DB::table('occupant_drink_consumable')
                ->where('occupant_id', $occupantId)
                ->where('drink_consumable_id', $drinkConsumableId)
                ->where('paid', 0) // Ensure we're targeting unpaid records
                ->first();

            if (!$pivotRecord) {
                return redirect()->back()->with('error', 'Registro não encontrado ou bebida já foi marcada como paga.');
            }

            $drinkConsumable = DrinkConsumable::findOrFail($drinkConsumableId);
            $totalPaidAmount = $drinkConsumable->cost * $pivotRecord->quantity;

            $currentClosingRecord = CashierClosingRecord::where([
                'receptionist_id' => Auth::id(),
                'closed_at' => null,
            ])->latest()->first();

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

            $currentClosingRecord->increment('drink_income', $totalPaidAmount);

            // Update the pivot record to mark as paid
            DB::table('occupant_drink_consumable')->where('id', $pivotRecord->id)->update(['paid' => 1]);
        });

        return redirect()->route('receptionist.cashier-closing-records.index')->with('success', 'Bebida marcada como paga com sucesso.');
    }
}
