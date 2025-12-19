<div class="max-w-xl mx-auto space-y-6">

    <h1 class="text-2xl font-semibold mb-4">
        Nuevo Usuario
    </h1>

    @if (session('status'))
        <div class="text-sm text-green-700 bg-green-100 px-4 py-2 rounded">
            {{ session('status') }}
        </div>
    @endif

    <form wire:submit.prevent="save" class="space-y-4">

        {{-- Nombre --}}
        <div>
            <x-input-label value="Nombre completo" />
            <x-text-input
                type="text"
                wire:model.defer="name"
                class="block mt-1 w-full"
            />
            <x-input-error :messages="$errors->get('name')" />
        </div>

        {{-- RUT --}}
        <div>
            <x-input-label value="RUT" />
            <x-text-input
                id="rut"
                type="text"
                wire:model.defer="rut"
                class="block mt-1 w-full"
            />
            <x-input-error :messages="$errors->get('rut')" />
        </div>

        {{-- Email --}}
        <div>
            <x-input-label value="Email" />
            <x-text-input
                type="email"
                wire:model.defer="email"
                class="block mt-1 w-full"
            />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        {{-- Rol --}}
        <div>
            <x-input-label value="Rol" />
            <select
                wire:model="role"
                class="mt-1 block w-full border-gray-300 rounded shadow-sm"
            >
                <option value="">Seleccione un rol</option>
                @foreach ($roles as $r)
                    <option value="{{ $r }}">{{ ucfirst($r) }}</option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('role')" />
        </div>

        {{-- Activo --}}
        <div class="flex items-center">
            <input
                type="checkbox"
                wire:model="active"
                class="rounded border-gray-300 text-indigo-600 shadow-sm"
            >
            <label class="ml-2 text-sm">
                Usuario activo
            </label>
        </div>

        {{-- Botón --}}
        <div class="flex justify-end">
            <x-primary-button>
                Crear usuario
            </x-primary-button>
        </div>

    </form>
</div>
