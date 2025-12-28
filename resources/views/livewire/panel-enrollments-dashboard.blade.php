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

    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">

        {{-- Curso --}}
        <select wire:model.live="courseId" class="border rounded px-3 py-2">
            <option value="">Todos los cursos</option>
            @foreach ($this->courses as $course)
                <option value="{{ $course->id }}">
                    {{ $course->full_name }}
                </option>
            @endforeach
        </select>

        {{-- Nivel --}}
        <select wire:model.live="level" class="border rounded px-3 py-2">
            <option value="">Todos los niveles</option>
            @foreach ($this->levels as $key => $label)
                <option value="{{ $key }}">{{ $label }}</option>
            @endforeach
        </select>

        {{-- Tipo --}}
        <select wire:model.live="enrollmentType" class="border rounded px-3 py-2">
            <option value="">Todos</option>
            <option value="New Student">Alumnos nuevos</option>
            <option value="Returning Student">Alumnos antiguos</option>
        </select>

        {{-- Estado --}}
        <select wire:model.live="status" class="border rounded px-3 py-2">
            <option value="">Todos los estados</option>
            <option value="Pending">Pendiente</option>
            <option value="Confirmed">Confirmada</option>
            <option value="Cancelled">Anulada</option>
        </select>

    </div>

    {{-- Zona de acciones (Punto 2 y 3) --}}

    <div class="grid grid-cols-12 gap-6">

        {{-- Barras: ocupa 8/12 --}}
        <div class="col-span-12 lg:col-span-8 bg-white rounded shadow p-4">
            <h4 class="font-semibold mb-2">Matrículas por curso</h4>

            <div class="relative h-[420px]" wire:ignore>
                <canvas id="chartByCourse"></canvas>
            </div>
        </div>

        {{-- Circular: ocupa 4/12 --}}
        <div class="col-span-12 lg:col-span-4 bg-white rounded shadow p-4">
            <h4 class="font-semibold mb-2">Nuevos vs Antiguos</h4>

            <div class="relative h-[320px] flex items-center justify-center" wire:ignore>
                <canvas id="chartByType"></canvas>
            </div>
        </div>

    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">
        <div class="bg-white rounded shadow p-4" wire:ignore>
            <h4 class="font-semibold mb-2">Estado de matrículas</h4>
            <canvas id="chartByStatus" wire:ignore></canvas>
        </div>
    </div>

    <a
    href="{{ route('panel.export.pdf', [
        'courseId' => $courseId,
        'status' => $status,
        'enrollmentType' => $enrollmentType,
        'level' => $level,
    ]) }}"
    target="_blank"
    class="bg-red-600 text-white px-4 py-2 rounded"
>
    Exportar PDF
