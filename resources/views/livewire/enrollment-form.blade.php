<div class="space-y-6">

    {{-- Mensajes --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-2 rounded">
            {{ session('success') }}
        </div>
    @endif

    {{-- FILA 1: Estudiante --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
        <div>
            <label>RUT estudiante</label>
            <input type="text" wire:model.debounce.500ms="studentRut"
                class="w-full border rounded px-2 py-1">
        </div>

        <div>
            <label>Nombre estudiante</label>
            <input type="text" disabled
                value="{{ $studentFullName }}"
                class="w-full border rounded px-2 py-1 bg-gray-100">
        </div>

        @if(!$enrollmentId)
        <button wire:click="$dispatch('open-student-search')"
                class="px-4 py-2 border rounded bg-blue-100">
            Buscar
        </button>
        @endif
    </div>

    {{-- FILA 2: Curso --}}
    <div>
        <label>Curso {{ $schoolYear }}</label>
        <select wire:model="courseId" class="w-full border rounded px-2 py-1">
            <option value="">(Asignar después)</option>
            @foreach($courses as $c)
                <option value="{{ $c->id }}">
                    {{ $c->gradeLevel->name }}
                    @if($c->letter) {{ $c->letter }} @endif
                    @if($c->specialty) - {{ $c->specialty }} @endif
                </option>
            @endforeach
        </select>
    </div>

    {{-- FILA 3: Apoderado Titular --}}
    <div>
        <label>Apoderado titular</label>

        @if($guardianTitularId)
            <div class="border rounded p-3 bg-gray-50 flex justify-between items-center">
                <div>
                    <strong>{{ $guardianTitularName }}</strong><br>
                    <small>{{ $guardianTitularRut }}</small>
                </div>
                <button wire:click="$dispatch('open-guardian-modal', { type: 'titular' })"
                        class="text-blue-600">Cambiar</button>
            </div>
        @else
            <button wire:click="$dispatch('open-guardian-modal', { type: 'titular' })"
                    class="px-3 py-2 border rounded bg-blue-100">
                Buscar / Registrar apoderado
            </button>
        @endif
    </div>

    {{-- FILA 4: Apoderado Suplente --}}
    <div>
        <label>Apoderado suplente (opcional)</label>

        @if($guardianSuplenteId)
            <div class="border rounded p-3 bg-gray-50 flex justify-between items-center">
                <div>
                    <strong>{{ $guardianSuplenteName }}</strong><br>
                    <small>{{ $guardianSuplenteRut }}</small>
                </div>
                <button wire:click="$dispatch('open-guardian-modal', { type: 'suplente' })"
                        class="text-blue-600">Cambiar</button>
            </div>
        @else
            <button wire:click="$dispatch('open-guardian-modal', { type: 'suplente' })"
                    class="px-3 py-2 border rounded bg-blue-100">
                Buscar / Registrar apoderado
            </button>
        @endif
    </div>

    {{-- FILA 5: Vive con --}}
    <div>
        <label>¿Con quién vive?</label>
        <input type="text" wire:model="lives_with"
            class="w-full border rounded px-2 py-1">
    </div>

    {{-- FILA 6: Salud y autorizaciones --}}
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="font-semibold">Salud</label>
            <label class="block"><input type="checkbox" wire:model="is_pie_student"> Alumno PIE</label>
            <label class="block"><input type="checkbox" wire:model="needs_lunch"> Necesita almuerzo</label>
        </div>

        <div>
            <label class="font-semibold">Autorizaciones</label>
            <label class="block"><input type="checkbox" wire:model="consent_extra_activities"> Actividades extraescolares</label>
            <label class="block"><input type="checkbox" wire:model="consent_photos"> Fotografías pedagógicas</label>
            <label class="block"><input type="checkbox" wire:model="consent_school_bus"> Bus de acercamiento</label>
            <label class="block"><input type="checkbox" wire:model="consent_internet"> Uso de internet</label>
        </div>
    </div>

    {{-- BOTÓN GUARDAR --}}
    <button wire:click="save"
            class="px-6 py-3 bg-blue-600 text-white rounded shadow">
        Guardar matrícula
    </button>

    {{-- MODALES --}}
    @livewire('guardian-search-modal')
    @livewire('guardian-create-modal')
</div>
