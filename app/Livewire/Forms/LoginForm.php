<?php

namespace App\Livewire\Forms;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Validate;
use Livewire\Form;

class LoginForm extends Form
{
    #[Validate('required|string')]
    public string $rut = '';

    #[Validate('required|string')]
    public string $password = '';

    #[Validate('boolean')]
    public bool $remember = false;

    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        // Normalizar RUT igual que el mutator del modelo
        $clean = strtoupper(str_replace(['.', '-', ' '], '', $this->rut));

        if (strlen($clean) >= 2) {
            $dv = substr($clean, -1);
            $num = substr($clean, 0, -1);
            $rutNormalized = $num . '-' . $dv;
        } else {
            $rutNormalized = $clean;
        }

        if (! Auth::attempt(['rut' => $rutNormalized, 'password' => $this->password], $this->remember)) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'form.rut' => trans('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    protected function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'form.rut' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    protected function throttleKey(): string
    {
        return Str::lower($this->rut).'|'.request()->ip();
    }
}
