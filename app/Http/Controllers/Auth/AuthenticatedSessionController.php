<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\OTPController;
use App\Http\Controllers\TwoFactorController;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $user = User::where($request->loginParamType,$request->validated()[$request->loginParamType])->first();

        if ($user->is_twoFactor) {
            Session::put("login_type", $request->loginParamType);
            Session::put("password", $request->validated()["password"]);
            Session::put("remember", isset($request->validated()["remember"]) ? true : false);
            Session::put("login_value", $request->validated()[$request->loginParamType]);
            OTPController::sendOTP($user->email, "Two Factor login");
            return redirect()->route("two-factor");
        }

        $request->authenticate();
        $request->session()->regenerate();
        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {

        $user = User::where("id", $request->user()->id)->firstOr();
        $user->remember_token = null;
        $user->save();


        Auth::guard('web')->logout();
        $request->session()->invalidate();


        $request->session()->regenerateToken();

        return redirect('/');
    }
}
