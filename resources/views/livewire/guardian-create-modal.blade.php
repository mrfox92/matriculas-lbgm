<div>
@if($open)
<div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
<div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-2xl overflow-y-auto max-h-[90vh]">

<h2 class="font-bold text-lg mb-4">Registrar nuevo apoderado</h2>

{{-- ================= DATOS PERSONALES ================= --}}
<h3 class="font-semibold text-sm mt-2 mb-2">Datos personales</h3>
<div class="grid grid-cols-2 gap-3">
    <div>
        <label class="text-sm">RUT</label>
        <input wire:model="rut" class="w-full border rounded px-3 py-2">
    </div>

    <div>
        <label class="text-sm">Nombres</label>
        <input wire:model="first_name" class="w-full border rounded px-3 py-2">
    </div>

    <div>
        <label class="text-sm">Apellido paterno</label>
        <input wire:model="last_name_father" class="w-full border rounded px-3 py-2">
    </div>

    <div>
        <label class="text-sm">Apellido materno</label>
        <input wire:model="last_name_mother" class="w-full border rounded px-3 py-2">
    </div>

    <div>
        <label class="text-sm">Sexo</label>
        <select wire:model="gender" class="w-full border rounded px-3 py-2">
            <option value="">—</option>
            <option value="Femenino">Femenino</option>
            <option value="Masculino">Masculino</option>
            <option value="Otro">Otro</option>
        </select>
    </div>

    <div>
        <label class="text-sm">Fecha nacimiento</label>
        <input type="date" wire:model="birth_date" class="w-full border rounded px-3 py-2">
    </div>
</div>

{{-- ================= CONTACTO ================= --}}
<h3 class="font-semibold text-sm mt-4 mb-2">Contacto</h3>
<div class="grid grid-cols-2 gap-3">
    <div class="col-span-2">
        <label class="text-sm">Dirección</label>
        <input wire:model="address" class="w-full border rounded px-3 py-2">
    </div>

    <div>
        <label class="text-sm">Comuna</label>
        <input wire:model="commune" class="w-full border rounded px-3 py-2">
    </div>

    <div>
        <label class="text-sm">Teléfono</label>
        <input wire:model="phone" class="w-full border rounded px-3 py-2">
    </div>

    <div>
        <label class="text-sm">Teléfono emergencia</label>
        <input wire:model="emergency_phone" class="w-full border rounded px-3 py-2">
    </div>
</div>

{{-- ================= ANTECEDENTES ================= --}}
<h3 class="font-semibold text-sm mt-4 mb-2">Antecedentes</h3>
<div class="grid grid-cols-2 gap-3">
    <div>
        <label class="text-sm">Nivel educacional</label>
        <select wire:model="education_level" class="w-full border rounded px-3 py-2">
            <option value="">—</option>
            <option>Básica completa</option>
            <option>Básica incompleta</option>
            <option>Media completa</option>
            <option>Media incompleta</option>
            <option>Técnico nivel medio</option>
            <option>Técnico nivel superior</option>
            <option>Profesional</option>
            <option>Otro</option>
        </select>
    </div>

    <div>
        <label class="text-sm">Situación laboral</label>
        <input wire:model="employment_status" class="w-full border rounded px-3 py-2"
               placeholder="Empleado, dueña de casa, independiente">
    </div>

    <div>
        <label class="text-sm">¿Dónde trabaja?</label>
        <select wire:model="work_main_place" class="w-full border rounded px-3 py-2">
            <option value="">—</option>
            <option>En el hogar</option>
            <option>Fuera del hogar</option>
            <option>No trabaja</option>
        </select>
    </div>

    <div>
        <label class="text-sm">Lugar de trabajo</label>
        <input wire:model="workplace" class="w-full border rounded px-3 py-2">
    </div>
</div>

{{-- ================= RELACIÓN ================= --}}
<h3 class="font-semibold text-sm mt-4 mb-2">Relación con el estudiante</h3>
<div>
    <label class="text-sm">¿Con quién vive el estudiante?</label>
    <input wire:model="lives_with_student"
           class="w-full border rounded px-3 py-2"
           placeholder="Ej: Madre, ambos padres, abuela">
</div>

{{-- ================= BOTONES ================= --}}
<div class="mt-6 flex justify-between">
    <button wire:click="save"
            class="px-4 py-2 bg-blue-600 text-white rounded">
        Guardar apoderado
    </button>

    <button wire:click="$set('open', false)"
            class="px-4 py-2 text-gray-600">
        Cancelar
    </button>
</div>

</div>
</div>
@endif
</div>
