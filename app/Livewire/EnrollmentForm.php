<?php

namespace App\Livewire;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Guardian;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class EnrollmentForm extends Component
{
    public ?Enrollment $enrollment = null;
    public ?int $enrollmentId = null;

    public $schoolYear;
    public $isNewStudent = false;

    // Estudiante
    public $studentId;
    public $studentRut;
    public $studentFullName;

    // Curso
    public $courseId;

    // Apoderados
    public $guardianTitularId;
    public $guardianTitularName;
    public $guardianTitularRut;

    public $guardianSuplenteId;
    public $guardianSuplenteName;
    public $guardianSuplenteRut;

    // Salud y autorizaciones
    public $lives_with;
    public $has_health_issues = false;
    public $health_issues_details;
    public $is_pie_student = false;
    public $needs_lunch = false;

    public $consent_extra_activities = false;
    public $consent_photos = false;
    public $consent_school_bus = false;
    public $consent_internet = false;

    public function mount(?int $enrollmentId = null)
    {
        $this->schoolYear = now()->year + 1;
        $this->enrollmentId = $enrollmentId;

        if ($enrollmentId) {
            $this->enrollment = Enrollment::with(['student', 'guardianTitular', 'guardianSuplente'])
                ->findOrFail($enrollmentId);

            $this->fillFromEnrollment($this->enrollment);
        }
    }

    protected function fillFromEnrollment(Enrollment $enrollment)
    {
        $student = $enrollment->student;

        // Estudiante
        $this->studentId = $student->id;
        $this->studentRut = $student->rut;
        $this->studentFullName = $student->full_name;

        // Apoderados
        $tit = $enrollment->guardianTitular;
        $this->guardianTitularId = $tit?->id;
        $this->guardianTitularName = $tit?->full_name;
        $this->guardianTitularRut = $tit?->rut;

        $sup = $enrollment->guardianSuplente;
        $this->guardianSuplenteId = $sup?->id;
        $this->guardianSuplenteName = $sup?->full_name;
        $this->guardianSuplenteRut = $sup?->rut;

        // Curso
        $this->courseId = $enrollment->course_id;

        // Campos varios
        $this->lives_with = $enrollment->lives_with;
        $this->has_health_issues = $enrollment->has_health_issues;
        $this->health_issues_details = $enrollment->health_issues_details;
        $this->is_pie_student = $enrollment->is_pie_student;
        $this->needs_lunch = $enrollment->needs_lunch;

        $this->consent_extra_activities = $enrollment->consent_extra_activities;
        $this->consent_photos = $enrollment->consent_photos;
        $this->consent_school_bus = $enrollment->consent_school_bus;
        $this->consent_internet = $enrollment->consent_internet;
    }

    // -------------------------------------
    //  BÚSQUEDA RUT
    // -------------------------------------
    public function updatedStudentRut()
    {
        $student = Student::where('rut', trim($this->studentRut))->first();

        if ($student) {
            $this->studentId = $student->id;
            $this->studentFullName = $student->full_name;
            $this->isNewStudent = false;

            $tit = $student->guardians()->first();
            if ($tit) {
                $this->setGuardianTitular($tit->id);
            }

            $sup = $student->guardians()->skip(1)->first();
            if ($sup) {
                $this->setGuardianSuplente($sup->id);
            }
        } else {
            $this->studentId = null;
            $this->studentFullName = null;
            $this->isNewStudent = true;
        }
    }

    // -------------------------------------
    //  EVENTOS PARA ASIGNAR APODERADOS
    // -------------------------------------
    #[On('guardian-selected')]
    public function guardianSelected($payload)
    {
        if ($payload['type'] === 'titular') {
            $this->setGuardianTitular($payload['id']);
        } else {
            $this->setGuardianSuplente($payload['id']);
        }
    }

    public function setGuardianTitular($id)
    {
        $g = Guardian::findOrFail($id);
        $this->guardianTitularId = $g->id;
        $this->guardianTitularName = $g->full_name;
        $this->guardianTitularRut = $g->rut;
    }

    public function setGuardianSuplente($id)
    {
        $g = Guardian::findOrFail($id);
        $this->guardianSuplenteId = $g->id;
        $this->guardianSuplenteName = $g->full_name;
        $this->guardianSuplenteRut = $g->rut;
    }

    // -------------------------------------
    //  GUARDAR MATRÍCULA
    // -------------------------------------
    public function save()
    {
        $this->validate([
            'studentId' => 'required|exists:students,id',
            'guardianTitularId' => 'required|exists:guardians,id',
        ]);

        $data = [
            'student_id' => $this->studentId,
            'course_id' => $this->courseId,
            'school_year' => $this->schoolYear,

            'guardian_titular_id' => $this->guardianTitularId,
            'guardian_suplente_id' => $this->guardianSuplenteId,

            'user_id' => Auth::id(),

            'lives_with' => $this->lives_with,
            'has_health_issues' => $this->has_health_issues,
            'health_issues_details' => $this->health_issues_details,
            'is_pie_student' => $this->is_pie_student,
            'needs_lunch' => $this->needs_lunch,

            'consent_extra_activities' => $this->consent_extra_activities,
            'consent_photos' => $this->consent_photos,
            'consent_school_bus' => $this->consent_school_bus,
            'consent_internet' => $this->consent_internet,

            'status' => 'Confirmed',
        ];

        if ($this->enrollmentId) {
            $this->enrollment->update($data);
        } else {
            $this->enrollment = Enrollment::create($data);
            $this->enrollmentId = $this->enrollment->id;
        }

        session()->flash('success', 'Matrícula guardada correctamente.');
        $this->redirectRoute('enrollments.edit', $this->enrollmentId);
    }

    public function render()
    {
        return view('livewire.enrollment-form', [
            'courses' => Course::where('school_year', $this->schoolYear)->get(),
        ]);
    }
}
