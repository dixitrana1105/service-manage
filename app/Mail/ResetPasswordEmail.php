<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use App\Models\CompanyProfile;

class ResetPasswordEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $token;
    public $email;
    public $user;
    public $companyProfile;

    public function __construct($email, $token)
    {
        $this->email = $email;
        $this->token = $token;

        // Fetch user based on email
        $this->user = User::where('email', $email)->first();

        // Fetch first company profile (if only one is expected)
        $this->companyProfile = CompanyProfile::first();
    }

    public function build()
    {
        $resetLink = url('/password/reset/' . $this->token . '?email=' . urlencode($this->email));

        return $this->subject('Reset Your Password')
            ->view('emails.reset_password')
            ->with([
                'resetLink' => $resetLink,
                'user' => $this->user,
                'companyProfile' => $this->companyProfile,
            ]);
    }
}
