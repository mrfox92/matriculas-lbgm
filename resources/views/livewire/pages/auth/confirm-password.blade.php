<?php

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component {

    public string $password = '';

    public function confirm(): void
    {
        $this->validate([
            'password' => ['required'],
        ]);

        if (! Hash::check($this->password, Auth::user()->password)) {
            $this->addError('password', __('Incorrect password.'));
            return;
        }

        session(['auth.password_confirmed_at' => time()]);

        $this->redirectIntended(default: route('dashboard'), navigate: true);
    }
};

?>

<div>
    <form wire:submit.prevent="confirm">
        <div>
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input
                id="password"
                wire:model="password"
                type="password"
                class="mt-1 block w-full"
                required
                autocomplete="current-password"
            />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex justify-end mt-4">
            <x-primary-button>
                {{ __('Confirm') }}
            </x-primary-button>
        </div>
    </form>
</div>
