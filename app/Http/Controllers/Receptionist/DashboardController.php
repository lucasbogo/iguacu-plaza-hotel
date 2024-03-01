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
       // $logs = Log::with('receptionist')->latest()->take(10)->get(); // Example: Get the latest 10 logs (insert this in compact: 'logs')

        return view('receptionist.dashboard', compact('totalRentalUnitsRegistered', 'totalOccupants', 'totalRentAmount'));
    }

    public function profile()
    {
        return view('receptionist.profile', ['receptionist' => Auth::guard('receptionist')->user()]);
    }
}
