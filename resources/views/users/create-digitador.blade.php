<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.app')] class extends Component
{
    public string $name = '';
    public string $rut = '';
    public string $email = '';
    public bool $active = true;

    public function rules(): array
    {
        return [
            'name'  => ['required','string','max:255'],
            'rut'   => ['required','string','max:20','unique:users,rut'],
            'email' => ['required','string','email','max:255','unique:users,email'],
            'active'=> ['boolean'],
        ];
    }

    public function save(): void
    {
        $this->validate();

        // Normalizar RUT igual que en el modelo
        $clean = strtoupper(str_replace(['.', '-', ' '], '', $this->rut));
        if (strlen($clean) >= 2) {
            $dv = substr($clean, -1);
            $num = substr($clean, 0, -1);
            $rutNormalized = $num . '-' . $dv;
        } else {
            $rutNormalized = $clean;
        }

        $user = User::create([
            'name'   => $this->name,
            'rut'    => $rutNormalized,
            'email'  => $this->email,
            'active' => $this->active,
            'password' => Hash::make(
                config('app.matriculas_default_password', 'MatriculaLBGM2026')
            ),
        ]);

        $user->syncRoles(['digitador']);

        Session::flash('status', 'Digitador creado correctamente. Contraseña por defecto asignada.');

        $this->redirectRoute('users.index', navigate: true);
    }
};

?>

<div class="max-w-xl mx-auto space-y-6">

    <h1 class="text-2xl font-semibold mb-4">Nuevo Digitador</h1>

    @if (session('status'))
        <div class="mb-4 text-sm text-green-700 bg-green-100 rounded px-4 py-2">
            {{ session('status') }}
        </div>
    @endif

    <form wire:submit.prevent="save" class="space-y-4">

        <!-- Nombre -->
        <div>
            <x-input-label for="name" value="Nombre completo" />
            <x-text-input id="name" type="text" wire:model.defer="name"
                          class="block mt-1 w-full" required />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- RUT -->
        <div>
            <x-input-label for="rut" value="RUT" />
            <x-text-input id="rut" type="text" wire:model.defer="rut"
                          class="block mt-1 w-full" required autocomplete="off" />
            <x-input-error :messages="$errors->get('rut')" class="mt-2" />
        </div>

        <!-- Email -->
        <div>
            <x-input-label for="email" value="Email" />
            <x-text-input id="email" type="email" wire:model.defer="email"
                          class="block mt-1 w-full" required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Activo -->
        <div class="flex items-center">
            <input id="active" type="checkbox" wire:model="active"
                   class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
            <label for="active" class="ml-2 text-sm text-gray-700">
                Usuario activo
            </label>
        </div>

        <div class="flex items-center justify-end">
            <x-primary-button>
                Guardar digitador
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
