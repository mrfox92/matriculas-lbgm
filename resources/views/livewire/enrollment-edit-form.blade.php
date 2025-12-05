{{-- resources/views/livewire/enrollment-edit-form.blade.php --}}

<div class="space-y-10">

    {{-- Mensaje de éxito --}}
    @if (session('success'))
        <div class="p-4 bg-green-100 text-green-800 rounded-lg shadow">
            {{ session('success') }}
        </div>
    @endif


    {{-- ============================================================
         SECCIÓN 1: DATOS DEL ESTUDIANTE
         ============================================================ --}}
    <div class="bg-white p-6 rounded-xl shadow-sm border">
        <h2 class="text-2xl font-bold mb-6">Datos del estudiante</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

            {{-- RUT --}}
            <div>
                <label class="font-semibold">RUT</label>
                <input type="text" wire:model="rut" class="w-full mt-1 px-3 py-2 border rounded-lg">
            </div>

            {{-- Nombres --}}
            <div class="md:col-span-2">
                <label class="font-semibold">Nombres</label>
                <input type="text" wire:model="first_name" class="w-full mt-1 px-3 py-2 border rounded-lg">
            </div>

            {{-- Apellido paterno --}}
            <div>
                <label class="font-semibold">Apellido paterno</label>
                <input type="text" wire:model="last_name_father" class="w-full mt-1 px-3 py-2 border rounded-lg">
            </div>

            {{-- Apellido materno --}}
            <div>
                <label class="font-semibold">Apellido materno</label>
                <input type="text" wire:model="last_name_mother" class="w-full mt-1 px-3 py-2 border rounded-lg">
            </div>

            {{-- Género --}}
            <div>
                <label class="font-semibold">Género</label>
                <select wire:model="gender" class="w-full mt-1 px-3 py-2 border rounded-lg">
                    <option value="">Seleccione…</option>
                    <option value="Femenino">Femenino</option>
                    <option value="Masculino">Masculino</option>
                    <option value="Otro">Otro</option>
                </select>
            </div>

            {{-- Nacimiento --}}
            <div>
                <label class="font-semibold">Fecha de nacimiento</label>
                <input type="date" wire:model="birth_date" class="w-full mt-1 px-3 py-2 border rounded-lg">
            </div>

            {{-- Nacionalidad --}}
            <div>
                <label class="font-semibold">Nacionalidad</label>
                <input type="text" wire:model="nationality" class="w-full mt-1 px-3 py-2 border rounded-lg">
            </div>

            {{-- Religión --}}
            <div>
                <label class="font-semibold">Religión</label>
                <select wire:model="religion" class="w-full mt-1 px-3 py-2 border rounded-lg">
                    <option value="">Seleccione…</option>
                    <option value="Católica">Católica</option>
                    <option value="Evangélica">Evangélica</option>
                    <option value="Otra">Otra</option>
                    <option value="Ninguna">Ninguna</option>
                </select>
            </div>

            @if ($religion === 'Otra')
                <div>
                    <label class="font-semibold">Especificar religión</label>
                    <input type="text" wire:model="religion_other" class="w-full mt-1 px-3 py-2 border rounded-lg">
                </div>
            @endif

            {{-- Pueblo originario --}}
            <div>
                <label class="font-semibold">¿Pertenece a pueblo originario?</label>
                <select wire:model="indigenous_ancestry" class="w-full mt-1 px-3 py-2 border rounded-lg">
                    <option value="0">No</option>
                    <option value="1">Sí</option>
                </select>
            </div>

            @if ($indigenous_ancestry)
                <div>
                    <label class="font-semibold">Indique el pueblo</label>
                    <input type="text" wire:model="indigenous_ancestry_type"
                           class="w-full mt-1 px-3 py-2 border rounded-lg" placeholder="Ej: Mapuche, Huilliche…">
                </div>
            @endif

            {{-- Dirección --}}
            <div class="md:col-span-2">
                <label class="font-semibold">Dirección</label>
                <input type="text" wire:model="address" class="w-full mt-1 px-3 py-2 border rounded-lg">
            </div>

            {{-- Comuna --}}
            <div>
                <label class="font-semibold">Comuna</label>
                <input type="text" wire:model="commune" class="w-full mt-1 px-3 py-2 border rounded-lg">
            </div>

            {{-- Teléfono --}}
            <div>
                <label class="font-semibold">Teléfono</label>
                <input type="text" wire:model="phone" class="w-full mt-1 px-3 py-2 border rounded-lg">
            </div>

            {{-- Fono emergencia --}}
            <div>
                <label class="font-semibold">Teléfono emergencia</label>
                <input type="text" wire:model="emergency_phone" class="w-full mt-1 px-3 py-2 border rounded-lg">
            </div>

            {{-- Salud --}}
            <div>
                <label class="font-semibold">Problemas de salud</label>
                <select wire:model="has_health_issues" class="w-full mt-1 px-3 py-2 border rounded-lg">
                    <option value="0">No</option>
                    <option value="1">Sí</option>
                </select>
            </div>

            @if ($has_health_issues)
                <div class="md:col-span-2">
                    <label class="font-semibold">Especificar</label>
                    <textarea wire:model="health_issues_details"
                              class="w-full mt-1 px-3 py-2 border rounded-lg"></textarea>
                </div>
            @endif

        </div>
    </div>



    {{-- ============================================================
         SECCIÓN 2: DATOS ACADÉMICOS
         ============================================================ --}}
    <div class="bg-white p-6 rounded-xl shadow-sm border">
        <h2 class="text-2xl font-bold mb-6">Datos académicos</h2>

        <label class="font-semibold">Curso {{ $enrollment->school_year }}</label>
        <select wire:model="course_id" class="w-full mt-1 px-3 py-2 border rounded-lg">
            <option value="">(Asignar después)</option>
            @foreach ($courses as $c)
                <option value="{{ $c->id }}">
                    {{ $c->gradeLevel->name }}
                    @if ($c->letter) {{ $c->letter }} @endif
                    @if ($c->specialty) — {{ $c->specialty }} @endif
                </option>
            @endforeach
        </select>
    </div>



    {{-- ============================================================
         SECCIÓN 3: APODERADOS
         ============================================================ --}}
    <div class="bg-white p-6 rounded-xl shadow-sm border space-y-6">

        <h2 class="text-2xl font-bold mb-4">Apoderados</h2>

        {{-- TITULAR --}}
        <div>
            <label class="font-semibold">Apoderado titular</label>

            @if ($guardianTitular)
                <div class="p-3 bg-gray-50 border rounded-lg flex justify-between items-center">
                    <div>
                        <strong>{{ $guardianTitular->full_name }}</strong><br>
                        <small>{{ $guardianTitular->rut }}</small>
                    </div>

                    <button wire:click="$dispatch('open-guardian-modal', { type: 'titular' })"
                            class="text-blue-600 font-semibold">
                        Cambiar
                    </button>
                </div>
            @else
                <button wire:click="$dispatch('open-guardian-modal', { type: 'titular' })"
                        class="px-4 py-2 bg-blue-100 border rounded-lg">
                    Buscar / Registrar apoderado
                </button>
            @endif
        </div>

        {{-- SUPLENTE --}}
        <div>
            <label class="font-semibold">Apoderado suplente (opcional)</label>

            @if ($guardianSuplente)
                <div class="p-3 bg-gray-50 border rounded-lg flex justify-between items-center">
                    <div>
                        <strong>{{ $guardianSuplente->full_name }}</strong><br>
                        <small>{{ $guardianSuplente->rut }}</small>
                    </div>

                    <button wire:click="$dispatch('open-guardian-modal', { type: 'suplente' })"
                            class="text-blue-600 font-semibold">
                        Cambiar
                    </button>
                </div>
            @else
                <button wire:click="$dispatch('open-guardian-modal', { type: 'suplente' })"
                        class="px-4 py-2 bg-blue-100 border rounded-lg">
                    Buscar / Registrar apoderado
                </button>
            @endif
        </div>
    </div>



    {{-- ============================================================
         SECCIÓN 4: DATOS FAMILIARES
         ============================================================ --}}
    <div class="bg-white p-6 rounded-xl shadow-sm border">
        <h2 class="text-2xl font-bold mb-4">Datos familiares</h2>

        <label class="font-semibold">¿Con quién vive el estudiante?</label>
        <input type="text" wire:model="lives_with" class="w-full mt-1 px-3 py-2 border rounded-lg">
    </div>



    {{-- ============================================================
         SECCIÓN 5: SALUD Y AUTORIZACIONES
         ============================================================ --}}
    <div class="bg-white p-6 rounded-xl shadow-sm border grid grid-cols-1 md:grid-cols-2 gap-6">

        {{-- Salud --}}
        <div>
            <h2 class="text-2xl font-bold mb-4">Salud</h2>

            <label class="block">
                <input type="checkbox" wire:model="is_pie_student">
                Alumno PIE
            </label>

            <label class="block">
                <input type="checkbox" wire:model="needs_lunch">
                Necesita almuerzo
            </label>
        </div>

        {{-- Autorizaciones --}}
        <div>
            <h2 class="text-2xl font-bold mb-4">Autorizaciones</h2>

            <label class="block">
                <input type="checkbox" wire:model="consent_extra_activities">
                Actividades extraescolares
            </label>

            <label class="block">
                <input type="checkbox" wire:model="consent_photos">
                Fotografías pedagógicas
            </label>

            <label class="block">
                <input type="checkbox" wire:model="consent_school_bus">
                Bus de acercamiento
            </label>

            <label class="block">
                <input type="checkbox" wire:model="consent_internet">
                Uso de internet
            </label>
        </div>
    </div>



    {{-- ============================================================
         BOTONES DE ACCIÓN
         ============================================================ --}}
    <div class="flex justify-between items-center">

        {{-- Guardar --}}
        <button wire:click="save"
                class="px-6 py-3 bg-blue-600 text-white text-lg rounded-xl shadow hover:bg-blue-700">
            Guardar cambios
        </button>

        {{-- Completar matrícula --}}
        @if ($enrollment->status !== 'Confirmed')
            <button wire:click="completeEnrollment"
                    class="px-6 py-3 bg-green-600 text-white text-lg rounded-xl shadow hover:bg-green-700">
                Marcar como COMPLETADA
            </button>
        @endif

        {{-- PDF --}}
        @if ($enrollment->status === 'Confirmed')
            <a href="{{ route('enrollments.pdf', $enrollment->id) }}"
               target="_blank"
               class="px-6 py-3 bg-gray-100 border rounded-xl shadow text-gray-700 hover:bg-gray-200">
                📄 Descargar ficha PDF
            </a>
        @endif

    </div>


    {{-- INCLUIR MODALES --}}
    @livewire('guardian-search-modal')
    @livewire('guardian-create-modal')

</div>
