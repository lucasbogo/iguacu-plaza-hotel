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

        // Update password only if a new one is provided
        if ($request->filled('password')) {
            $receptionist->password = Hash::make($request->password);
        }

        // Update photo if it's provided
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('public/receptionists');
            $receptionist->photo = basename($path);
        }

        $receptionist->save();

        return back()->with('success', 'Perfil atualizado com sucesso.');
    }
}
