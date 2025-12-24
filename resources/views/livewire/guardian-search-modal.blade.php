<div>
    @if ($open)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-lg">

                <h2 class="font-bold text-lg mb-3">Buscar apoderado</h2>

                <input type="text" wire:model="search" wire:keyup="searchGuardians"
                    class="w-full border rounded px-3 py-2 mb-4" placeholder="Buscar por nombre o RUT">

                <ul class="max-h-64 overflow-y-auto border rounded divide-y">
                    @forelse(($results ?? collect()) as $g)
                        <li wire:key="guardian-result-{{ $g->id }}"
                            class="px-3 py-2 flex justify-between items-center hover:bg-gray-100">
                            <div>
                                <div class="font-semibold">{{ $g->full_name }}</div>
                                <div class="text-sm text-gray-500">{{ $g->rut }}</div>
                            </div>

                            <button wire:click="selectGuardian({{ $g->id }})"
                                class="text-xs text-blue-600 font-semibold">
                                Seleccionar
                            </button>
                        </li>
                    @empty
                        <li class="px-3 py-2 text-sm text-gray-500">
                            Sin resultados…
                        </li>
                    @endforelse
                </ul>

                <div class="mt-4 flex justify-between items-center">
                    <button wire:click="$dispatch('open-guardian-create', { type: '{{ $type }}' })"
                        class="text-sm text-blue-600">
                        Registrar nuevo apoderado
                    </button>

                    <button wire:click="$set('open', false)" class="text-sm text-gray-600">
                        Cerrar
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
