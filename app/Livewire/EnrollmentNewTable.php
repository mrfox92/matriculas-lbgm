<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Enrollment;
use App\Models\Course;
use Illuminate\Support\Facades\Gate;
use Livewire\Attributes\On;

class EnrollmentNewTable extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    private const SCHOOL_YEAR = 2026;

    public string $courseId = '';
    public string $status = '';
    public string $search = '';

    /** Opciones fijas del select Curso */
    public array $courseOptions = [];
    //  propiedad temporal para id matricula
    public ?int $cancelId = null;

    protected $queryString = [
        'courseId' => ['except' => ''],
        'status' => ['except' => ''],
        'search' => ['except' => ''],
    ];

    public function mount(): void
    {
        // Cursos fijos (una sola vez)
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

    public function updated($property): void
    {
        $this->resetPage();
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
            ->where('enrollment_type', 'New Student');

        // Curso
        if ($this->courseId !== '') {
            $query->where('course_id', $this->courseId);
        }

        // Estado
        if ($this->status !== '') {
            $query->where('status', $this->status);
        }

        // Buscar alumno / RUT
        $term = trim($this->search);

        if (strlen($term) >= 2) {

            $rutLike = strtolower(preg_replace('/[^0-9kK]/', '', $term));
            $isRutSearch = preg_match('/[0-9kK]/', $rutLike);

            $query->whereHas('student', function ($q) use ($term, $rutLike, $isRutSearch) {
                $q->where(function ($qq) use ($term, $rutLike, $isRutSearch) {

                    // RUT normalizado
                    if ($isRutSearch && $rutLike !== '') {
                        $qq->orWhereRaw(
                            "REPLACE(REPLACE(LOWER(rut), '.', ''), '-', '') LIKE ?",
                            ["%{$rutLike}%"]
                        );
                    }

                    // Nombre / apellidos
                    $qq->orWhere('first_name', 'like', "%{$term}%")
                        ->orWhere('last_name_father', 'like', "%{$term}%")
                        ->orWhere('last_name_mother', 'like', "%{$term}%");
                });
            });
        }

        return view('livewire.enrollment-new-table', [
            'enrollments' => $query
                ->orderBy('id', 'desc')
                ->paginate(50),
        ]);
    }
    //   Metodo intermedio de confirmación cancelar o anular matricula
    public function askCancel(int $id): void
    {
        $this->cancelId = $id;

        $this->dispatch(
            'confirm-cancel',
            title: '¿Anular matrícula?',
            text: 'Esta acción no se puede deshacer'
        );
    }
    #[On('confirm-cancel-yes')]
    public function cancelEnrollment(): void
    {
        if (!$this->cancelId) {
            return;
        }

        if (!auth()->user()->hasRole('admin')) {
            abort(403);
        }

        $enrollment = Enrollment::findOrFail($this->cancelId);

        if ($enrollment->status === 'Cancelled') {
            return;
        }

        if ($enrollment->status !== 'Cancelled') {
            $enrollment->update(attributes: ['status' => 'Cancelled']);
        }

        $this->cancelId = null;

        $this->dispatch(
            'toast',
            type: 'success',
            message: 'Matrícula anulada correctamente'
        );
    }
}