</a>


    <div class="bg-white rounded-lg shadow overflow-x-auto">
        <table class="min-w-full text-sm">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="px-3 py-2 text-left">#</th>
                    <th class="px-3 py-2 text-left">Estudiante</th>
                    <th class="px-3 py-2 text-left">RUT</th>
                    <th class="px-3 py-2 text-left">Curso</th>
                    <th class="px-3 py-2 text-left">Apoderado titular</th>
                    <th class="px-3 py-2 text-center">Tipo alumno</th>
                    <th class="px-3 py-2 text-center">Estado matrícula</th>
                </tr>
            </thead>

            <tbody class="divide-y">
                @forelse ($this->rows as $row)
                    <tr class="hover:bg-gray-50">
                        {{-- ID --}}
                        <td class="px-3 py-2">
                            {{ $row->id }}
                        </td>

                        {{-- Estudiante --}}
                        <td class="px-3 py-2 font-medium">
                            {{ $row->student->full_name }}
                        </td>

                        {{-- RUT --}}
                        <td class="px-3 py-2">
                            {{ $row->student->rut }}
                        </td>

                        {{-- Curso --}}
                        <td class="px-3 py-2">
                            {{ $row->course?->full_name ?? '—' }}
                        </td>

                        {{-- Apoderado --}}
                        <td class="px-3 py-2 text-gray-700">
                            {{ $row->guardianTitular ? $row->guardianTitular->full_name : 'No informado' }}
                        </td>

                        {{-- Tipo alumno --}}
                        <td class="px-3 py-2 text-center">
                            <span
                                class="px-2 py-1 rounded text-xs font-semibold
                            {{ $row->enrollment_type === 'New Student' ? 'bg-blue-100 text-blue-700' : 'bg-gray-200 text-gray-700' }}">
                                {{ $row->enrollment_type === 'New Student' ? 'Nuevo' : 'Antiguo' }}
                            </span>
                        </td>

                        {{-- Estado --}}
                        <td class="px-3 py-2 text-center">
                            @php
                                $statusStyles = [
                                    'Confirmed' => 'bg-green-100 text-green-700',
                                    'Pending' => 'bg-yellow-100 text-yellow-700',
                                    'Cancelled' => 'bg-red-100 text-red-700',
                                ];
                            @endphp

                            <span
                                class="px-2 py-1 rounded text-xs font-semibold
                            {{ $statusStyles[$row->status] ?? 'bg-gray-100 text-gray-700' }}">
                                @switch($row->status)
                                    @case('Confirmed')
                                        Confirmada
                                    @break

                                    @case('Pending')
                                        Pendiente
                                    @break

                                    @case('Cancelled')
                                        Anulada
                                    @break

                                    @default
                                        {{ $row->status }}
                                @endswitch
                            </span>
                        </td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-3 py-6 text-center text-gray-500">
                                No hay matrículas para los filtros seleccionados.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Paginación --}}

        <div class="mt-4">
            {{ $this->rows->links() }}
        </div>

    </div>
    <script>
        (function() {
            let chartByCourse = null;
            let chartByType = null;
            let chartByStatus = null;

            function destroy(chart) {
                try {
                    if (chart) chart.destroy();
                } catch (e) {}
            }

            function normalizePayload(payload) {
                // Livewire 3 puede entregarlo como [data] o data
                if (Array.isArray(payload) && payload.length) return payload[0];
                return payload;
            }

            function renderCharts(payload) {
                const data = normalizePayload(payload);

                if (!data || typeof data !== 'object') {
                    console.error('charts-updated: payload inválido', data);
                    return;
                }

                // =========================
                // MATRÍCULAS POR CURSO (BAR)
                // =========================
                if (Array.isArray(data.byCourse)) {
                    const labels = data.byCourse.map(i => i.label ?? 'Sin curso');
                    const values = data.byCourse.map(i => Number(i.value ?? 0));

                    const el = document.getElementById('chartByCourse');
                    if (el) {
                        destroy(chartByCourse);
                        chartByCourse = new Chart(el, {
                            type: 'bar',
                            data: {
                                labels,
                                datasets: [{
                                    label: 'Matrículas',
                                    data: values
                                }]
                            },
                            options: {
                                responsive: true,
                                plugins: {
                                    legend: {
                                        display: false
                                    }
                                }
                            }
                        });
                    }
                } else {
                    console.warn('byCourse no es array', data.byCourse);
                }

                // =========================
                // NUEVOS VS ANTIGUOS (PIE)
                // =========================
                if (data.byType && typeof data.byType === 'object') {
                    const el = document.getElementById('chartByType');
                    if (el) {
                        destroy(chartByType);
                        chartByType = new Chart(el, {
                            type: 'pie',
                            data: {
                                labels: ['Alumnos nuevos', 'Alumnos antiguos'],
                                datasets: [{
                                    data: [
                                        Number(data.byType.new ?? 0),
                                        Number(data.byType.returning ?? 0),
                                    ]
                                }]
                            },
                            options: {
                                responsive: true
                            }
                        });
                    }
                } else {
                    console.warn('byType inválido', data.byType);
                }

                // =========================
                // ESTADO (DOUGHNUT)
                // =========================
                // OJO: en PHP las claves vienen como Pending/Confirmed/Cancelled
                if (data.byStatus && typeof data.byStatus === 'object') {
                    const el = document.getElementById('chartByStatus');
                    if (el) {
                        destroy(chartByStatus);
                        chartByStatus = new Chart(el, {
                            type: 'doughnut',
                            data: {
                                labels: ['Pendientes', 'Confirmadas', 'Anuladas'],
                                datasets: [{
                                    data: [
                                        Number(data.byStatus.Pending ?? 0),
                                        Number(data.byStatus.Confirmed ?? 0),
                                        Number(data.byStatus.Cancelled ?? 0),
                                    ]
                                }]
                            },
                            options: {
                                responsive: true
                            }
                        });
                    }
                } else {
                    console.warn('byStatus inválido', data.byStatus);
                }
            }

            // Registrar listener aunque livewire:init ya haya ocurrido
            function boot() {
                if (!window.Livewire) {
                    console.warn('Livewire no está disponible aún; reintentando...');
                    setTimeout(boot, 150);
                    return;
                }

                Livewire.on('charts-updated', (payload) => {
                    renderCharts(payload);
                });

                // Si por timing no alcanzó a dibujar en el mount(),
                // fuerza un refresh inicial: cambia cualquier filtro o refresca la página,
                // pero mejor: dispara charts-updated desde mount() (ya lo haces).
            }

            document.addEventListener('DOMContentLoaded', boot);
        })();
    </script>
