{{-- resources/views/livewire/enrollment-edit-form.blade.php --}}

<div class="space-y-10">

    {{-- Mensaje de éxito --}}
    {{-- @if (session('success'))
        <div class="p-4 bg-green-100 text-green-800 rounded-lg shadow">
            {{ session('success') }}
        </div>
    @endif --}}


    {{-- ============================================================
         SECCIÓN 1: DATOS DEL ESTUDIANTE
         ============================================================ --}}
    <div class="bg-white p-6 rounded-xl shadow-sm border">
        <h2 class="text-2xl font-bold mb-6">Datos del estudiante</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

            {{-- RUT --}}
            <div>
                <label class="font-semibold">RUT</label>
                <input type="text" wire:model="rut"
                    class="w-full mt-1 px-3 py-2 border rounded-lg
                @error('rut')
                    border-red-500 focus:border-red-500 focus:ring-red-500
                @enderror">

                @error('rut')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Nombres --}}
            <div class="md:col-span-2">
                <label class="font-semibold">Nombres</label>
                <input type="text" wire:model="first_name"
                    class="w-full mt-1 px-3 py-2 border rounded-lg
        @error('first_name') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror">

                @error('first_name')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>


            {{-- Apellido paterno --}}
            <div>
                <label class="font-semibold">Apellido paterno</label>
                <input type="text" wire:model="last_name_father"
                    class="w-full mt-1 px-3 py-2 border rounded-lg
        @error('last_name_father') border-red-500 focus:border-red-500 focus:ring-red-500 @enderror">

                @error('last_name_father')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
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
                <input type="date" wire:model.live="birth_date" class="w-full mt-1 px-3 py-2 border rounded-lg">
            </div>

            {{-- Nacionalidad --}}
            <div>
                <label class="font-semibold">Nacionalidad</label>
                <select wire:model="nationality" class="w-full mt-1 px-3 py-2 border rounded-lg">
                    <option value="">Seleccione…</option>
                    @foreach ($nationalities as $nat)
                        <option value="{{ $nat }}">{{ $nat }}</option>
                    @endforeach
                </select>

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
                <select wire:model.live="indigenous_ancestry" class="w-full mt-1 px-3 py-2 border rounded-lg">
                    <option value="0">No</option>
                    <option value="1">Sí</option>
                </select>
            </div>

            @if ($indigenous_ancestry == 1)
                <div>
                    <label class="font-semibold">Indique el pueblo originario</label>
                    <select wire:model.live="indigenous_ancestry_type" class="w-full mt-1 px-3 py-2 border rounded-lg">
                        <option value="">Seleccione…</option>
                        @foreach ($indigenousPeoples as $pueblo)
                            <option value="{{ $pueblo }}">{{ $pueblo }}</option>
                        @endforeach
                    </select>
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
                <select wire:model.live="has_health_issues" class="w-full mt-1 px-3 py-2 border rounded-lg">
                    <option value="0">No</option>
                    <option value="1">Sí</option>
                </select>
            </div>

            @if ($has_health_issues == 1)
                <div class="md:col-span-2">
                    <label class="font-semibold">Especificar problema de salud</label>
                    <textarea wire:model.live="health_issues_details" class="w-full mt-1 px-3 py-2 border rounded-lg"
                        placeholder="Ej: asma, alergias alimentarias, epilepsia…"></textarea>
                </div>
            @endif

        </div>

        {{-- SALUD DEL ESTUDIANTE --}}
        <div class="mt-6 py-2 border-t pt-4">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <label class="flex items-center gap-2">
                    <input type="checkbox" wire:model="is_pie_student" class="mt-1 rounded border-gray-300">
                    Alumno PIE
                </label>

                <label class="flex items-center gap-2">
                    <input type="checkbox" wire:model="needs_lunch" class="mt-1 rounded border-gray-300">
                    Necesita almuerzo
                </label>
            </div>
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
                    @if ($c->letter)
                        {{ $c->letter }}
                    @endif
                    @if ($c->specialty)
                        — {{ $c->specialty }}
                    @endif
                </option>
            @endforeach
        </select>
    </div>

    {{-- MENSAJES DE APODERADOS --}}
    @if ($guardianMessage)
        <div
            class="mb-4 rounded-lg p-3 text-sm
        {{ $guardianMessageType === 'error' ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700' }}">
            {{ $guardianMessage }}
        </div>
    @endif



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

                    <button wire:click="openGuardianTitular" class="text-blue-600 font-semibold">
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

                    <button wire:click="openGuardianSuplente" class="text-blue-600 font-semibold">
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
        <input type="text" wire:model="lives_with" class="w-full mt-1 px-3 py-2 border rounded-lg"
            placeholder="Ej: ambos padres, abuelos, madre...">

        <label class="font-semibold mt-4 block">
            Parentesco del apoderado titular
        </label>

        <select wire:model.live="guardian_relationship" class="w-full mt-1 px-3 py-2 border rounded-lg">
            <option value="">Seleccione…</option>
            <option value="Madre">Madre</option>
            <option value="Padre">Padre</option>
            <option value="Otro">Otro</option>
        </select>

        @if ($guardian_relationship === 'Otro')
            <input type="text" wire:model.live="guardian_relationship_other"
                class="w-full mt-2 px-3 py-2 border rounded-lg"
                placeholder="Ej: abuelo, tía, hermano mayor, tutor legal">
        @endif


    </div>


    {{-- ============================================================
         SECCIÓN 5: AUTORIZACIONES y DECLARACIONES
         ============================================================ --}}
    <div class="bg-white rounded-lg shadow p-6 mt-6">
        <h3 class="font-semibold text-lg mb-4">
            Autorizaciones y declaraciones
        </h3>

        <div class="space-y-3 text-sm">
            <label class="flex gap-2">
                <input type="checkbox" wire:model="consent_extra_activities" class="mt-1 rounded border-gray-300">
                Autorizo a mi hijo/a a participar en actividades extra-programáticas
                y extra-escolares dentro y fuera del establecimiento.
            </label>

            <label class="flex gap-2">
                <input type="checkbox" wire:model="consent_photos" class="mt-1 rounded border-gray-300">
                Autorizo el uso de fotografías y/o material audiovisual con fines
                pedagógicos e institucionales.
            </label>

            <label class="flex gap-2">
                <input type="checkbox" wire:model="consent_school_bus" class="mt-1 rounded border-gray-300">
                Autorizo el traslado del estudiante en buses de acercamiento escolar.
            </label>

            <label class="flex gap-2">
                <input type="checkbox" wire:model="consent_internet" class="mt-1 rounded border-gray-300">
                Autorizo el uso de recursos digitales e internet con fines educativos.
            </label>
        </div>
    </div>


    {{-- ============================= --}}
    {{-- REGLAMENTO Y CONVIVENCIA --}}
    {{-- ============================= --}}
    <div class="bg-white rounded-lg shadow p-6 mt-6">
        <h3 class="text-lg font-semibold mb-4">
            Reglamento y Convivencia Escolar
        </h3>

        <p class="text-sm text-gray-600 mb-4">
            Para completar el proceso de matrícula, el/la apoderado/a debe declarar
            haber leído y aceptado los reglamentos institucionales vigentes.
        </p>

        <div class="space-y-3 text-sm">

            <label class="flex gap-2">
                <input type="checkbox" wire:model="accept_school_rules" class="mt-1 rounded border-gray-300">
                Declaro haber leído y aceptado el Reglamento de Evaluación del establecimiento.
            </label>

            <label class="flex gap-2">
                <input type="checkbox" wire:model="accept_coexistence_rules" class="mt-1 rounded border-gray-300">
                Declaro haber leído el
                Manual de Convivencia Escolar 2026.
            </label>

            <label class="flex gap-2">
                <input type="checkbox" wire:model="accept_terms_conditions" class="mt-1 rounded border-gray-300">
                Acepto los
                <strong>términos y condiciones</strong>
                del proceso de matrícula.
            </label>

            {{-- Errores --}}
            @error('accept_school_rules')
                <p class="text-sm text-red-600">{{ $message }}</p>
            @enderror

            @error('accept_coexistence_rules')
                <p class="text-sm text-red-600">{{ $message }}</p>
            @enderror

            @error('accept_terms_conditions')
                <p class="text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        @if ($accepted_at ?? false)
            <p class="text-xs text-gray-500 mt-4">
                Reglamentos aceptados el {{ $accepted_at->format('d/m/Y H:i') }}.
            </p>
        @endif
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
            <a href="{{ route('enrollments.pdf.view', $enrollment) }}" target="_blank"
                class="px-6 py-3 bg-gray-100 border rounded-xl shadow text-gray-700 hover:bg-gray-200">
                📄 Descargar ficha PDF
            </a>
        @endif

    </div>


    {{-- INCLUIR MODALES --}}
    @livewire('guardian-search-modal')
    @livewire('guardian-create-modal')

</div>
