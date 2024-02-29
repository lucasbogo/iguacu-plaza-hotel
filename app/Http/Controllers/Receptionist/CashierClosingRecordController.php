<?php

namespace App\Http\Controllers\Receptionist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CashierClosingRecord;
use App\Models\Receptionist;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use App\Models\CashRegisterPayment;


class CashierClosingRecordController extends Controller
{
    public function index()
    {
        $receptionistId = Auth::user()->id;

        // Fetch the latest open CashierClosingRecord for the authenticated user
        $currentClosingRecord = CashierClosingRecord::where('receptionist_id', $receptionistId)
            ->whereNull('closed_at')
            ->latest()
            ->first();

        $drinkAmount = 0; // Default to 0 to handle case where there's no current closing record

        if ($currentClosingRecord) {
            // Directly sum the drink_amount associated with the current closing record
            $drinkAmount = CashRegisterPayment::where('cashier_closing_record_id', $currentClosingRecord->id)
                ->sum('drink_amount');
        }

        // Now, $drinkAmount will either be the sum of drink_amounts for the current record, or 0 if no record exists

        return view('receptionist.cashier-closing-records.index', compact('drinkAmount'));
    }



    public function create()
    {
        // Retrieve the starting amount for the cash register for the shift
        $startingAmount = CashierClosingRecord::where('receptionist_id', Auth::user()->id)
            ->whereNull('closed_at')
            ->latest()
            ->value('start_amount');

        // Retrieve the amounts received from rent for the specific shift
        $rentAmount = CashRegisterPayment::where('receptionist_id', Auth::user()->id)
            ->whereBetween('created_at', [now()->startOfDay(), now()->endOfDay()])
            ->sum('rent_amount');

        // Retrieve the amounts received from consumable drinks for the specific shift
        $drinkAmount = CashRegisterPayment::where('receptionist_id', Auth::user()->id)
            ->whereBetween('created_at', [now()->startOfDay(), now()->endOfDay()])
            ->sum('drink_amount');

        // Retrieve the amounts received from room services for the specific shift
        $roomServiceAmount = CashRegisterPayment::where('receptionist_id', Auth::user()->id)
            ->whereBetween('created_at', [now()->startOfDay(), now()->endOfDay()])
            ->sum('room_service_amount');

        // Return a view to create a new cashier closing record
        $receptionists = Receptionist::all();
        return view('receptionist.cashier-closing-records.create', compact('receptionists', 'startingAmount', 'rentAmount', 'drinkAmount', 'roomServiceAmount'));
    }

    public function store(Request $request)
    {
        // Set the receptionist_id dynamically
        $request->merge(['receptionist_id' => Auth::user()->id]);

        // Validate the request data
        $validatedData = $request->validate([
            'receptionist_id' => 'required|exists:receptionists,id',
            'start_amount' => 'required|numeric',
            'total_cash_received' => 'required|numeric',
        ]);

        // Calculate end_amount
        $validatedData['end_amount'] = $validatedData['start_amount'] + $validatedData['total_cash_received'];

        // Calculate total_sales
        $validatedData['total_sales'] = $validatedData['total_cash_received'];

        // Set the closed_at field to the current timestamp
        $validatedData['closed_at'] = now();

        try {
            // Create a new cashier closing record
            $cashierClosingRecord = CashierClosingRecord::create($validatedData);

            // Redirect to the index page with a success message
            return redirect()->route('receptionist.cashier-closing-records.index')->with('success', 'Caixa fechado com sucesso.');
        } catch (\Exception $e) {
            // Handle the exception, perhaps redirecting back with an error message
            return redirect()->back()->with('error', 'Erro ao fechar o caixa. Por favor, tente novamente.');
        }
    }

    public function closedIndex()
    {
        // Retrieve all closed cashier closing records
        $closedRecords = CashierClosingRecord::whereNotNull('closed_at')->latest()->get();

        return view('receptionist.cashier-closing-records.closed-index', compact('closedRecords'));
    }

    public function print($id)
    {
        $cashierClosingRecord = CashierClosingRecord::findOrFail($id);

        // Generate PDF using DomPDF
        $pdf = PDF::loadView('receptionist.cashier-closing-records.print', compact('cashierClosingRecord'));

        // Return PDF to download or view in browser
        return $pdf->download('cashier_closing_record.pdf');
    }
}
