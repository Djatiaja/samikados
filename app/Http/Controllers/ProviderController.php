<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class ProviderController extends Controller
{
    function redirect($provider)
    {
        session()->put("intended_url", "/");    
        return Socialite::driver($provider)->redirect();
    }


    function connect($provider){
        session()->put("intended_url", "/admin/pengaturan-akun");
        return Socialite::driver($provider)->redirect();
    }

    function callback($provider)
    {
        $providerUser = Socialite::driver($provider)->user();
        $user = User::where('email', $providerUser->email)->first();
        if (!empty($user)) {
            if (!empty($user->email_verified_at)) {
                $user = User::where('email', $providerUser->email)->first()->update(
                    [
                        'provider' => $provider,
                        'provider_id' => $providerUser->id,
                        'provider_token' => $providerUser->token,
                        'email_verified_at' => now(),
                    ]
                );
            } else {
                $user = User::where('email', $providerUser->email)->first()->update(
                    [
                        'provider' => $provider,
                        'provider_id' => $providerUser->id,
                        'provider_token' => $providerUser->token,
                    ]
                );
            }
            
        } else {
            $user = User::Create([
                'provider_id' => $providerUser->id,
                'provider' => $provider,
                'name' => $providerUser->name,
                'username' => User::generateUsername($providerUser->nickname),
                'email' => $providerUser->email,
                'photo' => $providerUser->avatar,
                'email_verified_at' => now(),
                'provider_token' => $providerUser->token
            ]);
        }
        $user = User::where('email', $providerUser->email)->first();
        Auth::login($user);
        $intendedUrl = session('intended_url');
        return redirect($intendedUrl?$intendedUrl:"/");
    }
}
