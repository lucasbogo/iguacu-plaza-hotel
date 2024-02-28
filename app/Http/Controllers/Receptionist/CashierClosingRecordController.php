<?php

namespace App\Http\Controllers\Receptionist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CashierClosingRecord;
use App\Models\Receptionist;
use Barryvdh\DomPDF\Facade\Pdf;

class CashierClosingRecordController extends Controller
{
    public function index()
    {
        // Retrieve all cashier closing records
        $records = CashierClosingRecord::with('receptionist')->latest()->get();
        return view('receptionist.cashier-closing-records.index', compact('records'));
    }

    public function create()
    {
        // Return a view to create a new cashier closing record
        $receptionists = Receptionist::all();
        return view('receptionist.cashier-closing-records.create', compact('receptionists'));
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'receptionist_id' => 'required|exists:receptionists,id',
            'start_amount' => 'required|numeric',
            'end_amount' => 'required|numeric',
            'total_sales' => 'required|numeric',
            'total_cash_received' => 'required|numeric',
        ]);

        // Set the closed_at field to the current timestamp
        $validatedData['closed_at'] = now();

        // Create a new cashier closing record
        CashierClosingRecord::create($validatedData);

        // Redirect to the index page with a success message
        return redirect()->route('receptionist.cashier-closing-records.index')->with('success', 'Caixa criado com sucesso.');
    }

    public function show(CashierClosingRecord $cashierClosingRecord)
    {
        // Show the details of a specific cashier closing record
        return view('receptionist.cashier-closing-records.show', compact('cashierClosingRecord'));
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
