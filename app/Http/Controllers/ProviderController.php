<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class ProviderController extends Controller
{
    function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    function callback($provider)
    {
        $providerUser = Socialite::driver($provider)->user();

        if (!empty(User::where('provider_id', $providerUser->id)->first())){
            $user = User::updateOrCreate([
                'provider_id' => $providerUser->id,
                'provider' => $provider
            ], [
                'provider_token' => $providerUser->token
            ]);
        }else{
            $user = User::Create([
                'provider_id' => $providerUser->id,
                'provider' => $provider,
                'name' => $providerUser->name,
                'username' => User::generateUsername(null),
                'email' => $providerUser->email,
                'photo' => $providerUser->avatar,
                'email_verified_at' => now(),
                'provider_token' => $providerUser->token
            ]);
        }

        Auth::login($user);
        return redirect('/dashboard');
    }
}
