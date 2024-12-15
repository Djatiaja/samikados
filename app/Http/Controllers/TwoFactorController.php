<?php

namespace App\Http\Controllers;

use App\Models\Otp_token;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class TwoFactorController extends BaseController
{
    function index (){
        return view('Auth.two-factor');
    }

    function verify(Request $request){
        
        $otp = $request->otp_1 . $request->otp_2 . $request->otp_3 . $request->otp_4;
        $request->merge(["code" => $otp]);
        $valid=$request->validate([
            "code" => ["required", "min:4", "max:4"]
        ]);

        $login_type = Session::get("login_type");
        $login_value = Session::get("login_value");
        $user = User::where($login_type, $login_value)->first();
        $user_otp = Otp_token::where("email", $user->email)->orderBy('created_at', "desc")->first();

        if(now()<=$user_otp->expired_date &&$valid["code"]==$user_otp->token){
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

}
