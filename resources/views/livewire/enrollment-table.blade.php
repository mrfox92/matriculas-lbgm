<div class="space-y-4">

    {{-- FILTROS --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">

        {{-- Curso --}}
        <div>
            <label class="block text-sm font-medium mb-1">Curso</label>
            <select wire:model.live="courseId" class="w-full border rounded px-3 py-2">
                <option value="">Todos</option>
                @foreach ($courses as $course)
                    <option value="{{ $course->id }}">
                        {{ $course->full_name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Tipo alumno --}}
        <div>
            <label class="block text-sm font-medium mb-1">Tipo alumno</label>
            <select wire:model.live="enrollmentType" class="w-full border rounded px-3 py-2">
                <option value="">Todos</option>
                <option value="New Student">Nuevo</option>
                <option value="Returning Student">Antiguo</option>
            </select>
        </div>

        {{-- Estado --}}
        <div>
            <label class="block text-sm font-medium mb-1">Estado</label>
            <select wire:model.live="status" class="w-full border rounded px-3 py-2">
                <option value="">Todos</option>
                <option value="Pending">Pendiente</option>
                <option value="Confirmed">Confirmada</option>
            </select>
        </div>

        {{-- Buscar --}}
        <div>
            <label class="block text-sm font-medium mb-1">Buscar por nombre / RUT</label>
            <input type="text" wire:model.live="search" wire:keyup.debounce.400ms="$refresh"
                class="w-full border rounded px-3 py-2" placeholder="Ej: 22.847.919-5 o Juan">
        </div>

    </div>

    {{-- Tabla --}}
    <div class="overflow-x-auto">
        <table class="min-w-full border text-sm mt-4">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-2 py-1 border">#</th>
                    <th class="px-2 py-1 border">Estudiante</th>
                    <th class="px-2 py-1 border">RUT</th>
                    <th class="px-2 py-1 border">Curso</th>
                    <th class="px-2 py-1 border">Apoderado titular</th>
                    <th class="px-2 py-1 border">Tipo alumno</th>
                    <th class="px-2 py-1 border">Estado</th>
                    <th class="px-2 py-1 border">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($enrollments as $i => $enr)
                    <tr class="{{ $i % 2 ? 'bg-gray-50' : 'bg-white' }}">
                        <td class="px-2 py-1 border">{{ $enr->id }}</td>
                        <td class="px-2 py-1 border">{{ $enr->student->full_name }}</td>
                        <td class="px-2 py-1 border">{{ $enr->student->rut }}</td>
                        <td class="px-2 py-1 border">
                            {{ $enr->course?->full_name ?? 'Por asignar' }}
                        </td>

                        <td class="px-2 py-1 border">
                            @if ($enr->guardianTitular)
                                {{ $enr->guardianTitular->full_name }}
                            @else
                                <span class="text-gray-400 italic">
                                    No informado
                                </span>
                            @endif
                        </td>
                        <!-- Tipo alumno -->
                        <td class="px-2 py-1 border">
                            @if ($enr->enrollment_type === 'New Student')
                                <span class="px-2 py-1 rounded bg-blue-100 text-blue-800 text-xs font-semibold">
                                    Nuevo
                                </span>
                            @else
                                <span class="px-2 py-1 rounded bg-gray-100 text-gray-800 text-xs font-semibold">
                                    Antiguo
                                </span>
                            @endif
                        </td>
                        <!-- Estado proceso matricula -->
                        <td class="px-2 py-1 border">
                            @if ($enr->status === 'Confirmed')
                                <span class="px-2 py-1 rounded bg-green-100 text-green-800">Confirmada</span>
                            @elseif($enr->status === 'Pending')
                                <span class="px-2 py-1 rounded bg-yellow-100 text-yellow-800">Pendiente</span>
                            @else
                                <span class="px-2 py-1 rounded bg-red-100 text-red-800">Cancelada</span>
                            @endif
                        </td>

                        <td class="border px-2 py-1">
                            {{-- <a href="{{ route('enrollments.pdf', $enr) }}" class="text-green-600 underline"
                                target="_blank">
                                PDF
                            </a> --}}
                            <div class="flex items-center justify-center gap-2">

                                {{-- Editar --}}
                                <a href="{{ route('enrollments.edit', $enr) }}" title="Editar matrícula"
                                    aria-label="Editar matrícula"
                                    class="inline-flex items-center gap-1 px-2 py-1 text-xs
                  border border-blue-500 text-blue-600 rounded
                  hover:bg-blue-50">
                                    {{-- Icono lápiz --}}
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5M18.5 2.5a2.121 2.121 0 113 3L12 15l-4 1 1-4 9.5-9.5z" />
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

                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-2 py-4 border text-center text-gray-500">
                            No hay matrículas registradas.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div>
        {{ $enrollments->links() }}
    </div>
</div>
