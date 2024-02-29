<?php

namespace App\Http\Controllers\Receptionist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RoomService;
use App\Models\Occupant;
use App\Models\ServiceType;
use Illuminate\Support\Facades\Auth;
use App\Models\CashierClosingRecord;
use Illuminate\Support\Facades\DB;

class RoomServiceController extends Controller
{
    // Display a listing of the room services
    public function index()
    {
        $roomServices = RoomService::with(['occupant', 'serviceType'])->get();
        return view('receptionist.room-service.index', compact('roomServices'));
    }

    // Show the form for creating a new room service
    public function create()
    {
        $occupants = Occupant::all();
        $serviceTypes = ServiceType::all();
        return view('receptionist.room-service.create', compact('occupants', 'serviceTypes'));
    }

    // Store a newly created room service in storage
    public function store(Request $request)
    {
        $request->validate([
            'occupant_id' => 'required|exists:occupants,id',
            'service_type_id' => 'required|exists:service_types,id',
            'cost' => 'required|numeric',
            'service_date' => 'required|date',
            'observations' => 'nullable|string',
        ]);

        RoomService::create($request->all());

        return redirect()->route('receptionist.cashier-closing-records.index')->with('success', 'Serviço adicionado com sucesso.');
    }

    // Show the form for editing the specified room service
    public function edit(RoomService $roomService)
    {
        $occupants = Occupant::all();
        $serviceTypes = ServiceType::all();
        return view('receptionist.room-service.edit', compact('roomService', 'occupants', 'serviceTypes'));
    }

    // Update the specified room service in storage
    public function update(Request $request, RoomService $roomService)
    {
        $request->validate([
            'occupant_id' => 'required|exists:occupants,id',
            'service_type_id' => 'required|exists:service_types,id',
            'cost' => 'required|numeric',
            'service_date' => 'required|date',
            'observations' => 'nullable|string',
        ]);

        $roomService->update($request->all());

        return redirect()->route('receptionist.room-services.index')->with('success', 'Serviço atualizado com sucesso.');
    }

    // Remove the specified room service from storage
    public function destroy(RoomService $roomService)
    {
        $roomService->delete();
        return redirect()->route('receptionist.room-services.index')->with('success', 'Serviço excluído com sucesso.');
    }

    public function markAsPaid(RoomService $roomService)
    {
        if ($roomService && !$roomService->is_paid) {
            DB::transaction(function () use ($roomService) {
                $totalPaidAmount = $roomService->cost; // Assume cost attribute exists on RoomService

                $currentClosingRecord = CashierClosingRecord::where([
                    'receptionist_id' => Auth::id(),
                    'closed_at' => null,
                ])->latest()->first();

                if (!$currentClosingRecord) {
                    // If no open record exists, create a new one with default values
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

                // Increment room_service_income on the CashierClosingRecord
                $currentClosingRecord->increment('room_service_income', $totalPaidAmount);

                // Mark the room service as paid
                $roomService->update(['is_paid' => true]);
            });

            $message = 'Serviço de quarto pago com sucesso.';
        } else {
            // Handle case where RoomService is either not found or already marked as paid
            $message = 'Serviço de quarto já foi pago ou não encontrado.';
        }
        return back()->with('success', $message);
    }


    // Show all room services that are not paid
    public function notPaidRoomServices()
    {
        $roomServices = RoomService::with(['occupant', 'serviceType'])->where('is_paid', false)->get();
        return view('receptionist.room-service.not-paid-room-services', compact('roomServices'));
    }

    // Show all paid room services
    public function paidRoomServices()
    {
        $roomServices = RoomService::with(['occupant', 'serviceType'])->where('is_paid', true)->get();
        return view('receptionist.room-service.paid-room-services', compact('roomServices'));
    }
}
