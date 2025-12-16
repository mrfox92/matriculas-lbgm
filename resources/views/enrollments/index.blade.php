<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800">
            Matrículas 2026
        </h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">

            {{-- TARJETA ALUMNO NUEVO --}}
            <a href="{{ route('enrollments.create') }}"
               class="block bg-blue-50 border border-blue-200 rounded-2xl shadow-lg p-10
                      transform transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl">

                <div class="flex flex-col items-start h-full">

                    {{-- Icono --}}
                    <div class="text-blue-600 mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-14 w-14" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M5 13l4 4L19 7" />
                        </svg>
                    </div>

                    {{-- Texto --}}
                    <h3 class="text-3xl font-bold text-blue-900 mb-3">Alumno Nuevo</h3>

                    <p class="text-lg text-blue-800 leading-relaxed">
                        Registrar a un estudiante que proviene de otro establecimiento.
                    </p>

                    <div class="mt-8 font-semibold text-blue-700 underline">
                        Ingresar →
                    </div>
                </div>
            </a>

            {{-- TARJETA ALUMNO ANTIGUO --}}
            <a href="{{ route('enrollments.returning.index') }}"
               class="block bg-green-50 border border-green-200 rounded-2xl shadow-lg p-10
                      transform transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl">

                <div class="flex flex-col items-start h-full">

                    {{-- Icono --}}
                    <div class="text-green-600 mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-14 w-14" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 4v16m8-8H4" />
                        </svg>
                    </div>

                    {{-- Texto --}}
                    <h3 class="text-3xl font-bold text-green-900 mb-3">Alumno Antiguo</h3>

                    <p class="text-lg text-green-800 leading-relaxed">
                        Matricular a un estudiante que ya pertenece al establecimiento.
                    </p>

                    <div class="mt-8 font-semibold text-green-700 underline">
                        Ver listado →
                    </div>
                </div>
            </a>

        </div>
    </div>

</x-app-layout>
