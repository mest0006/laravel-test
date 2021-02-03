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
        $email = ["borbala.m.m@gmail.com", "b.webkinz@gmail.com"];

        foreach ($email as $emails) {
            Mail::to($emails)->send(new SendMail($details));
            return view('api.end')->with([
                'Title' => $details['title'],
                'Body' => $details['body'],
                'Recipients' => $emails
            ]);
        }
    }
}
