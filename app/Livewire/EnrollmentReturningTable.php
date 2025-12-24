<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Enrollment;
use App\Models\Course;

class EnrollmentReturningTable extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    private const SCHOOL_YEAR = 2026;

    public string $courseId = '';
    public string $status = '';
    public string $search = '';

    /** Opciones fijas del select (no cambian con filtros) */
    public array $courseOptions = [];

    protected $queryString = [
        'courseId' => ['except' => ''],
        'status' => ['except' => ''],
        'search' => ['except' => ''],
    ];

    public function mount(): void
    {
        // Cargar 1 sola vez (liviano)
        $this->courseOptions = Course::query()
            ->where('school_year', self::SCHOOL_YEAR)
            ->with('gradeLevel:id,name')
            ->orderBy('grade_level_id')
            ->orderBy('letter')
            ->orderBy('specialty')
            ->get()
            ->map(fn($c) => [
                'id' => (string) $c->id,
                'label' => trim(
                    ($c->gradeLevel?->name ?? '') . ' ' .
                    ($c->letter ?? '') . ' ' .
                    ($c->specialty ?? '')
                ),
            ])
            ->toArray();
    }

    public function updatedSearch(): void
    {
        // mismo criterio que GuardianSearchModal
        if (strlen(trim($this->search)) < 2) {
            $this->resetPage();
            return;
        }

        $this->resetPage();
    }

    public function updated($property): void
    {
        // Cualquier cambio de filtro resetea paginación
        $this->resetPage();
    }

    public function render()
    {
        $query = Enrollment::query()
            ->with([
                'student:id,first_name,last_name_father,last_name_mother,rut',
                'course:id,grade_level_id,letter,specialty',
                'course.gradeLevel:id,name',
                'guardianTitular:id,first_name,last_name_father,last_name_mother',
            ])
            ->where('school_year', self::SCHOOL_YEAR)
            ->where('enrollment_type', 'Returning Student');

        // Curso
        if ($this->courseId !== '') {
            $query->where('course_id', $this->courseId);
        }

        // Estado
        if ($this->status !== '') {
            $query->where('status', $this->status);
        }

        // Buscar alumno / RUT
        // Buscar alumno / RUT (optimizado tipo GuardianSearchModal)
        $term = trim($this->search);

        if (strlen($term) >= 2) {

            $rutLike = strtolower(preg_replace('/[^0-9kK]/', '', $term));
            $isRutSearch = preg_match('/[0-9kK]/', $rutLike);

            $query->whereHas('student', function ($q) use ($term, $rutLike, $isRutSearch) {

                $q->where(function ($qq) use ($term, $rutLike, $isRutSearch) {

                    //  Buscar por RUT normalizado
                    if ($isRutSearch && $rutLike !== '') {
                        $qq->orWhereRaw(
                            "REPLACE(REPLACE(LOWER(rut), '.', ''), '-', '') LIKE ?",
                            ["%{$rutLike}%"]
                        );
                    }

                    // Buscar por nombre / apellidos
                    $qq->orWhere('first_name', 'like', "%{$term}%")
                        ->orWhere('last_name_father', 'like', "%{$term}%")
                        ->orWhere('last_name_mother', 'like', "%{$term}%");
                });
            });
        }


        return view('livewire.enrollment-returning-table', [
            'enrollments' => $query
                ->orderBy('id', 'desc')   // ✅ vuelve el orden esperado
                ->paginate(50),
        ]);
    }
}
