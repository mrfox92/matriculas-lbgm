<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Enrollment;
use App\Exports\EnrollmentsExport;
use Maatwebsite\Excel\Facades\Excel;
use Livewire\WithPagination;

class PanelEnrollmentsDashboard extends Component
{
    use WithPagination;
    protected string $paginationTheme = 'tailwind';
    private const SCHOOL_YEAR = 2026;

    public int $total = 0;
    public int $newCount = 0;
    public int $returningCount = 0;
    public int $pendingCount = 0;
    public int $confirmedCount = 0;
    public int $cancelledCount = 0;
    //  PROPIEDADES DE FILTRADO DE DATOS
    public ?int $courseId = null;
    public ?string $level = null;        // pre, basica, media, adulta
    public ?string $enrollmentType = null; // New Student | Returning Student
    public ?string $status = null;         // Pending | Confirmed | Cancelled

    public function mount(): void
    {
        $this->loadStats();
        // Primera carga de gráficos
        $this->dispatch('charts-updated', $this->getChartData());
    }

    private function filters(): array
    {
        return [
            'courseId' => $this->courseId,
            'level' => $this->level,
            'enrollmentType' => $this->enrollmentType,
            'status' => $this->status,
        ];
    }

    private function loadStats(): void
    {
        $base = $this->baseQuery();

        $this->total = (clone $base)->count();

        $this->newCount = (clone $base)
            ->where('enrollment_type', 'New Student')
            ->count();

        $this->returningCount = (clone $base)
            ->where('enrollment_type', 'Returning Student')
            ->count();

        $this->pendingCount = (clone $base)
            ->where('status', 'Pending')
            ->count();

        $this->confirmedCount = (clone $base)
            ->where('status', 'Confirmed')
            ->count();

        $this->cancelledCount = (clone $base)
            ->where('status', 'Cancelled')
            ->count();
    }

    //   Fuente de datos para filtros
    //  cursos solo 2026 por ahora
    public function getCoursesProperty()
    {
        return \App\Models\Course::with('gradeLevel')
            ->where('school_year', self::SCHOOL_YEAR)
            ->orderBy('grade_level_id')
            ->orderBy('letter')
            ->get();
    }

    //  Niveles (definicion logica)

    public function getLevelsProperty(): array
    {
        return [
            'pre' => 'Pre-básica',
            'basica' => 'Básica',
            'media' => 'Media',
            // 'adulta' => 'Adulta',
        ];
    }

    //   Mapeo Nivel
    private function gradeLevelIdsByLevel(string $level): array
    {
        return match ($level) {
            'pre' => \App\Models\GradeLevel::whereIn('name', [
                'Pre-Kinder',
                'Kinder',
            ])->pluck('id')->toArray(),

            'basica' => \App\Models\GradeLevel::whereIn('name', [
                '1° Básico',
                '2° Básico',
                '3° Básico',
                '4° Básico',
                '5° Básico',
                '6° Básico',
                '7° Básico',
                '8° Básico',
            ])->pluck('id')->toArray(),

            'media' => \App\Models\GradeLevel::whereIn('name', [
                '1° Medio',
                '2° Medio',
                '3° Medio',
                '4° Medio',
            ])->pluck('id')->toArray(),

            'adulta' => [],

            default => [],
        };
    }

    //   Query Central con filtros aplicados
    private function baseQuery()
    {
        $query = Enrollment::query()
            ->with(['student', 'course.gradeLevel'])
            ->where('school_year', self::SCHOOL_YEAR);

        if ($this->courseId) {
            $query->where('course_id', $this->courseId);
        }

        if ($this->level) {
            $gradeIds = $this->gradeLevelIdsByLevel($this->level);

            if (!empty($gradeIds)) {
                $query->whereHas(
                    'course',
                    fn($q) =>
                    $q->whereIn('grade_level_id', $gradeIds)
                );
            }
        }

        if ($this->enrollmentType) {
            $query->where('enrollment_type', $this->enrollmentType);
        }

        if ($this->status) {
            $query->where('status', $this->status);
        }

        return $query;
    }

    public function updated(string $name, mixed $value): void
    {
        // Volver SIEMPRE a la página 1
        $this->resetPage();

        $this->loadStats();

        $this->dispatch(
            'charts-updated',
            $this->getChartData()
        );
    }

    public function updatedPage(): void
    {
        $this->dispatch(
            'charts-updated',
            $this->getChartData()
        );
    }

    public function getChartData(): array
    {
        // OJO: usa la query central (incluye level, etc.)
        $base = $this->baseQuery();

        // 1) Por curso
        $byCourse = (clone $base)
            ->selectRaw('course_id, COUNT(*) as total')
            ->groupBy('course_id')
            ->with('course')
            ->get()
            ->map(fn($r) => [
                'label' => $r->course?->full_name ?? 'Sin curso',
                'value' => (int) $r->total,
            ])
            ->values()
            ->toArray();

        // 2) Nuevos vs Antiguos
        $byType = [
            'new' => (clone $base)->where('enrollment_type', 'New Student')->count(),
            'returning' => (clone $base)->where('enrollment_type', 'Returning Student')->count(),
        ];

        // 3) Estado
        $byStatus = [
            'Pending' => (clone $base)->where('status', 'Pending')->count(),
            'Confirmed' => (clone $base)->where('status', 'Confirmed')->count(),
            'Cancelled' => (clone $base)->where('status', 'Cancelled')->count(),
        ];

        return [
            'byCourse' => $byCourse,
            'byType' => $byType,
            'byStatus' => $byStatus,
        ];
    }

    public function getRowsProperty()
    {
        return $this->baseQuery()
            ->orderBy('id', 'desc')
            ->paginate(25);
    }

    public function exportExcel()
    {
        return Excel::download(
            new EnrollmentsExport([
                'courseId' => $this->courseId,
                'level' => $this->level,
                'status' => $this->status,
                'enrollmentType' => $this->enrollmentType,
            ]),
            'matriculas_2026.xlsx'
        );
    }

    public function render()
    {
        return view('livewire.panel-enrollments-dashboard');
    }
}
