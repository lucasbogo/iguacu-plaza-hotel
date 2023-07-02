<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Mail\Websitemail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class WebsiteController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function dashboard()
    {
        return view('user.dashboard');
    }


    public function login()
    {
        return view('user.login');
    }

    public function login_submit(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
            'status' => 'Ativo'
        ];

        if (Auth::guard('web')->attempt($credentials)) {
            return redirect()->route('dashboard');
        } else {
            return redirect()->route('user.login');
        }
    }

    public function logout()
    {
        Auth::guard('web')->logout();

        return redirect()->route('home');
    }

    public function register()
    {
        return view('user.register');
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
        $message = 'Por favor, clique neste link para confirmar seu cadastro: <a href="' . $verification_link . '"> Clique Aqui</a>';

        Mail::to($request->email)->send(new Websitemail($subject, $message));

        echo 'Um link de confirmação foi enviado para o seu e-mail. Por favor, verifique seu e-mail.';

        // return redirect()->route('login');
    }

    public function registration_verify($token, $email)
    {
        $user = User::where('token', $token)->where('email', $email)->first();
        if (!$user) {
            return redirect()->route('user.login');
        }

        $user->status = 'Ativo';
        $user->token = '';
        $user->update();

        echo 'Seu e-mail foi verificado com sucesso.';
    }

    public function forget_password()
    {
        return view('user.forget_password');
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
        $subject = 'Redefinição de Senha';
        $message = 'Por favor, clique neste link para redefinir sua senha: <a href="' . $reset_link . '">Clique Aqui</a>';

        Mail::to($request->email)->send(new Websitemail($subject, $message));

        echo 'Um link de redefinição de senha foi enviado para o seu e-mail. Por favor, verifique seu e-mail.';
    }

    public function reset_password($token, $email)
    {
        $user = User::where('token', $token)->where('email', $email)->first();
        if (!$user) {
            return redirect()->route('user.login');
        }

        return view('user.reset_password', compact('token', 'email'));
    }

    public function reset_password_submit(Request $request)
    {
        $user = User::where('token', $request->token)->where('email', $request->email)->first();
        if (!$user) {
            return redirect()->route('user.login');
        }

        $user->token = '';
        $user->password = Hash::make($request->new_password);
        $user->update();

        echo 'Sua senha foi redefinida com sucesso.';

        // return redirect()->route('login');
    }
}
