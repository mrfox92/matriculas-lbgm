<div>
    @if($open)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-lg">
                <h2 class="font-bold text-lg mb-3">Buscar apoderado</h2>

                <input type="text"
                       wire:model.debounce.300ms="search"
                       class="w-full border rounded px-3 py-2 mb-4"
                       placeholder="Buscar por nombre o RUT">

                <ul class="max-h-64 overflow-y-auto space-y-2">
                    @forelse($results as $g)
                        <li class="flex justify-between items-center border-b py-1">
                            <div>
                                <div class="font-semibold">{{ $g->full_name }}</div>
                                <div class="text-sm text-gray-500">{{ $g->rut }}</div>
                            </div>
                            <button wire:click="selectGuardian({{ $g->id }})"
                                    class="px-2 py-1 text-sm bg-blue-600 text-white rounded">
                                Seleccionar
                            </button>
                        </li>
                    @empty
                        <li class="text-sm text-gray-500">Sin resultados…</li>
                    @endforelse
                </ul>

                <div class="mt-4 flex justify-between">
                    <button wire:click="$dispatch('open-guardian-create')"
                            class="text-sm text-blue-600">
                        Registrar nuevo apoderado
                    </button>

                    <button wire:click="$set('open', false)"
                            class="text-sm text-gray-600">
                        Cerrar
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
