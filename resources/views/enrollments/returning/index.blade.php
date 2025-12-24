<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Matrículas alumnos antiguos {{ now()->year + 1 }}
        </h2>
    </x-slot>
    <div class="py-6 pb-40">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <p class="mb-4 text-sm text-gray-600">
                Listado de estudiantes que ya pertenecían al establecimiento y
                aún no han completado su matrícula para el año {{ now()->year + 1 }}.
            </p>

            @livewire('enrollment-returning-table')
        </div>
    </div>
</x-app-layout>
