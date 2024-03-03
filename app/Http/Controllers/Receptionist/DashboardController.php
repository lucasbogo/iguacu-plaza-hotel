<?php

namespace App\Http\Controllers\Receptionist;

use App\Http\Controllers\Controller;
use App\Models\Occupant;
use App\Models\RentalUnit;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $totalRentalUnitsRegistered = RentalUnit::count();
        $totalOccupants = Occupant::distinct('name')->count('name');
        $totalRentAmount = Occupant::sum('rent_amount');
       
        // Fetch logs for display in the dashboard
        $logs = Log::with('receptionist')
                   ->where('receptionist_id', Auth::guard('receptionist')->id())
                   ->latest()
                   ->get();

      
        return view('receptionist.dashboard', compact('totalRentalUnitsRegistered', 'totalOccupants', 'totalRentAmount', 'logs'));
    }

    public function profile()
    {
        return view('receptionist.profile', ['receptionist' => Auth::guard('receptionist')->user()]);
    }
}
