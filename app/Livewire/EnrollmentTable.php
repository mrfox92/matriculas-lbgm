<?php

namespace App\Livewire;

use App\Models\Course;
use App\Models\Enrollment;
use Livewire\Component;
use Livewire\WithPagination;

class EnrollmentTable extends Component
{
    use WithPagination;

    public $schoolYear;
    public $courseId = '';
    public $status = '';
    public $search = '';
    public $enrollmentType = '';

    protected $queryString = ['schoolYear', 'courseId', 'status', 'search', 'enrollmentType'];

    public function mount()
    {
        $this->schoolYear = $this->schoolYear ?? now()->year + 1;
    }

    public function updating($name, $value)
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Enrollment::with(['student', 'course.gradeLevel', 'guardianTitular'])
            ->year($this->schoolYear);

        if ($this->courseId) {
            $query->course($this->courseId);
        }

        if ($this->status) {
            $query->status($this->status);
        }

        if ($this->enrollmentType) {
            $query->where('enrollment_type', $this->enrollmentType);
        }

        if ($this->search) {
            $query->searchStudent($this->search);
        }

        $enrollments = $query->orderByRaw("enrollment_type = 'New Student' DESC")
            ->orderBy('id', 'desc')
            ->paginate(50);

        return view('livewire.enrollment-table', [
            'enrollments' => $enrollments,
            'courses' => Course::where('school_year', $this->schoolYear)->with('gradeLevel')->get(),
        ]);
    }
}
