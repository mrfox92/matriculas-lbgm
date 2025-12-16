<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Enrollment;
use App\Models\Student;
use App\Models\Guardian;
use App\Models\Course;

class EnrollmentCreateForm extends Component
{
    /* ============================
       ESTUDIANTE
       ============================ */
    public $rut;
    public $first_name;
    public $last_name_father;
    public $last_name_mother;
    public $gender;
    public $birth_date;
    public $nationality;

    public $religion;
    public $religion_other;

    public $indigenous_ancestry = 0;
    public $indigenous_ancestry_type;

    public $address;
    public $commune;
    public $phone;
    public $emergency_phone;

    public $has_health_issues = 0;
    public $health_issues_details;

    /* ============================
       MATRÍCULA
       ============================ */
    public $school_year;
    public $course_id;
    public $lives_with;
    public $is_pie_student = false;
    public $needs_lunch = false;

    public $consent_extra_activities = false;
    public $consent_photos = false;
    public $consent_school_bus = false;
    public $consent_internet = false;

    /* ============================
       APODERADOS
       ============================ */
    public $guardian_titular_id;
    public $guardian_suplente_id;

    public $guardianTitular;
    public $guardianSuplente;

    public function mount()
    {
        $this->school_year = now()->year + 1;
    }

    #[\Livewire\Attributes\On('guardian-selected')]
    public function setGuardian($payload)
    {
        if ($payload['type'] === 'titular') {
            $this->guardian_titular_id = $payload['id'];
            $this->guardianTitular = Guardian::find($payload['id']);
        } else {
            $this->guardian_suplente_id = $payload['id'];
            $this->guardianSuplente = Guardian::find($payload['id']);
        }
    }

    public function save()
    {
        $this->validate([
            'rut' => 'required|unique:students,rut',
            'first_name' => 'required',
            'last_name_father' => 'required',
            'birth_date' => 'required|date',
            'guardian_titular_id' => 'required|exists:guardians,id',
        ]);

        // 1️⃣ Crear estudiante
        $student = Student::create([
            'rut' => $this->rut,
            'first_name' => $this->first_name,
            'last_name_father' => $this->last_name_father,
            'last_name_mother' => $this->last_name_mother,
            'gender' => $this->gender,
            'birth_date' => $this->birth_date,
            'nationality' => $this->nationality,
            'religion' => $this->religion,
            'religion_other' => $this->religion_other,
            'indigenous_ancestry' => $this->indigenous_ancestry,
            'indigenous_ancestry_type' => $this->indigenous_ancestry_type,
            'address' => $this->address,
            'commune' => $this->commune,
            'phone' => $this->phone,
            'emergency_phone' => $this->emergency_phone,
            'has_health_issues' => $this->has_health_issues,
            'health_issues_details' => $this->health_issues_details,
        ]);

        // 2️⃣ Crear matrícula
        Enrollment::create([
            'student_id' => $student->id,
            'course_id' => $this->course_id,
            'school_year' => $this->school_year,
            'guardian_titular_id' => $this->guardian_titular_id,
            'guardian_suplente_id' => $this->guardian_suplente_id,
            'lives_with' => $this->lives_with,
            'is_pie_student' => $this->is_pie_student,
            'needs_lunch' => $this->needs_lunch,
            'consent_extra_activities' => $this->consent_extra_activities,
            'consent_photos' => $this->consent_photos,
            'consent_school_bus' => $this->consent_school_bus,
            'consent_internet' => $this->consent_internet,
            'enrollment_type' => 'New Student',
            'status' => 'Confirmed',
            'user_id' => Auth::id(),
        ]);

        session()->flash('success', 'Matrícula creada correctamente.');

        return redirect()
            ->route('enrollments.new.index')
            ->with('success', 'Matrícula creada correctamente. Puede generar el PDF o completar el proceso.');
    }

    public function render()
    {
        return view('livewire.enrollment-create-form', [
            'courses' => Course::where('school_year', $this->school_year)->get(),
        ]);
    }
}
