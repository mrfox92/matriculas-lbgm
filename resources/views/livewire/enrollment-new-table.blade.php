<div class="space-y-4">

    {{-- Filtros --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

        <div>
            <label class="text-sm font-medium">Curso</label>
            <select wire:model.live="courseId" class="w-full border rounded px-2 py-1">
                <option value="">Todos</option>
                @foreach ($courseOptions as $opt)
                    <option value="{{ $opt['id'] }}">
                        {{ $opt['label'] }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="text-sm font-medium">Estado</label>
            <select wire:model.live="status" class="w-full border rounded px-2 py-1">
                <option value="">Todos</option>
                <option value="Pending">Pendiente</option>
                <option value="Confirmed">Confirmada</option>
                <option value="Cancelled">Cancelada</option>
            </select>
        </div>

        <div>
            <label class="text-sm font-medium">Buscar alumno / RUT</label>
            <input type="text" wire:model="search" wire:keyup.debounce.400ms="$refresh" placeholder="Nombre o RUT"
                class="w-full border rounded px-2 py-1">
        </div>

    </div>


    {{-- Tabla --}}
    <div class="overflow-x-auto">
        <table class="min-w-full border text-sm mt-4">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border px-2 py-1">#</th>
                    <th class="border px-2 py-1">Estudiante</th>
                    <th class="border px-2 py-1">RUT</th>
                    <th class="border px-2 py-1">Curso</th>
                    <th class="border px-2 py-1">Apoderado titular</th>
                    <th class="border px-2 py-1">Estado</th>
                    <th class="border px-2 py-1">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($enrollments as $enr)
                    <tr>
                        <td class="border px-2 py-1">{{ $enr->id }}</td>
                        <td class="border px-2 py-1">{{ $enr->student->full_name }}</td>
                        <td class="border px-2 py-1">{{ $enr->student->rut }}</td>
                        <td class="border px-2 py-1">
                            {{ $enr->course?->full_name ?? 'Por asignar' }}
                        </td>
                        <td class="border px-2 py-1">
                            {{ optional($enr->guardianTitular)->full_name }}
                        </td>
                        <td class="border px-2 py-1">
                            @switch($enr->status)
                                @case('Confirmed')
                                    <span class="px-2 py-1 rounded bg-green-100 text-green-800">
                                        Confirmada
                                    </span>
                                @break

                                @case('Pending')
                                    <span class="px-2 py-1 rounded bg-yellow-100 text-yellow-800">
                                        Pendiente
                                    </span>
                                @break

                                @case('Cancelled')
                                    <span class="px-2 py-1 rounded bg-red-100 text-red-800">
                                        Anulada
                                    </span>
                                @break

                                @default
                                    <span class="px-2 py-1 rounded bg-gray-100 text-gray-600">
                                        Desconocido
                                    </span>
                            @endswitch
                        </td>
                        <td class="border px-2 py-1">
                            <div class="flex items-center justify-center gap-2">

                                {{-- Editar --}}
                                <a href="{{ route('enrollments.edit', $enr) }}"
                                    class="inline-flex items-center gap-1 px-2 py-1 text-xs
                  border border-blue-500 text-blue-600 rounded hover:bg-blue-50">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5h2m-1-1v2m8 6l-9 9-4 1 1-4 9-9m3-3a2.121 2.121 0 00-3-3l-1 1 3 3 1-1z" />
                                    </svg>
                                    Editar
                                </a>

                                {{-- Ver / Imprimir --}}
                                <a href="{{ route('enrollments.pdf.view', $enr) }}" target="_blank"
                                    title="Ver o imprimir ficha" aria-label="Ver o imprimir ficha"
                                    class="inline-flex items-center gap-1 px-2 py-1 text-xs
                  border border-gray-400 text-gray-700 rounded
                  hover:bg-gray-100">
                                    {{-- Icono ojo --}}
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5
                         c4.478 0 8.268 2.943 9.542 7
                         -1.274 4.057-5.064 7-9.542 7
                         -4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    Ver
                                </a>

                                {{-- Descargar PDF --}}
                                <a href="{{ route('enrollments.pdf.download', $enr) }}" title="Descargar PDF"
                                    aria-label="Descargar PDF"
                                    class="inline-flex items-center gap-1 px-2 py-1 text-xs
                  bg-blue-600 text-white rounded
                  hover:bg-blue-700">
                                    {{-- Icono descarga --}}
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2M7 10l5 5m0 0l5-5m-5 5V4" />
                                    </svg>
                                    PDF
                                </a>

                                {{-- Cancelar matricula --}}
                                @role('admin')
                                    @if ($enr->status !== 'Cancelled')
                                        <button wire:click="askCancel({{ $enr->id }})"
                                            class="bg-red-600 text-white px-3 py-1 rounded text-sm">
                                            🗑️ Anular
                                        </button>
                                    @endif
                                @endrole

                            </div>
                        </td>

                    </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-gray-500 py-4 border">
                                No hay matrículas nuevas registradas.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $enrollments->links() }}
    </div>
