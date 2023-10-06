<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\Websitemail;
use Illuminate\Support\Facades\Mail;
use App\Models\Subscriber;

class SubscribersController extends Controller
{
    public function show()
    {
        $subscribers = Subscriber::where('status', 1)->get();
        return view('admin.subscribers.subscribers', compact('subscribers'));
    }

    public function send_email()
    {
        return view('admin.subscribers.subscribers_send_email');
    }

    public function send_email_submit(Request $request)
    {
        $request->validate([
            'subject' => 'required',
            'message' => 'required'
        ]);

        // Send email
        $subject = $request->subject;
        $message = $request->message;

        $subscribers = Subscriber::where('status', 1)->get();

        foreach ($subscribers as $item) {
            Mail::to($item->email)->send(new Websitemail($subject, $message));
        }

        return redirect()->back()->with('success', 'E-mail enviado com sucesso.');
    }
}
        