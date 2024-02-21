<?php

namespace App\Http\Controllers\Receptionist;

use App\Http\Controllers\Controller;
use App\Models\Occupant;
use App\Models\RentalUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
         $totalRentalUnitsRegistered = RentalUnit::count();
         $totalOccupants = Occupant::distinct('name')->count('name');
         $totalRentAmount = Occupant::sum('rent_amount');

        return view('receptionist.dashboard', compact('totalRentalUnitsRegistered', 'totalOccupants', 'totalRentAmount'));
    }

    public function profile()
    {
        return view('receptionist.profile', ['receptionist' => Auth::guard('receptionist')->user()]);
    }
}
