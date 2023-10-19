<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomsController extends Controller
{
    public function rooms()
    {
        $rooms = Room::paginate(12);
        return view('frontend.rooms.rooms', compact('rooms'));
    }

    public function room($id)
    {
        $room = Room::with('rRoomImage')->where('status', true)->where('id', $id)->first();
        return view('frontend.rooms.room_detail', compact('room'));
    }
}
