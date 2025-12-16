<div class="space-y-4">

    {{-- Filtros --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
            <label class="text-sm font-medium">Año</label>
            <input type="number" wire:model="schoolYear"
                   class="w-full border rounded px-2 py-1">
        </div>

        <div>
            <label class="text-sm font-medium">Curso</label>
            <select wire:model="courseId" class="w-full border rounded px-2 py-1">
                <option value="">Todos</option>
                @foreach ($courses as $course)
                    <option value="{{ $course->id }}">
                        {{ $course->gradeLevel->name }}
                        {{ $course->letter }}
                        {{ $course->specialty }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="text-sm font-medium">Buscar alumno / RUT</label>
            <input type="text" wire:model.debounce.400ms="search"
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
                    <th class="border px-2 py-1">Apoderado</th>
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
                            {{ optional($enr->course->gradeLevel)->name }}
                            {{ $enr->course->letter }}
                        </td>
                        <td class="border px-2 py-1">
                            {{ optional($enr->guardianTitular)->full_name }}
                        </td>
                        <td class="border px-2 py-1 space-x-2">
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
                        <td colspan="6"
                            class="text-center text-gray-500 py-4 border">
                            No hay matrículas nuevas registradas.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $enrollments->links() }}
</div>
