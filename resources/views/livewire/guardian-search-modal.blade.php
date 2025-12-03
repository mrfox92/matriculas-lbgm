<div x-data="{ open: @entangle('open') }">
    <div x-show="open"
         class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
        
        <div class="bg-white p-6 rounded-lg w-96 shadow-lg">
            <h2 class="font-bold text-lg mb-3">Buscar apoderado</h2>

            <input type="text" wire:model.debounce.300ms="search"
                placeholder="Buscar nombre o RUT"
                class="w-full border rounded px-2 py-1 mb-3">

            <ul class="border rounded max-h-40 overflow-y-auto">
                @foreach($results as $g)
                    <li class="px-2 py-1 hover:bg-gray-200 cursor-pointer"
                        wire:click="selectGuardian({{ $g->id }})">
                        {{ $g->full_name }} ({{ $g->rut }})
                    </li>
                @endforeach
            </ul>

            <button wire:click="$dispatch('open-guardian-create')"
                    class="text-blue-600 mt-3">
                + Registrar apoderado nuevo
            </button>

            <button x-on:click="open = false"
                    class="mt-4 px-3 py-1 border rounded w-full">
                Cerrar
            </button>
        </div>
    </div>
</div>
