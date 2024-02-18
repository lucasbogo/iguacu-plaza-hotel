<?php

namespace App\Http\Controllers\Receptionist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // public function index()
    // {
    //     $totalRoomsRegistered = RoomOccupancy::count();
    //     $totalRenterGuests = RoomOccupancy::distinct('nome_do_inquilino')->count('nome_do_inquilino');
    //     $totalRentAmount = RoomOccupancy::sum('valor_do_aluguel');

    //     return view('receptionist.dashboard', compact('totalRoomsRegistered', 'totalRenterGuests', 'totalRentAmount'));
    // }
    
    public function profile()
    {
        return view('receptionist.profile', ['receptionist' => Auth::guard('receptionist')->user()]);
    }
}
