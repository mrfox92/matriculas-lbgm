<div class="space-y-4">

    {{-- Filtros --}}
    <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
        <div>
            <label class="block text-sm font-medium">Año</label>
            <input type="number" wire:model="schoolYear" class="w-full border rounded px-2 py-1">
        </div>

        <div>
            <label class="block text-sm font-medium">Curso</label>
            <select wire:model="courseId" class="w-full border rounded px-2 py-1">
                <option value="">Todos</option>
                @foreach($courses as $course)
                    <option value="{{ $course->id }}">
                        {{ $course->gradeLevel->name }}
                        @if($course->letter) {{ $course->letter }} @endif
                        @if($course->specialty) - {{ $course->specialty }} @endif
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium">Tipo alumno</label>
            <select wire:model="enrollmentType"
                    class="w-full border rounded px-2 py-1">
                <option value="">Todos</option>
                <option value="New Student">Nuevo</option>
                <option value="Returning Student">Antiguo</option>
            </select>
        </div>


        <div>
            <label class="block text-sm font-medium">Estado</label>
            <select wire:model="status" class="w-full border rounded px-2 py-1">
                <option value="">Todos</option>
                <option value="Pending">Pendiente</option>
                <option value="Confirmed">Confirmada</option>
                <option value="Cancelled">Anulada</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium">Buscar por nombre / RUT</label>
            <input type="text" wire:model.debounce.500ms="search"
                   class="w-full border rounded px-2 py-1">
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
                            @if($enr->course)
                                {{ $enr->course->gradeLevel->name }}
                                @if($enr->course->letter) {{ $enr->course->letter }} @endif
                                @if($enr->course->specialty) - {{ $enr->course->specialty }} @endif
                            @else
                                <span class="text-gray-400">Por asignar</span>
                            @endif
                        </td>
                        <td class="px-2 py-1 border">
                            {{ optional($enr->guardianTitular)->full_name }}
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
                        <td>
                            @if($enr->status === 'Confirmed')
                                <span class="px-2 py-1 rounded bg-green-100 text-green-800">Confirmada</span>
                            @elseif($enr->status === 'Pending')
                                <span class="px-2 py-1 rounded bg-yellow-100 text-yellow-800">Pendiente</span>
                            @else
                                <span class="px-2 py-1 rounded bg-red-100 text-red-800">Cancelada</span>
                            @endif
                        </td>

                        <td class="px-2 py-1 border space-x-2">
                            <a href="{{ route('enrollments.edit', $enr) }}"
                               class="text-blue-600 underline">Editar</a>
                            <a href="{{ route('enrollments.pdf', $enr) }}"
                               class="text-green-600 underline" target="_blank">
                                PDF
                            </a>
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
