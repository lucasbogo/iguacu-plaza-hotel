<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Mail\Websitemail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;

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

    public function login_submit(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
            'status' => 'Ativo'
        ];

        if (Auth::attempt($credentials)) {
            return redirect()->route('dashboard');
        } else {
            return redirect()->route('login');
        }
    }

    public function logout()
    {
        Auth::guard('web')->logout();

        return redirect()->route('login');
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
        $message = 'Por favor, clique neste link para confirmar seu cadastro: <br><a href="' . $verification_link . '"> Clique Aqui</a>';

        Mail::to($request->email)->send(new Websitemail($subject, $message));

        echo 'Um link de confirmação foi enviado para o seu e-mail. Por favor, verifique seu e-mail.';

        // return redirect()->route('login');
    }

    public function registration_verify($token, $email)
    {
        $user = User::where('token', $token)->where('email', $email)->first();
        if (!$user) {
            return redirect()->route('login');
        }

        $user->status = 'Ativo';
        $user->token = '';
        $user->update();

        echo 'Seu e-mail foi verificado com sucesso.';
    }

    public function forget_password()
    {
        return view('forget_password');
    }

    public function forget_password_submit(Request $request)
    {
        $token = hash('sha256', time());

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            dd('E-mail não encontrado.');
        }

        $user->token = $token;
        $user->update();

        $reset_link = url('reset-password/' . $token . '/' . $request->email);

        echo 'Um link de redefinição de senha foi enviado para o seu e-mail. Por favor, verifique seu e-mail.';
    }
}
