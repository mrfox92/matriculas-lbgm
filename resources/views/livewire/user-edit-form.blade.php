<div class="max-w-xl mx-auto space-y-6">

    <h1 class="text-2xl font-semibold mb-4">
        Editar Usuario
    </h1>

    <form wire:submit.prevent="update" class="space-y-4">

        {{-- Nombre --}}
        <div>
            <x-input-label value="Nombre completo" />
            <x-text-input wire:model.defer="name" class="block mt-1 w-full" />
            <x-input-error :messages="$errors->get('name')" />
        </div>

        {{-- RUT --}}
        <div>
            <x-input-label value="RUT" />
            <x-text-input wire:model.defer="rut" class="block mt-1 w-full" />
            <x-input-error :messages="$errors->get('rut')" />
        </div>

        {{-- Email --}}
        <div>
            <x-input-label value="Email" />
            <x-text-input type="email" wire:model.defer="email" class="block mt-1 w-full" />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        {{-- Rol --}}
        <div>
            <x-input-label value="Rol" />
            <select wire:model="role" class="mt-1 block w-full border-gray-300 rounded shadow-sm">
                @foreach ($roles as $r)
                    <option value="{{ $r }}">{{ ucfirst($r) }}</option>
                @endforeach
            </select>
        </div>

        {{-- Activo --}}
        <div class="flex items-center">
            <input type="checkbox" wire:model="active" class="rounded border-gray-300 text-indigo-600 shadow-sm">
            <label class="ml-2 text-sm">Usuario activo</label>
        </div>

        {{-- Reset password --}}
        <div class="border-t pt-4 space-y-3">

            <label class="flex items-center">
                <input type="checkbox" wire:model="resetPassword"
                    class="rounded border-gray-300 text-red-600 shadow-sm">
                <span class="ml-2 text-sm text-red-700">
                    Resetear contraseña a la contraseña por defecto
                    <span class="text-xs text-gray-500">(matriculalbgm2026)</span>
                </span>
            </label>


            <div>
                <x-input-label value="Nueva contraseña (opcional)" />
                <x-text-input type="password" wire:model.defer="newPassword" class="block mt-1 w-full" />
                <x-input-error :messages="$errors->get('newPassword')" class="mt-1" />
                <p class="text-xs text-gray-500">
                    Debe tener al menos 8 caracteres, letras y números.
                </p>
            </div>


        </div>

        {{-- Botón --}}
        <div class="flex justify-end">
            <x-primary-button>
                Guardar cambios
            </x-primary-button>
        </div>

    </form>
</div>
