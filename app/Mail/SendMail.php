<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;

use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    public $details;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $files = [

            public_path('BorbalaMestercoverleter.pdf'),
            public_path('coding1.jpg'),
        ];
        foreach ($files as $file) {
            return $this->subject(' Here is my Laravel test ')
                ->view('api.send')->attach($file);
        }
    }
}