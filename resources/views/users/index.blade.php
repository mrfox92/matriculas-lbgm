<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Usuarios del sistema') }}
        </h2>
    </x-slot>


    <div class="py-8">
        @if (session('status'))
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="mb-4 text-sm text-green-700 bg-green-100 rounded px-4 py-2">
                    {{ session('status') }}
                </div>
            </div>
        @endif
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Botón crear digitador --}}
            <div class="mb-4">
                <a href="{{ route('users.create') }}"
                    class="px-4 py-2 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700">
                    Nuevo usuario
                </a>
            </div>

            {{-- Filtros --}}
            <div class="bg-white p-4 rounded-lg shadow mb-6">

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                    {{-- Buscar --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Buscar</label>
                        <input type="text" placeholder="Nombre / RUT / Email"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    {{-- Rol --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Rol</label>
                        <select
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Todos</option>
                            @foreach ($roles as $role)
                                <option>{{ ucfirst($role) }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Estado --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Estado</label>
                        <select
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Todos</option>
                            <option value="1">Activos</option>
                            <option value="0">Inactivos</option>
                        </select>
                    </div>

                </div>
            </div>


            {{-- Tabla de usuarios --}}
            <div class="bg-white overflow-hidden shadow-sm rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wide">
                                Nombre</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wide">
                                RUT</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wide">
                                Email</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wide">
                                Rol</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wide">
                                Estado</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wide">
                                Acciones</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200">

                        @foreach ($users as $user)
                            <tr>
                                <td class="px-4 py-2">{{ $user->name }}</td>
                                <td class="px-4 py-2">{{ $user->rut }}</td>
                                <td class="px-4 py-2">{{ $user->email }}</td>

                                {{-- roles --}}
                                <td class="px-4 py-2">
                                    {{ $user->roles->pluck('name')->join(', ') ?: '—' }}
                                </td>

                                <td class="px-4 py-2">
                                    @if ($user->active)
                                        <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">
                                            Activo
                                        </span>
                                    @else
                                        <span class="bg-red-100 text-red-800 text-xs px-2 py-1 rounded-full">
                                            Inactivo
                                        </span>
                                    @endif
                                </td>

                                <td class="px-4 py-2 space-x-2">

                                    {{-- Editar --}}
                                    <a href="{{ route('users.edit', $user) }}"
                                        class="text-blue-600 hover:underline">Editar</a>

                                    {{-- Activar / desactivar --}}
                                    <form method="POST" action="{{ route('users.toggle', $user) }}" class="inline">
                                        @csrf
                                        @method('PATCH')

                                        <button class="text-yellow-600 hover:underline">
                                            {{ $user->active ? 'Desactivar' : 'Activar' }}
                                        </button>
                                    </form>


                                    {{-- Eliminar --}}
                                    <form method="POST" action="{{ route('users.destroy', $user) }}" class="inline"
                                        onsubmit="return confirm('¿Seguro que deseas eliminar este usuario?')">
                                        @csrf
                                        @method('DELETE')

                                        <button class="text-red-600 hover:underline">
                                            Eliminar
                                        </button>
                                    </form>

                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <!-- PAGINATE -->
            <div class="mt-4">
                {{ $users->links() }}
            </div>

        </div>
    </div>

</x-app-layout>
