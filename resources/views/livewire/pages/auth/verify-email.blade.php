<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component {

    public function resend(): void
    {
        Auth::user()->sendEmailVerificationNotification();
        session()->flash('status', 'verification-link-sent');
    }
};

?>

<div>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Before continuing, please verify your email address.') }}
    </div>

    @if (session('status') === 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ __('A new verification link has been sent to your email address.') }}
        </div>
    @endif

    <form wire:submit.prevent="resend">
        <x-primary-button>
            {{ __('Resend Verification Email') }}
        </x-primary-button>
    </form>

    <form method="POST" action="{{ route('logout') }}" class="mt-4">
        @csrf
        <button
            class="underline text-sm text-gray-600 hover:text-gray-900">
            {{ __('Log Out') }}
        </button>
    </form>
</div>
