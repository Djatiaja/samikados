<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    public $loginParamType;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required_without:username', 'string', 'email', 'exists:users,email'],
            'username' => ['required_without:email', 'string',  'exists:users,username'],
            'password' => ['required', 'string', "min:8"]
        ];
    }

    public function messages(): array
    {
        return [
            'email.exists' => 'Email, username atau password yang kamu masukkan salah. Silakan coba lagi.',
            'username.exists' => 'Email, username atau password yang kamu masukkan salah. Silakan coba lagi.',
            'password.min' => 'Password harus memiliki minimal 8 karakter.'
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        if (! Auth::attempt($this->only($this->loginParamType, 'password'), $this->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                $this->loginParamType => "Email, username atau password yang kamu masukkan salah. Silakan coba lagi.",
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->string('email')) . '|' . $this->ip());
    }


    public function prepareForValidation()
    {
        $this->loginParamType = filter_var($this->input('loginParam'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $this->merge([$this->loginParamType => $this->input('loginParam')]);
    }
}
