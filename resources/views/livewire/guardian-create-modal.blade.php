<div>
    @if($open)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
                <h2 class="font-bold text-lg mb-4">Registrar nuevo apoderado</h2>

                <div class="space-y-3">
                    <div>
                        <label class="block text-sm font-medium">RUT</label>
                        <input type="text" wire:model="rut"
                               class="w-full border rounded px-3 py-2">
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Nombres</label>
                        <input type="text" wire:model="first_name"
                               class="w-full border rounded px-3 py-2">
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Apellido paterno</label>
                        <input type="text" wire:model="last_name_father"
                               class="w-full border rounded px-3 py-2">
                    </div>

                    <div>
                        <label class="block text-sm font-medium">Apellido materno</label>
                        <input type="text" wire:model="last_name_mother"
                               class="w-full border rounded px-3 py-2">
                    </div>
                </div>

                <div class="mt-6 flex justify-between">
                    <button wire:click="save"
                            class="px-4 py-2 bg-blue-600 text-white rounded">
                        Guardar apoderado
                    </button>

                    <button wire:click="$set('open', false)"
                            class="px-4 py-2 text-gray-600">
                        Cancelar
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
