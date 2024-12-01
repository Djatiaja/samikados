<?php

namespace App\Jobs;

use App\Mail\OtpMail;
use App\Models\Otp_token;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class SendOtpJob implements ShouldQueue
{
    use Queueable;

    protected $email;
    protected $message;

    /**
     * Create a new job instance.
     */
    public function __construct(String $email, String $message)
    {
        $this->email = $email;
        $this->message = $message;
    }

    /**
     * Execute the job.
     */
    public function handle(): void{

        $user = User::where("email", $this->email)->firstOrFail();
        $otp = new Otp_token();
        $otp->email = $user->email;
        $otp->token = Str::random(4);
        $otp->created_at = now();
        $otp->description = $this->message;
        $otp->expired_date= now()->addMinutes(5);
        $otp->save();
        Mail::to($otp->email)->send(new OtpMail($user->name, $otp->email, $otp->token));
    }
}
