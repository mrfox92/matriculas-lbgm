<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component {
    public LoginForm $form;

    public function login(): void
    {
        $this->validate();
        $this->form->authenticate();
        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }
};

?>

<div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form wire:submit.prevent="login">

        <!-- RUT -->
        <div>
            <x-input-label for="rut" value="RUT" />

            <x-text-input id="rut" type="text" wire:model="form.rut" class="block mt-1 w-full" required autofocus
                autocomplete="off" />

            <x-input-error :messages="$errors->get('form.rut')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" value="{{ __('Password')  }}" />

            <x-text-input id="password" type="password" wire:model="form.password" class="block mt-1 w-full" required
                autocomplete="current-password" />

            <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
        </div>

        <div class="block mt-4">
            <label class="inline-flex items-center">
                <input type="checkbox" wire:model="form.remember"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                <span class="ms-2 text-sm text-gray-600">Recordarme</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>

    </form>
</div>

<script>
    document.addEventListener('livewire:init', () => {
        const input = document.getElementById('rut');

        input.addEventListener('input', () => {
            let value = input.value.replace(/[^0-9kK]/g, '').toUpperCase();

            if (value.length > 1) {
                const body = value.slice(0, -1);
                const dv = value.slice(-1);

                let formatted = "";
                let reversed = body.split("").reverse().join("");

                for (let i = 0; i < reversed.length; i++) {
                    if (i !== 0 && i % 3 === 0) formatted += ".";
                    formatted += reversed[i];
                }

                formatted = formatted.split("").reverse().join("");
                input.value = formatted + "-" + dv;
            } else {
                input.value = value;
            }

            input.dispatchEvent(new Event('input'));
        });
    });
</script>
