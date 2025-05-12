<?php

namespace App\Jobs;

use App\Models\Broadcast;
use App\Models\User;
use App\Mail\BroadcastMessageMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\Log;

class BroadcastMessageJob implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    public $broadcast;
    public $user;

    public function __construct(Broadcast $broadcast, User $user)
    {
        $this->broadcast = $broadcast;
        $this->user = $user;
    }

    public function handle()
    {
        $message = $this->broadcast->message;
        $channel = $this->broadcast->channel;

        switch ($channel) {
            case 'email':
                if ($this->user->email) {
                    Mail::to($this->user->email)->send(new BroadcastMessageMail($this->broadcast, $this->user));
                }
                break;

            case 'sms':
                $to = '+91' . ltrim($this->user->phone, '0');
                $from = config('services.twilio.sms_from');

                if ($to !== $from && !empty($this->user->phone)) {
                    $client = new Client(config('services.twilio.sid'), config('services.twilio.token'));
                    $client->messages->create($to, [
                        'from' => $from,
                        'body' => $message,
                    ]);
                } else {
                    Log::info("SMS not sent: 'to' and 'from' numbers are the same or phone is missing.");
                }
                break;

            case 'whatsapp':
                $to = 'whatsapp:+91' . ltrim($this->user->phone, '0');
                $from = 'whatsapp:' . config('services.twilio.whatsapp_from');

                if ($to !== $from && !empty($this->user->phone)) {
                    $client = new Client(config('services.twilio.sid'), config('services.twilio.token'));
                    $client->messages->create($to, [
                        'from' => $from,
                        'body' => $message,
                    ]);
                } else {
                    Log::info("WhatsApp message not sent: 'to' and 'from' numbers are the same or phone is missing.");
                }
                break;
        }
    }
}
