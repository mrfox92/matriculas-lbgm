<div class="space-y-6">

    {{-- ================= PASO 1 ================= --}}
    @if ($step === 1)
        <div class="max-w-5xl mx-auto bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-bold mb-4">Paso 1: Datos del estudiante</h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="text-sm font-medium">RUT</label>
                    <input wire:model="rut" class="w-full border rounded px-3 py-2">
                    @error('rut')
                        <div class="text-red-600 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="md:col-span-2">
                    <label class="text-sm font-medium">Nombres</label>
                    <input wire:model="first_name" class="w-full border rounded px-3 py-2">
                    @error('first_name')
                        <div class="text-red-600 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label class="text-sm font-medium">Apellido paterno</label>
                    <input wire:model="last_name_father" class="w-full border rounded px-3 py-2">
                    @error('last_name_father')
                        <div class="text-red-600 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label class="text-sm font-medium">Apellido materno</label>
                    <input wire:model="last_name_mother" class="w-full border rounded px-3 py-2">
                </div>

                <div>
                    <label class="text-sm font-medium">Género</label>
                    <select wire:model="gender" class="w-full border rounded px-3 py-2">
                        <option value="">—</option>
                        <option value="Femenino">Femenino</option>
                        <option value="Masculino">Masculino</option>
                        <option value="Otro">Otro</option>
                    </select>
                </div>

                <div>
                    <label class="text-sm font-medium">Fecha de nacimiento</label>
                    <input type="date" wire:model="birth_date" class="w-full border rounded px-3 py-2">
                    @error('birth_date')
                        <div class="text-red-600 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label class="text-sm font-medium">Nacionalidad</label>
                    <select wire:model="nationality" class="w-full border rounded px-3 py-2">
                        <option value="">—</option>
                        @foreach ($nationalities as $nat)
                            <option value="{{ $nat }}">{{ $nat }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="text-sm font-medium">Religión</label>
                    <select wire:model="religion" class="w-full border rounded px-3 py-2">
                        <option value="">—</option>
                        @foreach ($religions as $rel)
                            <option value="{{ $rel }}">{{ $rel }}</option>
                        @endforeach
                    </select>
                </div>

                @if ($religion === 'Otra')
                    <div class="md:col-span-3">
                        <label class="text-sm font-medium">Especifique religión</label>
                        <input wire:model="religion_other" class="w-full border rounded px-3 py-2">
                    </div>
                @endif

                <div>
                    <label class="text-sm font-medium">¿Pertenece a pueblo originario?</label>
                    <select wire:model.live="indigenous_ancestry" class="w-full border rounded px-3 py-2">
                        <option value="0">No</option>
                        <option value="1">Sí</option>
                    </select>

                </div>

                @if ($indigenous_ancestry == 1)
                    <select wire:model.live="indigenous_ancestry_type" class="w-full border rounded px-3 py-2">
                        <option value="">Seleccione…</option>
                        @foreach ($indigenousPeoples as $pueblo)
                            <option value="{{ $pueblo }}">{{ $pueblo }}</option>
                        @endforeach
                    </select>
                @endif


                <div class="md:col-span-2">
                    <label class="text-sm font-medium">Dirección</label>
                    <input wire:model="address" class="w-full border rounded px-3 py-2">
                </div>

                <div>
                    <label class="text-sm font-medium">Comuna</label>
                    <input wire:model="commune" class="w-full border rounded px-3 py-2">
                </div>

                <div>
                    <label class="text-sm font-medium">Teléfono</label>
                    <input wire:model="phone" class="w-full border rounded px-3 py-2">
                </div>

                <div>
                    <label class="text-sm font-medium">Teléfono emergencia</label>
                    <input wire:model="emergency_phone" class="w-full border rounded px-3 py-2">
                </div>

                <div>
                    <label class="text-sm font-medium">Problemas de salud</label>
                    <select wire:model.live="has_health_issues" class="w-full border rounded px-3 py-2">
                        <option value="0">No</option>
                        <option value="1">Sí</option>
                    </select>

                </div>

                @if ($has_health_issues == 1)
                    <textarea wire:model.live="health_issues_details" class="w-full border rounded px-3 py-2"
                        placeholder="Ej: asma, alergias, epilepsia…"></textarea>
                @endif

            </div>

            <div class="border-t mt-6 pt-4 flex items-center gap-8">
                <label class="flex items-center gap-2">
                    <input type="checkbox" wire:model="is_pie_student">
                    Alumno PIE
                </label>

                <label class="flex items-center gap-2">
                    <input type="checkbox" wire:model="needs_lunch">
                    Necesita almuerzo
                </label>
            </div>

            <div class="mt-6 flex justify-end">
                <button wire:click="saveStudent" class="bg-blue-600 text-white px-6 py-2 rounded font-semibold">
                    Continuar
                </button>
            </div>
        </div>
    @endif


    {{-- ================= PASO 2 ================= --}}
    @if ($step === 2)
        <div class="max-w-4xl mx-auto bg-white rounded-xl shadow p-6 space-y-6">

            <h2 class="text-lg font-bold">Paso 2: Apoderados</h2>

            {{-- Mensaje --}}
            @if ($guardianMessage)
                <div
                    class="mb-4 rounded-lg p-3 text-sm
        {{ $guardianMessageType === 'error' ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700' }}">
                    {{ $guardianMessage }}
                </div>
            @endif

            {{-- APODERADO TITULAR --}}
            <div>
                <label class="font-semibold">Apoderado titular</label>

                @if ($guardianTitular)
                    <div class="mt-2 p-3 border rounded flex justify-between items-center">
                        <div>
                            <strong>{{ $guardianTitular->full_name }}</strong><br>
                            <small>{{ $guardianTitular->rut }}</small>
                        </div>
                        <button wire:click="openGuardianTitular" class="text-blue-600 font-semibold">
                            Cambiar
                        </button>
                    </div>
                @else
                    <button wire:click="openGuardianTitular" class="px-4 py-2 bg-blue-100 border rounded-lg">
                        Buscar / Registrar apoderado
                    </button>
                @endif
            </div>

            {{-- APODERADO SUPLENTE --}}
            <div>
                <label class="font-semibold">Apoderado suplente (opcional)</label>

                @if ($guardianSuplente)
                    <div class="mt-2 p-3 border rounded flex justify-between items-center">
                        <div>
                            <strong>{{ $guardianSuplente->full_name }}</strong><br>
                            <small>{{ $guardianSuplente->rut }}</small>
                        </div>
                        <button wire:click="openGuardianSuplente" class="text-blue-600 font-semibold">
                            Cambiar
                        </button>
                    </div>
                @else
                    <button wire:click="openGuardianSuplente" class="px-4 py-2 bg-blue-100 border rounded-lg">
                        Buscar / Registrar apoderado
                    </button>
                @endif
            </div>

            {{-- BOTONES --}}
            <div class="flex justify-between pt-4">

                <button wire:click="saveGuardians" class="px-6 py-2 bg-blue-600 text-white rounded font-semibold">
                    Continuar
                </button>
            </div>

        </div>
    @endif

    {{-- ================= PASO 3 ================= --}}
    @if ($step === 3)
        <div class="bg-white p-6 rounded-xl shadow-sm border">
            <h2 class="text-2xl font-bold mb-6">Datos académicos</h2>

            <label class="font-semibold">Curso {{ now()->year + 1 }}</label>
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

        <div class="bg-white p-6 rounded-xl shadow-sm border">
            <h2 class="text-2xl font-bold mb-4">Datos familiares</h2>

            <label class="font-semibold">¿Con quién vive el estudiante?</label>
            <input type="text" wire:model="lives_with" class="w-full mt-1 px-3 py-2 border rounded-lg"
                placeholder="Ej: ambos padres, abuelos, madre...">

            <label class="font-semibold mt-4 block">Parentesco del apoderado titular</label>

            <select wire:model.live="guardian_relationship" class="w-full mt-1 px-3 py-2 border rounded-lg">
                <option value="">Seleccione…</option>
                <option value="Madre">Madre</option>
                <option value="Padre">Padre</option>
                <option value="Otro">Otro</option>
            </select>

            @if ($guardian_relationship === 'Otro')
                <input type="text" wire:model.live="guardian_relationship_other"
                    class="w-full mt-2 px-3 py-2 border rounded-lg" placeholder="Ej: abuelo, tía, tutor legal">
            @endif
        </div>
        <div class="bg-white rounded-lg shadow p-6 mt-6">
            <h3 class="font-semibold text-lg mb-4">Autorizaciones y declaraciones</h3>

            <div class="space-y-3 text-sm">
                <label class="flex gap-2">
                    <input type="checkbox" wire:model="consent_extra_activities">
                    Autorizo participación en actividades extra-programáticas.
                </label>

                <label class="flex gap-2">
                    <input type="checkbox" wire:model="consent_photos">
                    Autorizo uso de fotografías y material audiovisual.
                </label>

                <label class="flex gap-2">
                    <input type="checkbox" wire:model="consent_school_bus">
                    Autorizo traslado en buses de acercamiento escolar.
                </label>

                <label class="flex gap-2">
                    <input type="checkbox" wire:model="consent_internet">
                    Autorizo uso de recursos digitales e internet.
                </label>
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-6 mt-6">
            <h3 class="text-lg font-semibold mb-4">Reglamento y Convivencia Escolar</h3>

            <div class="space-y-3 text-sm">
                <label class="flex gap-2">
                    <input type="checkbox" wire:model="accept_school_rules">
                    Declaro haber leído y aceptado el Reglamento de Evaluación del establecimiento.
                </label>

                <label class="flex gap-2">
                    <input type="checkbox" wire:model="accept_coexistence_rules">
                    Declaro haber leído el Manual de Convivencia Escolar 2026.
                </label>

                <label class="flex gap-2">
                    <input type="checkbox" wire:model="accept_terms_conditions">
                        Acepto los
                    <strong>términos y condiciones</strong>
                    del proceso de matrícula.
                </label>
            </div>

            @error('accept_school_rules')
                <p class="text-red-600">{{ $message }}</p>
            @enderror
            @error('accept_coexistence_rules')
                <p class="text-red-600">{{ $message }}</p>
            @enderror
            @error('accept_terms_conditions')
                <p class="text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end mt-6">
            <button wire:click="confirmEnrollment" class="px-6 py-3 bg-green-600 text-white rounded-xl shadow">
                Confirmar matrícula
            </button>
        </div>

    @endif

    {{-- Modales reutilizados --}}
    <livewire:guardian-search-modal />
    <livewire:guardian-create-modal />

</div>
