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
            'username' => 'required|unique:receptionists,username,' . Auth::id() . ',id',
            'name' => 'required',
            'current_password' => 'required',
            'new_password' => 'nullable|min:6|confirmed',
        ], [
            'username.required' => 'O campo nome de usuário é obrigatório.',
            'username.unique' => 'Este nome de usuário já está em uso.',
            'name.required' => 'O campo nome é obrigatório.',
            'current_password.required' => 'O campo senha atual é obrigatório.',
            'new_password.min' => 'A nova senha deve ter pelo menos 6 caracteres.',
            'new_password.confirmed' => 'A confirmação da nova senha não coincide.',
        ]);

        $receptionist = Auth::guard('receptionist')->user();

        if (!Hash::check($request->current_password, $receptionist->password)) {
            return back()->withErrors(['current_password' => 'A senha atual está incorreta.']);
        }

        $receptionist->username = $request->username;
        $receptionist->name = $request->name;
        if ($request->filled('new_password')) {
            $receptionist->password = Hash::make($request->new_password);
        }
        $receptionist->save();

        return back()->with('success', 'Perfil atualizado com sucesso.');
    }
}
