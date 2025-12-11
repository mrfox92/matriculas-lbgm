<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use Spatie\Permission\Models\Role;

new #[Layout('layouts.app')] class extends Component {

    public User $user;

    public string $name = '';
    public string $email = '';
    public string $rut = '';
    public bool   $active = true;
    public string $role = '';

    public array $roles = [];

    public function mount(User $user)
    {
        $this->user   = $user;
        $this->name   = $user->name;
        $this->email  = $user->email;
        $this->rut    = $user->rut;
        $this->active = $user->active;
        $this->role   = $user->roles->pluck('name')->first() ?? '';

        $this->roles  = Role::pluck('name')->toArray();
    }

    public function rules(): array
    {
        return [
            'name'  => ['required','string','max:255'],
            'email' => ['required','email','max:255','unique:users,email,' . $this->user->id],
            'rut'   => ['required','string','max:20','unique:users,rut,' . $this->user->id],
            'role'  => ['required','string'],
            'active'=> ['boolean'],
        ];
    }

    public function update(): void
    {
        $this->validate();

        $clean = strtoupper(str_replace(['.', '-', ' '], '', $this->rut));
        if (strlen($clean) >= 2) {
            $dv = substr($clean, -1);
            $num = substr($clean, 0, -1);
            $rutNormalized = $num . '-' . $dv;
        } else {
            $rutNormalized = $clean;
        }

        $this->user->update([
            'name'   => $this->name,
            'email'  => $this->email,
            'rut'    => $rutNormalized,
            'active' => $this->active,
        ]);

        $this->user->syncRoles([$this->role]);

        Session::flash('status', 'Usuario actualizado correctamente.');

        $this->redirectRoute('users.index', navigate: true);
    }

    public function resetPassword(): void
    {
        $this->user->password = Hash::make(
            config('app.matriculas_default_password', 'MatriculaLBGM2026')
        );
        $this->user->save();

        Session::flash('status', 'Contraseña reseteada a la contraseña por defecto.');
    }
};

?>

<div class="max-w-xl mx-auto space-y-6">

    <h1 class="text-2xl font-semibold mb-4">Editar Usuario</h1>

    @if (session('status'))
        <div class="text-sm text-green-700 bg-green-100 px-4 py-2 rounded">
            {{ session('status') }}
        </div>
    @endif

    <form wire:submit.prevent="update" class="space-y-4">

        <div>
            <x-input-label value="Nombre" />
            <x-text-input type="text" wire:model.defer="name" class="block mt-1 w-full" />
            <x-input-error :messages="$errors->get('name')" class="mt-1" />
        </div>

        <div>
            <x-input-label value="Email" />
            <x-text-input type="email" wire:model.defer="email" class="block mt-1 w-full" />
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <div>
            <x-input-label value="RUT" />
            <x-text-input id="rut" type="text" wire:model.defer="rut" class="block mt-1 w-full" />
            <x-input-error :messages="$errors->get('rut')" class="mt-1" />
        </div>

        <div>
            <x-input-label value="Rol" />
            <select wire:model="role"
                class="mt-1 block w-full border-gray-300 rounded shadow-sm">
                @foreach ($roles as $r)
                    <option value="{{ $r }}">{{ ucfirst($r) }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-1" />
        </div>

        <div class="flex items-center">
            <input type="checkbox" wire:model="active"
                class="rounded border-gray-300 text-indigo-600 shadow-sm">
            <label class="ml-2 text-sm">Usuario activo</label>
        </div>

        <div class="flex justify-between items-center mt-4">
            <x-primary-button>
                Guardar cambios
            </x-primary-button>

            <button type="button"
                wire:click="resetPassword"
                class="text-sm text-red-600 hover:underline">
                Resetear contraseña
            </button>
        </div>
    </form>
</div>

<script>
document.addEventListener('livewire:init', () => {
    const input = document.getElementById('rut');

    if (!input) return;

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
