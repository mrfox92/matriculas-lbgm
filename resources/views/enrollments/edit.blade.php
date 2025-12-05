{{-- resources/views/enrollments/edit.blade.php --}}

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Editar Matrícula — {{ $enrollment->student->full_name }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            {{-- Componente Livewire --}}
            <livewire:enrollment-edit-form :enrollment="$enrollment" />

        </div>
    </div>
</x-app-layout>
