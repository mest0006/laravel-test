<?php

namespace App\Jobs;

use Illuminate\Support\Facades\Redis;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;
use App\Models\Email;
use Illuminate\Support\Facades\Log;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $order;

    public function __construct(Email $order)
    {
        $this->order = $order;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        Redis::throttle('any_key')->allow(2)->every(1)->then(function () {
            $details = [
                'title' => 'Title: This is a test mail from Borbala ',
                'body' => 'Body: This is for testing email using smtp'

            ];
            $email = ["borbala.m.m@gmail.com", "b.webkinz@gmail.com"];

            Mail::to($email)->send(new SendMail($details));
            Log::info('Emailed order ' . $this->order->id);
            throw new \Exception("I am throwing this exception", 1);
        }, function () {
            // Could not obtain lock; this job will be re-queued
            return $this->release(2);
        });
    }
}