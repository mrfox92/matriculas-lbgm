<?php

namespace App\Livewire;

use App\Models\Course;
use App\Models\Enrollment;
use Livewire\Component;
use Livewire\WithPagination;

class EnrollmentTable extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    private const SCHOOL_YEAR = 2026;

    public string $courseId = '';
    public string $enrollmentType = '';
    public string $status = '';
    public string $search = '';

    protected $queryString = [
        'courseId'        => ['except' => ''],
        'enrollmentType'  => ['except' => ''],
        'status'          => ['except' => ''],
        'search'          => ['except' => ''],
    ];

    public function updated($property): void
    {
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
            ->where('school_year', self::SCHOOL_YEAR);

        // Curso
        if ($this->courseId !== '') {
            $query->where('course_id', $this->courseId);
        }

        // Tipo alumno
        if ($this->enrollmentType !== '') {
            $query->where('enrollment_type', $this->enrollmentType);
        }

        // Estado
        if ($this->status !== '') {
            $query->where('status', $this->status);
        }

        // Buscar nombre / RUT (normalizado)
        $term = trim($this->search);

        if (strlen($term) >= 2) {

            $rutLike = strtolower(preg_replace('/[^0-9kK]/', '', $term));

            $query->whereHas('student', function ($q) use ($term, $rutLike) {
                $q->where(function ($qq) use ($term, $rutLike) {

                    if ($rutLike !== '') {
                        $qq->orWhereRaw(
                            "REPLACE(REPLACE(LOWER(rut), '.', ''), '-', '') LIKE ?",
                            ["%{$rutLike}%"]
                        );
                    }

                    $qq->orWhere('first_name', 'like', "%{$term}%")
                       ->orWhere('last_name_father', 'like', "%{$term}%")
                       ->orWhere('last_name_mother', 'like', "%{$term}%");
                });
            });
        }

        return view('livewire.enrollment-table', [
            'enrollments' => $query
                ->orderByRaw("enrollment_type = 'New Student' DESC")
                ->orderBy('id', 'desc')
                ->paginate(50),

            'courses' => Course::query()
                ->where('school_year', self::SCHOOL_YEAR)
                ->with('gradeLevel:id,name')
                ->orderBy('grade_level_id')
                ->orderBy('letter')
                ->orderBy('specialty')
                ->get(),
        ]);
    }
}
