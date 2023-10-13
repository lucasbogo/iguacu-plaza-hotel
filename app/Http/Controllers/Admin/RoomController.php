<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Amenity;
use App\Models\Room;
use App\Models\RoomImage;



class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::get();
        return view('admin.room.room_view', compact('rooms'));
    }

    public function add()
    {
        $amenities = Amenity::get();
        return view('admin.room.room_add', compact('amenities'));
    }

    public function store(Request $request)
    {
        $amenities = '';
        $i = 0;
        if (isset($request->arr_amenities)) {
            foreach ($request->arr_amenities as $item) {
                if ($i == 0) {
                    $amenities .= $item;
                } else {
                    $amenities .= ',' . $item;
                }
                $i++;
            }
        }

        $request->validate([
            'featured_image' => 'required|image|mimes:jpg,jpeg,png,gif',
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'total_rooms' => 'required'
        ]);

        $ext = $request->file('featured_image')->extension();
        $final_name = time() . '.' . $ext;
        $request->file('featured_image')->move(public_path('uploads/'), $final_name);

        $obj = new Room();
        $obj->featured_image = $final_name;
        $obj->name = $request->name;
        $obj->description = $request->description;
        $obj->price = $request->price;
        $obj->total_rooms = $request->total_rooms;
        $obj->amenities = $amenities;
        $obj->size = $request->size;
        $obj->total_beds = $request->total_beds;
        $obj->total_bathrooms = $request->total_bathrooms;
        $obj->total_balconies = $request->total_balconies;
        $obj->total_guests = $request->total_guests;
        $obj->video_id = $request->video_id;
        $obj->save();

        return redirect()->back()->with('success', 'Quarto adicionado com sucesso.');
    }

    public function edit($id)
    {
        $amenities = Amenity::get();
        $room = Room::where('id', $id)->first();

        $existing_amenities = array();
        if ($room->amenities != '') {
            $existing_amenities = explode(',', $room->amenities);
        }
        return view('admin.room.room_edit', compact('room', 'amenities', 'existing_amenities'));
    }

    public function update(Request $request, $id)
    {
        $obj = Room::where('id', $id)->first();

        $amenities = '';
        $i = 0;
        if (isset($request->arr_amenities)) {
            foreach ($request->arr_amenities as $item) {
                if ($i == 0) {
                    $amenities .= $item;
                } else {
                    $amenities .= ',' . $item;
                }
                $i++;
            }
        }

        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'total_rooms' => 'required'
        ]);

        if ($request->hasFile('featured_image')) {
            $request->validate([
                'featured_image' => 'image|mimes:jpg,jpeg,png,gif'
            ]);
            unlink(public_path('uploads/' . $obj->featured_image));
            $ext = $request->file('featured_image')->extension();
            $final_name = time() . '.' . $ext;
            $request->file('featured_image')->move(public_path('uploads/'), $final_name);
            $obj->featured_image = $final_name;
        }

        $obj->name = $request->name;
        $obj->description = $request->description;
        $obj->price = $request->price;
        $obj->total_rooms = $request->total_rooms;
        $obj->amenities = $amenities;
        $obj->size = $request->size;
        $obj->total_beds = $request->total_beds;
        $obj->total_bathrooms = $request->total_bathrooms;
        $obj->total_balconies = $request->total_balconies;
        $obj->total_guests = $request->total_guests;
        $obj->video_id = $request->video_id;
        $obj->update();

        return redirect()->back()->with('success', 'Quarto Atualizado com sucesso.');
    }

    public function delete($id)
    {
        $single_data = Room::where('id', $id)->first();
        unlink(public_path('uploads/' . $single_data->featured_image));
        $single_data->delete();

        $room_image = RoomImage::where('room_id', $id)->get();
        foreach ($room_image as $item) {
            unlink(public_path('uploads/' . $item->image));
            $item->delete();
        }

        return redirect()->back()->with('success', 'Quarto excluído com sucesso.');
    }

    public function gallery($id)
    {
        $room = Room::where('id', $id)->first();
        $room_images = RoomImage::where('room_id', $id)->get();
        return view('admin.room_gallery', compact('room', 'room_images'));
    }

    public function gallery_store(Request $request, $id)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,gif'
        ]);

        $ext = $request->file('image')->extension();
        $final_name = time() . '.' . $ext;
        $request->file('image')->move(public_path('uploads/'), $final_name);

        $obj = new RoomImage();
        $obj->image = $final_name;
        $obj->room_id = $id;
        $obj->save();

        return redirect()->back()->with('success', 'Imagem adicionada com sucesso.');
    }

    public function gallery_delete($id)
    {
        $image = RoomImage::where('id', $id)->first();
        unlink(public_path('uploads/' . $image->image));
        $image->delete();

        return redirect()->back()->with('success', 'Imagem excluída com sucesso.');
    }
}
