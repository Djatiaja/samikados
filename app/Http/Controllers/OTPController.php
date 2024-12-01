<?php

namespace App\Http\Controllers;

use App\Mail\OtpMail;
use App\Models\Otp_token;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class OTPController extends Controller
{
    static function sendOTP(String $email, String $description)
    {
        $user = User::where("email", $email)->firstOrFail();
        $otp = new Otp_token();
        $otp->email = $user->email;
        $otp->token = Str::random(4);
        $otp->created_at = now();
        $otp->description = $description;
        $otp->expired_date= now()->addMinutes(5);
        $otp->save();
        Mail::to($otp->email)->send(new OtpMail($user->name, $otp->email, $otp->token));
    }

    function verify(Request $request)
    {
        $otp = $request->otp_1 . $request->otp_2 . $request->otp_3 . $request->otp_4;
        $request->merge(["otp" => $otp]);
        $request->validate([
            "otp" => ["required", "min:4", "max:4"]
        ]);
        $user = User::where("users.email", Session::get("email"))
                ->leftJoin("otp_tokens", "users.email", "=", "otp_tokens.email")
                ->select("token","otp_tokens.expired_date", "users.*")
                ->orderBy("otp_tokens.created_at", "desc")
                ->firstOrFail();
        if (now() <= $user->expired_date && $otp == $user->token) {
            Session::remove("email");            
            $password_token= app('auth.password.broker')->createToken($user);

            return redirect("reset-password/". $password_token."?email=".$user->email);
        }
        return back();
    }
}