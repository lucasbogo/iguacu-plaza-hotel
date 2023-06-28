<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Mail\Websitemail;
use Illuminate\Support\Facades\Mail;

class WebsiteController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function dashboard()
    {
        return view('dashboard');
    }

    public function login()
    {
        return view('login');
    }

    public function register()
    {
        return view('register');
    }

    public function register_submit(Request $request)
    {
        $token = hash('sha256', time());

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->status = 'Pendente';
        $user->token = $token;
        $user->save();

        $verification_link = url('registration/verify/' . $token . '/' . $request->email);
        $subject = 'Confirmação de Cadastro';
        $message = 'Por favor, clique neste link para confirmar seu cadastro: <br>' . $verification_link;

        Mail::to($request->email)->send(new Websitemail($subject, $message));

        return redirect()->route('login');
    }

    public function logout()
    {
        return view('logout');
    }

    public function forget_password()
    {
        return view('forget_password');
    }
}
