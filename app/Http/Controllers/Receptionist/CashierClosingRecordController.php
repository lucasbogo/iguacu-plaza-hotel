<?php

namespace App\Http\Controllers\Receptionist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CashierClosingRecord;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;


class CashierClosingRecordController extends Controller
{

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
            $rentIncome = $currentClosingRecord->rental_income;
        } else {
            // If no current record is found, it means the last shift was closed, and we are starting a new shift.
            // Initialize variables to reflect the new shift starting state.
            $drinkIncome = 0;
            $roomServiceIncome = 0;
            $rentIncome = 0;
        }

        return view('receptionist.cashier-closing-records.index', compact('drinkIncome', 'roomServiceIncome', 'rentIncome'));
    }

    public function create()
    {
        $receptionistId = Auth::user()->id;
        $drinkIncome = $roomServiceIncome = $rentIncome = 0; // Initialize all variables at the start

        $currentClosingRecord = CashierClosingRecord::where('receptionist_id', $receptionistId)
            ->whereNull('closed_at')
            ->latest()
            ->first();

        if ($currentClosingRecord) {
            $drinkIncome = $currentClosingRecord->drink_income ?? 0; // Use null coalescing operator to ensure defaults
            $roomServiceIncome = $currentClosingRecord->room_service_income ?? 0;
            $rentIncome = $currentClosingRecord->rental_income ?? 0;
        }

        // Retrieve the starting amount for the cash register for the shift directly from the current closing record
        $startingAmount = $currentClosingRecord ? $currentClosingRecord->start_amount : 0;

        // Pass these values to your view, including rentIncome
        return view('receptionist.cashier-closing-records.create', compact('startingAmount', 'drinkIncome', 'roomServiceIncome', 'rentIncome'));
    }

    // Method that stores the data from the create method and effectly closes the cash register...
    public function store(Request $request)
    {
        $request->merge(['receptionist_id' => Auth::user()->id]);

        $validatedData = $request->validate([
            'receptionist_id' => 'required|exists:receptionists,id',
            'start_amount' => 'required|numeric',
            'total_cash_received' => 'required|numeric',
            'quantity_withdrawn' => 'required|numeric',
        ]);

        // Correct calculation for end_amount
        $validatedData['end_amount'] = $validatedData['start_amount'] + $validatedData['total_cash_received'];
        $validatedData['total_sales'] = $validatedData['total_cash_received']; // total_sales represents total revenue, adjustments may be needed based on your application's requirements
        $validatedData['closed_at'] = now();

        // Correctly calculate the starting amount for the next shift
        $nextShiftStartingAmount = $validatedData['end_amount'] - $validatedData['quantity_withdrawn'];

        try {
            // Close the current shift by creating a new closing record
            $closingRecord = CashierClosingRecord::create($validatedData);

            // Immediately create a new open Cashier Closing Record for the next shift
            // with starting amount adjusted as per the end_amount - quantity_withdrawn from the closing of the current record
            CashierClosingRecord::create([
                'receptionist_id' => Auth::user()->id,
                'start_amount' => max($nextShiftStartingAmount, 0), // Ensure the starting amount is not negative; adjust based on your requirements
                // Do not set 'closed_at', keeping it null to indicate an open shift
                'created_at' => now(),
                'updated_at' => now(),
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
        $cashierClosingRecord = CashierClosingRecord::with(['receptionist'])->findOrFail($id);

        $drinkIncome = $cashierClosingRecord->drink_income;
        $roomServiceIncome = $cashierClosingRecord->room_service_income;
        $rentIncome = $cashierClosingRecord->rental_income;

        // Calculate the total amount
        $totalAmount = $drinkIncome + $roomServiceIncome + $rentIncome;

        // Generate PDF using DomPDF
        $pdf = PDF::loadView('receptionist.cashier-closing-records.print', compact('cashierClosingRecord', 'drinkIncome', 'roomServiceIncome', 'rentIncome', 'totalAmount')); // TODO: 'rentIncome',

        return $pdf->download('cashier_closing_record.pdf');
    }

    public function printAllClosed()
    {
        $closedRecords = CashierClosingRecord::whereNotNull('closed_at')->get();

        $pdf = PDF::loadView('receptionist.cashier-closing-records.print-all', compact('closedRecords'));

        return $pdf->download('all_closed_cash_registers.pdf');
    }
}
