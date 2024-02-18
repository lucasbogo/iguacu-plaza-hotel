<?php

namespace App\Http\Controllers\Receptionist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Receptionist; // Adjust this to your Receptionist model
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class ReceptionistAuthController extends Controller
{
    public function login()
    {
        return view('receptionist.login');
    }

    public function login_submit(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ], [
            'username.required' => 'O campo Usuário é obrigatório.',
            'password.required' => 'O campo Senha é obrigatório.',
        ]);

        $credentials = $request->only('username', 'password');

        if (Auth::guard('receptionist')->attempt($credentials)) {
            return redirect()->route('receptionist.dashboard');
        } else {
            return back()->withErrors(['error' => 'Credenciais inválidas. Por favor, tente novamente.']);
        }
    }
    public function logout()
    {
        Auth::guard('receptionist')->logout();
        return redirect()->route('receptionist.login');
    }

    public function redefinePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $receptionist = Auth::guard('receptionist')->user();

        if (!Hash::check($request->current_password, $receptionist->password)) {
            return back()->withErrors(['current_password' => 'Senha atual incorreta.']);
        }

        // Manually set the password and use save() method
        $receptionist->password = Hash::make($request->new_password);
        $receptionist->save();

        return back()->with('success', 'Senha redefinida com sucesso.');
    }
}
