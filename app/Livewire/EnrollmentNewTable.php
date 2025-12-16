<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Enrollment;
use App\Models\Course;

class EnrollmentNewTable extends Component
{
    use WithPagination;

    public $schoolYear;
    public $courseId = '';
    public $search = '';

    protected $queryString = ['schoolYear', 'courseId', 'search'];

    public function mount()
    {
        $this->schoolYear = $this->schoolYear ?? now()->year + 1;
    }

    public function updating($field)
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Enrollment::with(['student', 'course.gradeLevel', 'guardianTitular'])
            ->where('school_year', $this->schoolYear)
            ->where('enrollment_type', 'New Student');

        if ($this->courseId) {
            $query->where('course_id', $this->courseId);
        }

        if ($this->search) {
            $query->whereHas('student', function ($q) {
                $q->where('rut', 'like', "%{$this->search}%")
                  ->orWhere('first_name', 'like', "%{$this->search}%")
                  ->orWhere('last_name_father', 'like', "%{$this->search}%");
            });
        }

        return view('livewire.enrollment-new-table', [
            'enrollments' => $query->orderBy('id', 'desc')->paginate(10),
            'courses' => Course::where('school_year', $this->schoolYear)
                ->with('gradeLevel')
                ->get(),
        ]);
    }
}
