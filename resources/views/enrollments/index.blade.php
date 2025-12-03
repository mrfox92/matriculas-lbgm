<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">Matrículas {{ now()->year + 1 }}</h2>
    </x-slot>

    <div class="py-6 max-w-7xl mx-auto">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">

            <a href="{{ route('enrollments.create') }}"
                class="p-8 bg-blue-100 hover:bg-blue-200 shadow rounded-lg">
                <h3 class="text-2xl font-bold mb-2">Alumno Nuevo</h3>
                <p>Registrar un estudiante que viene de otro establecimiento.</p>
            </a>

            <a href="{{ route('enrollments.index') }}?modo=antiguo"
                class="p-8 bg-green-100 hover:bg-green-200 shadow rounded-lg">
                <h3 class="text-2xl font-bold mb-2">Alumno Antiguo</h3>
                <p>Matricular estudiante que ya pertenece al establecimiento.</p>
            </a>

        </div>

        @livewire('enrollment-table')

    </div>
</x-app-layout>

