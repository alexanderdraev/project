<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class ContactController extends Controller
{
    public function showForm() {
        return view('contact');
    }

    public function sendForm(Request $request) {

        $this->validate($request, [
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required'
        ]);

        $data = array(
            'email' => $request->email,
            'subject' => $request->subject,
            'bodyMessage' => $request->message
        );

        Mail::send('about', array(), function($message) use ($data) {
            $message->from($data['email']);
            $message->to('finmax@abv.bg');
            $message->subject($data['subject']);
            $message->setBody($data['bodyMessage']);
        });

        return redirect()->route('contact')->with('success', 'Message has been sent!');
    }
}
