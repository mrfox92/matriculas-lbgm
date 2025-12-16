<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Matrículas nuevas {{ now()->year + 1 }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-lg shadow">
                    {{ session('success') }}
                </div>
            @endif

            @livewire('enrollment-new-table')
        </div>
    </div>
</x-app-layout>
