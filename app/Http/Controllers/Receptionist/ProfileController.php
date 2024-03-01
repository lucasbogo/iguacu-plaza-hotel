<?php

namespace App\Http\Controllers\Receptionist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Receptionist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show()
    {
        $receptionist = Auth::guard('receptionist')->user();
        return view('receptionist.profile.show', compact('receptionist'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:receptionists,username,' . Auth::guard('receptionist')->user()->id,
            'password' => 'nullable|min:6|confirmed',
        ]);

        $receptionist = Auth::guard('receptionist')->user();

        $receptionist->name = $request->name;
        $receptionist->username = $request->username;

        if ($request->filled('password')) {
            $receptionist->password = Hash::make($request->password);
        }

        if ($request->hasFile('photo')) {
            $request->validate([
                'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            // Delete old photo if it exists
            if ($receptionist->photo) {
                $oldPhotoPath = public_path('uploads/receptionist/' . $receptionist->photo);
                if (file_exists($oldPhotoPath)) {
                    unlink($oldPhotoPath);
                }
            }

            // Upload new photo
            $photo = $request->file('photo');
            $extension = $photo->getClientOriginalExtension();
            $fileName = 'receptionist_' . time() . '.' . $extension;
            $photo->move(public_path('uploads/receptionist'), $fileName);

            // Update photo name in database
            $receptionist->photo = $fileName;
        }

        $receptionist->save();

        return back()->with('success', 'Perfil atualizado com sucesso.');
    }

    public function deletePhoto()
    {
        $receptionist = Auth::guard('receptionist')->user();

        if ($receptionist->photo) {
            $oldPhotoPath = public_path('uploads/receptionist/' . $receptionist->photo);
            if (file_exists($oldPhotoPath)) {
                unlink($oldPhotoPath);
            }

            $receptionist->photo = null;
            $receptionist->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false]);
    }
}
