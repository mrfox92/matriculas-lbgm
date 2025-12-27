<div class="space-y-6">

    {{-- KPIs --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-6 gap-4">
        <div class="bg-white rounded-lg shadow p-4">
            <div class="text-sm text-gray-500">Total matrículas</div>
            <div class="text-2xl font-bold">{{ $total }}</div>
        </div>

        <div class="bg-white rounded-lg shadow p-4">
            <div class="text-sm text-gray-500">Alumnos nuevos</div>
            <div class="text-2xl font-bold">{{ $newCount }}</div>
        </div>

        <div class="bg-white rounded-lg shadow p-4">
            <div class="text-sm text-gray-500">Alumnos antiguos</div>
            <div class="text-2xl font-bold">{{ $returningCount }}</div>
        </div>

        <div class="bg-white rounded-lg shadow p-4">
            <div class="text-sm text-gray-500">Pendientes</div>
            <div class="text-2xl font-bold">{{ $pendingCount }}</div>
        </div>

        <div class="bg-white rounded-lg shadow p-4">
            <div class="text-sm text-gray-500">Confirmadas</div>
            <div class="text-2xl font-bold">{{ $confirmedCount }}</div>
        </div>
        
        <div class="bg-white rounded-lg shadow p-4">
            <div class="text-sm text-gray-500">Anuladas</div>
            <div class="text-2xl font-bold text-red-600">
                {{ $cancelledCount }}
            </div>
        </div>

    </div>

    {{-- Zona de acciones (Punto 2 y 3) --}}
    <div class="bg-white rounded-lg shadow p-5">
        <h3 class="font-semibold text-lg mb-2">Informes y gráficos</h3>
        <p class="text-sm text-gray-600">
            Aquí agregaremos filtros por curso y por nivel (pre básica, básica, media, adulta),
            gráficos y exportes PDF/Excel.
        </p>
    </div>

</div>
