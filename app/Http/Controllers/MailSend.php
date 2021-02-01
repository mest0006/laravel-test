<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;

class MailSend extends Controller
{
    public function send()
    {
        $details = [
            'title' => 'Title: This is a test mail from Borbala ',
            'body' => 'Body: This is for testing email using smtp'

        ];
        $email = ['borbala.m.m@gmail.com', 'test@mail.com', 'test2.com',];
        foreach ($email as $recipient) {
            Mail::to($recipient)->send(new SendMail($details))->subject('subject');
            return view('emails.thanks')->with([
                'Title' => $details['title'],
                'Body' => $details['body'],
                'Recipients' => $recipient,
            ]);
        }
    }
}
