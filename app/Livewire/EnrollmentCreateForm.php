<?php

namespace App\Livewire;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Guardian;
use App\Models\Student;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Auth;

class EnrollmentCreateForm extends Component
{
    // Campos del formularo de matrícula
    public $studentRut;
    public $studentFullName;
    public $studentId;

    public $courseId;

    public $guardianTitularId;
    public $guardianSuplenteId;

    public $lives_with;

    public $is_pie_student = false;
    public $needs_lunch = false;

    public $consent_extra_activities = false;
    public $consent_photos = false;
    public $consent_school_bus = false;
    public $consent_internet = false;

    public $schoolYear;

    public function mount()
    {
        $this->schoolYear = now()->year + 1;
    }

    public function updatedStudentRut()
    {
        $student = Student::where('rut', $this->studentRut)->first();

        if ($student) {
            $this->studentId = $student->id;
            $this->studentFullName = $student->full_name;
        } else {
            $this->studentId = null;
            $this->studentFullName = null;
        }
    }

    #[On('guardian-selected')]
    public function guardianSelected($payload)
    {
        if ($payload['type'] === 'titular') {
            $this->guardianTitularId = $payload['id'];
        } else {
            $this->guardianSuplenteId = $payload['id'];
        }
    }

    public function save()
    {
        $this->validate([
            'studentId' => 'required|exists:students,id',
            'guardianTitularId' => 'required|exists:guardians,id',
        ]);

        Enrollment::create([
            'student_id' => $this->studentId,
            'course_id' => $this->courseId,
            'school_year' => $this->schoolYear,

            'guardian_titular_id' => $this->guardianTitularId,
            'guardian_suplente_id' => $this->guardianSuplenteId,

            'user_id' => Auth::id(),

            'lives_with' => $this->lives_with,
            'is_pie_student' => $this->is_pie_student,
            'needs_lunch' => $this->needs_lunch,

            'consent_extra_activities' => $this->consent_extra_activities,
            'consent_photos' => $this->consent_photos,
            'consent_school_bus' => $this->consent_school_bus,
            'consent_internet' => $this->consent_internet,

            'status' => 'Pending',
        ]);

        session()->flash('success', 'Matrícula creada correctamente.');

        return redirect()->route('dashboard');
    }

    public function render()
    {
        return view('livewire.enrollment-create-form', [
            'courses' => Course::where('school_year', $this->schoolYear)->get()
        ]);
    }
}
