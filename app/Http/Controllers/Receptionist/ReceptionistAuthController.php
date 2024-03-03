<?php

namespace App\Http\Controllers\Receptionist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Receptionist; 
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
}
