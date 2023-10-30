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
        $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required'
            ],
            [
                'email.required' => 'O campo E-mail é obrigatório.',
                'email.email' => 'Por favor, insira um endereço válido',
                'password' => 'O campo Senha é obrigatório'
            ]
        );

        $credential = [
            'email' => $request->email,
            'password' => $request->password,
            'status' => 1
        ];

        if (Auth::guard('customer')->attempt($credential)) {
            return redirect()->route('customer.customer_home');
        } else {
            return redirect()->route('customer_login')->with('error', 'Informações Incorretas, tente novamente.');
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
        ], [
            'name.required' => 'O campo Nome Completo é obrigatório.',
            'email.required' => 'O campo E-mail é obrigatório.',
            'email.email' => 'Por favor, insira um endereço de e-mail válido.',
            'email.unique' => 'Este e-mail já está em uso.',
            'password.required' => 'O campo Senha é obrigatório.',
            'retype_password.required' => 'O campo Confirmar Senha é obrigatório.',
            'retype_password.same' => 'Os campos Senha e Confirmar Senha devem ser iguais.'
        ]);


        $token = hash('sha256', time());
        $password = Hash::make($request->password);
        $verification_link = url('customer/signup-verify/' . $request->email . '/' . $token);

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

        return redirect()->back()->with('success', 'Para concluir sua inscrição, por favor, confira seu e-mail e clique no link correspondente.');
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

    public function forget_password()
    {
        return view('frontend.pages.forget_password');
    }

    public function forget_password_submit(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email|',
            ],
            [
                'email.required' => 'O campo E-mail é obrigatório.',
                'email.email' => 'Por favor, insira um endereço de e-mail válido.',
            ]
        );

        $customer = Customer::where('email', $request->email)->first();
        if (!$customer) {
            return redirect()->back()->with('error', 'Endereço de e-mail não encontrado.');
        }

        $token = hash('sha256', time());

        $customer->token = $token;
        $customer->update();

        $reset_link = url('/customer/reset-password/' . $token . '/' . $request->email);
        logger('Reset Link: ' . $reset_link);
        $subject = 'Redefinir senha';
        $message = 'Clique no link abaixo para redefinir sua senha <br>';
        $message .= '<a href="' . $reset_link . '">Redefinir senha</a>';

        Mail::to($request->email)->send(new Websitemail($subject, $message));

        return redirect()->route('customer_login')->with('success', 'Por favor, verifique seu e-mail e siga as instruções fornecidas.');
    }


    public function customer_reset_password($token, $email)
    {
        $customer = Customer::where('token', $token)->where('email', $email)->first();

        if (!$customer) {
            return redirect()->route('customer_login')->with('error', 'Link de redefinição de senha inválido.');
        } else {

            return view('frontend.pages.reset_password', compact('token', 'email'));
        }
    }

    public function customer_reset_password_submit(Request $request)
    {
        $request->validate([
            'password' => 'required',
            'retype_password' => 'required|same:password'
        ], [
            'password.required' => 'O campo Senha é obrigatório.',
            'retype_password.required' => 'O campo Confirmar Senha é obrigatório.',
            'retype_password.same' => 'Os campos Senha e Confirmar Senha devem ser iguais.'
        ]);

        $customer = Customer::where('token', $request->token)->where('email', $request->email)->first();

        $customer->password = Hash::make($request->password);
        $customer->token = '';
        $customer->update();

        return redirect()->route('customer_login')->with('success', 'Senha redefinida com sucesso');
    }

    public function logout()
    {
        Auth::guard('customer')->logout();
        return redirect()->route('customer_login');
    }
}
