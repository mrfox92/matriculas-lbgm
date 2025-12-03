<div x-data="{ open: @entangle('open') }">
    <div x-show="open"
         class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
        
        <div class="bg-white p-6 rounded-lg w-96">
            <h2 class="font-bold text-lg mb-4">Registrar nuevo apoderado</h2>

            <label>RUT</label>
            <input type="text" wire:model="rut" class="w-full border rounded px-2 py-1">

            <label>Nombres</label>
            <input type="text" wire:model="first_name" class="w-full border rounded px-2 py-1">

            <label>Apellido paterno</label>
            <input type="text" wire:model="last_name_father" class="w-full border rounded px-2 py-1">

            <label>Apellido materno</label>
            <input type="text" wire:model="last_name_mother" class="w-full border rounded px-2 py-1">

            <button wire:click="save"
                    class="mt-4 px-4 py-2 bg-blue-600 text-white rounded w-full">
                Guardar apoderado
            </button>

            <button x-on:click="open = false"
                    class="mt-2 px-4 py-2 border rounded w-full">
                Cancelar
            </button>
        </div>
    </div>
</div>
