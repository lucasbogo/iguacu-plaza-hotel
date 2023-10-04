<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\Websitemail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Models\Subscriber;

class SubscriberController extends Controller
{
    public function send_email(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'email' => 'required|email',
            ],
            [
                'email.required' => 'O campo Email é obrigatório.',
                'email.email' => 'O campo Email deve ser um endereço de e-mail válido.',
            ]
        );

        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error_message' => $validator->errors()->toArray()]);
        } else {

            $token = hash('sha256', time());

            $obj = new Subscriber();
            $obj->email = $request->email;
            $obj->token = $token;
            $obj->status = 0;
            $obj->save();

            //verification link variable
            $verification_link = url('subscriber/verify/' . $request->email . '/' . $token);

            // Send email
            $subject = 'Confirmação de Inscrição na Newsletter do iguaçu Plaza Hotel';
            $message = 'Por Favor, clique no link a seguir para confirmar a sua inscrição: <br>';
            $message .= '<a href="' . $verification_link . '">';
            $message .= $verification_link;
            $message .= '</a>';

            Mail::to($request->email)->send(new Websitemail($subject, $message));

            return response()->json(['code' => 1, 'success_message' => 'Por favor, verifique o seu e-mail para confirmar a inscrição em nossa newsletter.']);
        }
    }

    public function verify($email, $token)
    {
        $subscriber = Subscriber::where('email', $email)->where('token', $token)->first();

        if ($subscriber) {

            $subscriber->token = '';
            $subscriber->status = 1;
            $subscriber->update();

            return redirect()->route('home')->with('success', 'Inscrição em nossa newsletter realizada com sucesso!');
        } else {
            return redirect()->route('home')->with('error', 'Não foi possṕivel realizar sua inscrição');
        }
    }
}
