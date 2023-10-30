<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Mail\Websitemail;

class AuthController extends Controller
{
    public function login()
    {
        return view('admin.login');
    }

    public function login_submit(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required',
            ],
            [
                'email.required' => 'O campo E-mail é obrigatório.',
                'email.email' => 'Por favor, insira um endereço válido',
                'password.required' => 'O campo Senha é obrigatório.',
            ]
        );

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        $admin = Admin::where('email', $request->email)->first();

        if (!$admin) {
            // Display a custom error message for non-existent email
            return redirect()->route('admin_login')
                ->withErrors(['error' => 'E-mail não encontrado.']);
        }

        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin_home');
        } else {
            // Display a custom error message for incorrect password
            return redirect()->route('admin_login')
                ->withErrors(['error' => 'Senha incorreta. Por favor, tente novamente.']);
        }
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function settings()
    {
        return view('admin.settings');
    }

    public function forget_password()
    {
        return view('admin.forget_password');
    }

    public function forget_password_submit(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $admin = Admin::where('email', $request->email)->first();

        if (!$admin) {
            return redirect()->back()->with('error', 'Email não encontrado');
        }

        $token = hash('sha256', time());

        $admin->token = $token;
        $admin->save();

        $reset_link = url('/admin/reset-password/' . $token . '/' . $request->email);
        $subject = 'Redefinir senha';
        $message = 'Clique no link abaixo para redefinir sua senha <br>';
        $message .= '<a href="' . $reset_link . '">Redefinir senha</a>';

        Mail::to($admin->email)->send(new Websitemail($subject, $message));

        return redirect()->route('admin_login')->with('success', 'Link de redefinição de senha enviado para seu email');
    }

    public function reset_password($token, $email)
    {
        $admin = Admin::where('token', $token)->where('email', $email)->first();

        if (!$admin) {
            return redirect()->route('admin_login')->with('error', 'Link de redefinição de senha inválido');
        }

        return view('admin.reset_password', compact('token', 'email'));
    }

    public function reset_password_submit(Request $request)
    {
        $request->validate([
            'password' => 'required',
            'retype_password' => 'required|same:password'
        ]);

        $admin = Admin::where('token', $request->token)->where('email', $request->email)->first();

        if (!$admin) {
            return redirect()->route('admin_login')->with('error', 'Link de redefinição de senha inválido');
        }

        $admin->password = Hash::make($request->password);
        $admin->token = '';
        $admin->update();

        return redirect()->route('admin_login')->with('success', 'Senha redefinida com sucesso');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin_login');
    }
}
