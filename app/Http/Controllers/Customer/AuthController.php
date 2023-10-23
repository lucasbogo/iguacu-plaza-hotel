<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Mail\Websitemail;

class AuthController extends Controller
{
    public function login()
    {
        return view('frontend.pages.login');
    }

    public function login_submit(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credential = [
            'email' => $request->email,
            'password' => $request->password,
            'status' => 1
        ];

        if (Auth::guard('customer')->attempt($credential)) {
            return redirect()->route('customer_home');
        } else {
            return redirect()->route('customer_login')->with('error', 'Informação Incorreta');
        }
    }

    public function signup()
    {
        return view('frontend.pages.signup');
    }

    public function signup_submit(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:customers',
            'password' => 'required',
            'retype_password' => 'required|same:password'
        ]);


        $token = hash('sha256', time());
        $password = Hash::make($request->password);
        $verification_link = url('signup-verify/' . $request->email . '/' . $token);

        $obj = new Customer();
        $obj->name = $request->name;
        $obj->email = $request->email;
        $obj->password = $password;
        $obj->token = $token;
        $obj->status = 0;
        $obj->save();

        // Send email
        $subject = 'Verificar Inscrição';
        $message = 'PPor Favor, clique no link abaibo para confirmar sua inscrição no site Iguaçu Plaza Hotel:<br>';
        $message .= '<a href="' . $verification_link . '">';
        $message .= $verification_link;
        $message .= '</a>';

        Mail::to($request->email)->send(new Websitemail($subject, $message));

        return redirect()->back()->with('success', 'Para concluir sua inscrição, por favor, confira seu e-mail e clique no link correspondente. Agradecemos pela sua colaboração.');
    }

    public function signup_verify($email, $token)
    {
        $customer = Customer::where('email', $email)->where('token', $token)->first();

        if ($customer) {

            $customer->token = '';
            $customer->status = 1;
            $customer->update();

            return redirect()->route('customer_login')->with('success', 'Sua conta foi verificada com sucesso!');
        } else {
            return redirect()->route('customer_login');
        }
    }

    public function logout()
    {
        Auth::guard('customer')->logout();
        return redirect()->route('customer_login');
    }

    public function forget_password()
    {
        return view('front.forget_password');
    }

    public function forget_password_submit(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);

        $customer = Customer::where('email', $request->email)->first();
        if (!$customer) {
            return redirect()->back()->with('error', 'Endereço de e-mail não encontrado.');
        }

        $token = hash('sha256', time());

        $customer->token = $token;
        $customer->update();

        $reset_link = url('reset-password/' . $token . '/' . $request->email);
        $subject = 'Redefinir senha';
        $message = 'Clique no link abaixo para redefinir sua senha <br>';
        $message .= '<a href="' . $reset_link . '">Redefinir senha</a>';

        Mail::to($request->email)->send(new Websitemail($subject, $message));

        return redirect()->route('customer_login')->with('success', 'Por favor, verifique seu e-mail e siga as instruções fornecidas.');
    }


    public function reset_password($token, $email)
    {
        $customer = Customer::where('token', $token)->where('email', $email)->first();
        if (!$customer) {
            return redirect()->route('customer_login');
        }

        return view('front.reset_password', compact('token', 'email'));
    }

    public function reset_password_submit(Request $request)
    {
        $request->validate([
            'password' => 'required',
            'retype_password' => 'required|same:password'
        ]);

        $customer = Customer::where('token', $request->token)->where('email', $request->email)->first();

        $customer->password = Hash::make($request->password);
        $customer->token = '';
        $customer->update();

        return redirect()->route('customer_login')->with('success', 'Senha redefinida com sucesso');
    }
}
