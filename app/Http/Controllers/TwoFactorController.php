<?php

namespace App\Http\Controllers;

use App\Mail\OtpMail;
use App\Models\Otp_token;
use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class TwoFactorController extends Controller
{
    function index (){
        return view('Auth.two-factor');
    }

    function verify(Request $request){
        
        $valid = $request->validate([
            "code"=>'required|max:4'
        ]);

        $login_type = Session::get("login_type");
        $login_value = Session::get("login_value");
        $user = User::where($login_type, $login_value)->first();
        $user_otp = Otp_token::where("email", $user->email)->orderBy('created_at', "desc")->first();

        // jangan lupa tambahin waktu expired
        if($valid["code"]==$user_otp->token){
            $password = Session::get("password");
            $remember = Session::get("remember");
            Auth::attempt([$login_type=>$login_value, "password"=>$password], $remember);
            Session::remove("remember");
            Session::remove("password");
            Session::remove("email");
            Session::remove("login_type");
            Session::remove("login_value");

            return redirect()->intended('/dashboard');
        }

        return redirect("/login/two-factor")->withErrors( "The provided code is incorrect");
    }

    static function sendTwoFactor(){
        $login_type = Session::get("login_type");
        $login_value = Session::get("login_value");
        $user = User::where($login_type, $login_value)->first();
        $otp = new Otp_token();
        $otp ->email = $user->email;
        $otp ->token = Str::random(4);
        $otp ->created_at = now();
        $otp->save();
        Mail::to($otp->email)->send(new OtpMail($user->name,$otp->email,$otp->token));
    }
}
