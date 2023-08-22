<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Page;
use Faker\Guesser\Name;

class ContactController extends Controller
{
    public function index()
    {
        $contact = Page::where('id',  1)->first();
        return view('frontend.pages.contact', compact('contact'));
    }

    public function send_email(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'email' => 'required|email',
                'message' => 'required'
            ],
            [

                'name.required' => 'O campo Nome é obrigatório.',
                'email.required' => 'O campo Email é obrigatório.',
                'email.email' => 'O campo Email deve ser um endereço de e-mail válido.',
                'message.required' => 'O campo Mensagem é obrigatório.'
            ]
        );

        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error_message' => $validator->errors()->toArray()]);
        } else {
            // Send email
            return response()->json(['code' => 1, 'success_message' => 'Email enviado com sucesso!']);
        }
    }
}
