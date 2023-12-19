<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DateController extends Controller
{
    public function index()
    {
        return view('admin.date.booked_rooms');
    }

    public function show(Request $request) 
    {
        $request->validate([
            'selected_date' => 'required|date_format:d/m/Y'
        ]);
    
        $selected_date = $request->selected_date;
    
        return view('admin.date.booked_rooms_details', compact('selected_date'));
    }
    
}
