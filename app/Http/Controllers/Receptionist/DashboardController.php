<?php

namespace App\Http\Controllers\Receptionist;

use App\Http\Controllers\Controller;
use App\Models\Occupant;
use App\Models\RentalUnit;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request; 


class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $totalRentalUnitsRegistered = RentalUnit::count();
        $totalOccupants = Occupant::distinct('name')->count('name');
        $totalRentAmount = Occupant::sum('rent_amount');

        // Initialize the query for fetching logs
        $query = Log::with('receptionist')
            ->where('receptionist_id', Auth::guard('receptionist')->id());

        // Check if a date filter is applied
        if ($request->has('date') && $request->date != '') {
            $query->whereDate('created_at', '=', $request->date);
        }

        $logs = $query->latest()->get();

        return view('receptionist.dashboard', compact('totalRentalUnitsRegistered', 'totalOccupants', 'totalRentAmount', 'logs'));
    }


    public function profile()
    {
        return view('receptionist.profile', ['receptionist' => Auth::guard('receptionist')->user()]);
    }
}
