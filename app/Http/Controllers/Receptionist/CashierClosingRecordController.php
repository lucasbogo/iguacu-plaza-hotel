<?php

namespace App\Http\Controllers\Receptionist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CashierClosingRecord;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;


class CashierClosingRecordController extends Controller
{
    // Shows the current data from amounts received from drinl_income and room_service_income
    public function index()
    {
        $receptionistId = Auth::user()->id;
        $currentClosingRecord = CashierClosingRecord::where('receptionist_id', $receptionistId)
            ->whereNull('closed_at')
            ->latest()
            ->first();

        if ($currentClosingRecord) {
            $drinkIncome = $currentClosingRecord->drink_income;
            $roomServiceIncome = $currentClosingRecord->room_service_income;
        } else {
            // If no current record is found, it means the last shift was closed, and we are starting a new shift.
            // Initialize variables to reflect the new shift starting state.
            $drinkIncome = 0;
            $roomServiceIncome = 0;
        }

        return view('receptionist.cashier-closing-records.index', compact('drinkIncome', 'roomServiceIncome'));
    }

    // This is where we get that data, as shown in the index method, to read and check the amount, then effectvly close the Cadsh Register
    public function create()
    {
        $receptionistId = Auth::user()->id;
        $drinkIncome = $roomServiceIncome = 0; // Initialize both variables at the start

        $currentClosingRecord = CashierClosingRecord::where('receptionist_id', $receptionistId)
            ->whereNull('closed_at')
            ->latest()
            ->first();

        if ($currentClosingRecord) {
            $drinkIncome = $currentClosingRecord->drink_income ?? 0; // Use null coalescing operator to ensure defaults
            $roomServiceIncome = $currentClosingRecord->room_service_income ?? 0;
        }

        // Retrieve the starting amount for the cash register for the shift directly from the current closing record
        $startingAmount = $currentClosingRecord ? $currentClosingRecord->start_amount : 0;

        // Pass these values to your view
        return view('receptionist.cashier-closing-records.create', compact('startingAmount', 'drinkIncome', 'roomServiceIncome'));
    }

    // Method that stores the data from the create method and effectly closes the cash register...
    // TO DO: make sure that when the Receptiuonist closes the Cash Register, the currentClosingRecord (from the index method)
    // DONE!
    public function store(Request $request)
    {
        $request->merge(['receptionist_id' => Auth::user()->id]);

        $validatedData = $request->validate([
            'receptionist_id' => 'required|exists:receptionists,id',
            'start_amount' => 'required|numeric',
            'total_cash_received' => 'required|numeric',
            'quantity_withdrawn' => 'required|numeric',
        ]);

        $validatedData['end_amount'] = $validatedData['start_amount'] + $validatedData['total_cash_received'];
        $validatedData['total_sales'] = $validatedData['total_cash_received'];
        $validatedData['closed_at'] = now();

        try {
            // Close the current shift by creating a new closing record
            CashierClosingRecord::create($validatedData);

            // Optionally, immediately create a new open Cashier Closing Record for the next shift
            // This assumes you want to automatically open a new shift right after closing the current one
            CashierClosingRecord::create([
                'receptionist_id' => Auth::user()->id,
                'start_amount' => 0, // Initialize the new shift with a start amount, adjust as needed
                // Do not set 'closed_at', keeping it null to indicate an open shift
            ]);

            return redirect()->route('receptionist.cashier-closing-records.index')->with('success', 'Caixa fechado com sucesso.');
        } catch (\Exception $e) {
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

    public function printAllClosed()
    {
        $closedRecords = CashierClosingRecord::whereNotNull('closed_at')->get();

        // Assuming you have a view named 'receptionist.cashier-closing-records.print-all'
        $pdf = PDF::loadView('receptionist.cashier-closing-records.print-all', compact('closedRecords'));

        return $pdf->download('all_closed_cash_registers.pdf');
    }
}
