<div>

    {{-- BOTÓN NUEVO --}}
    <div class="mb-4">
        <a href="{{ route('users.create') }}"
            class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
            Nuevo usuario
        </a>
    </div>

    {{-- FILTROS --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4 bg-white p-4 rounded shadow">

        {{-- Buscar --}}
        <div>
            <label class="text-sm font-medium mb-1 block">Buscar</label>
            <input type="text" wire:model.live="search" placeholder="Nombre / RUT / Email"
                class="w-full border rounded px-3 py-2">
        </div>

        {{-- Rol --}}
        <div>
            <label class="text-sm font-medium mb-1 block">Rol</label>
            <select wire:model.live="role" class="w-full border rounded px-3 py-2">
                <option value="">Todos</option>
                @foreach ($roles as $r)
                    <option value="{{ $r }}">{{ $r }}</option>
                @endforeach
            </select>
        </div>

        {{-- Estado --}}
        <div>
            <label class="text-sm font-medium mb-1 block">Estado</label>
            <select wire:model.live="status" class="w-full border rounded px-3 py-2">
                <option value="">Todos</option>
                <option value="active">Activo</option>
                <option value="inactive">Inactivo</option>
            </select>
        </div>

    </div>

    {{-- TABLA --}}
    <div class="overflow-x-auto bg-white rounded shadow">
        <table class="min-w-full text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-3 py-2">Nombre</th>
                    <th class="px-3 py-2">RUT</th>
                    <th class="px-3 py-2">Email</th>
                    <th class="px-3 py-2">Rol</th>
                    <th class="px-3 py-2">Estado</th>
                    <th class="px-3 py-2">Acciones</th>
                </tr>
            </thead>

            <tbody>
                @forelse($users as $user)
                    <tr class="border-t">
                        <td class="px-3 py-2">{{ $user->name }}</td>
                        <td class="px-3 py-2">{{ $user->rut }}</td>
                        <td class="px-3 py-2">{{ $user->email }}</td>
                        <td class="px-3 py-2">
                            {{ $user->roles->pluck('name')->join(', ') }}
                        </td>
                        <td class="px-3 py-2">
                            @if ($user->active)
                                <span class="px-2 py-0.5 bg-green-100 text-green-800 rounded text-xs">Activo</span>
                            @else
                                <span class="px-2 py-0.5 bg-gray-200 text-gray-700 rounded text-xs">Inactivo</span>
                            @endif
                        </td>
                        <td class="px-3 py-2">
                            <div class="flex gap-1">

                                {{-- Editar --}}
                                <a href="{{ route('users.edit', $user) }}"
                                    class="inline-flex items-center gap-1 px-2 py-1 text-xs
                  border border-blue-500 text-blue-600 rounded
                  hover:bg-blue-50">
                                    ✏️ Editar
                                </a>

                                {{-- Activar / Desactivar --}}
                                <form action="{{ route('users.toggle', $user) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button
                                        class="inline-flex items-center gap-1 px-2 py-1 text-xs
                       border rounded
                       {{ $user->active
                           ? 'border-yellow-500 text-yellow-700 hover:bg-yellow-50'
                           : 'border-green-500 text-green-700 hover:bg-green-50' }}">
                                        {{ $user->active ? '⏸ Desactivar' : '▶ Activar' }}
                                    </button>
                                </form>

                                {{-- Eliminar --}}
                                <form action="{{ route('users.destroy', $user) }}" method="POST"
                                    onsubmit="return confirm('¿Eliminar usuario?')">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        class="inline-flex items-center gap-1 px-2 py-1 text-xs
                       border border-red-500 text-red-600 rounded
                       hover:bg-red-50">
                                        🗑 Eliminar
                                    </button>
                                </form>

                            </div>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-gray-500">
                            No hay usuarios registrados.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="p-4">
            {{ $users->links() }}
        </div>
    </div>

</div>
