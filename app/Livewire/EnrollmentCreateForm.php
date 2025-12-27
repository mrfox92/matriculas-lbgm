<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use App\Models\Enrollment;
use App\Models\Guardian;
use App\Models\Course;
use Illuminate\Validation\Rule;

class EnrollmentCreateForm extends Component
{
    public int $step = 1;

    public ?Student $student = null;
    public ?Enrollment $enrollment = null;
    public ?int $enrollment_id = null;

    /* =========================
       CAMPOS ESTUDIANTE
       ========================= */
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

    /* =========================
       MATRÍCULA
       ========================= */
    public $course_id;
    public $lives_with;
    public $guardian_relationship;
    public $guardian_relationship_other;

    public bool $is_pie_student = false;
    public bool $needs_lunch = false;

    public $consent_extra_activities = false;
    public $consent_photos = false;
    public $consent_school_bus = false;
    public $consent_internet = false;

    public bool $accept_school_rules = false;
    public bool $accept_coexistence_rules = false;
    public bool $accept_terms_conditions = false;

    /* =========================
       APODERADOS
       ========================= */
    public ?int $guardian_titular_id = null;
    public ?int $guardian_suplente_id = null;

    public ?Guardian $guardianTitular = null;
    public ?Guardian $guardianSuplente = null;

    public string $guardianSelecting = ''; // titular | suplente

    public string $guardianMessage = '';
    public string $guardianMessageType = '';

    /* =========================
       LISTADOS (COPIA EDIT)
       ========================= */
    public array $indigenousPeoples = [
        'Mapuche',
        'Aymara',
        'Rapa Nui',
        'Quechua',
        'Atacameño (Lickanantay)',
        'Colla',
        'Diaguita',
        'Kawésqar',
        'Yagán',
        'Chango',
    ];

    public array $nationalities = [
        'Chilena',
        'Afghana',
        'Alemana',
        'Argentina',
        'Australiana',
        'Boliviana',
        'Brasileña',
        'Canadiense',
        'China',
        'Colombiana',
        'Coreana',
        'Cubana',
        'Dominicana',
        'Ecuatoriana',
        'Egipcia',
        'Española',
        'Estadounidense',
        'Francesa',
        'Haitiana',
        'India',
        'Italiana',
        'Japonesa',
        'Mexicana',
        'Nigeriana',
        'Paraguaya',
        'Peruana',
        'Portuguesa',
        'Rumana',
        'Rusa',
        'Sudafricana',
        'Suiza',
        'Uruguaya',
        'Venezolana',
        'Otra',
    ];

    public array $religions = [
        'Católica',
        'Evangélica',
        'Otra',
        'Ninguna',
    ];

    protected function rules()
    {
        return [
            // reglamentos
            'accept_school_rules' => 'accepted',
            'accept_coexistence_rules' => 'accepted',
            'accept_terms_conditions' => 'accepted',

            // familiares
            'guardian_relationship' => 'nullable|in:Madre,Padre,Otro',
            'guardian_relationship_other' => 'nullable|string|min:2',

            // académicos
            'course_id' => 'nullable|exists:courses,id',
        ];
    }

    /* =========================
       PASO 1 – CREAR ESTUDIANTE
       ========================= */
    public function saveStudent()
    {
        $this->validate([
            'rut' => [
                'required',
                Rule::unique('students', 'rut'),
            ],
            'first_name' => 'required|string|min:2',
            'last_name_father' => 'required|string|min:2',
        ], [
            'rut.required' => 'El RUT es obligatorio.',
            'rut.unique' => 'Este RUT ya pertenece a un estudiante registrado.',
            'first_name.required' => 'Los nombres son obligatorios.',
            'last_name_father.required' => 'El apellido paterno es obligatorio.',
        ]);

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
            'indigenous_ancestry' => (bool) $this->indigenous_ancestry,
            'indigenous_ancestry_type' => $this->indigenous_ancestry_type,
            'address' => $this->address,
            'commune' => $this->commune,
            'phone' => $this->phone,
            'emergency_phone' => $this->emergency_phone,
            'has_health_issues' => (bool) $this->has_health_issues,
            'health_issues_details' => $this->health_issues_details,
        ]);

        // Crear matrícula base (vacía)
        $this->enrollment = Enrollment::create([
            'student_id' => $student->id,
            'school_year' => now()->year + 1,
            'enrollment_type' => 'New Student',
            'status' => 'Pending',
            'is_pie_student' => (bool) $this->is_pie_student,
            'needs_lunch' => (bool) $this->needs_lunch,
            'user_id' => Auth::id(),
        ]);

        $this->enrollment_id = $this->enrollment->id;
        $this->student = $student;

        // Avanzamos al Paso 2 (Apoderados)
        $this->step = 2;
    }

    /* =========================
       PASO 2 – APODERADOS
       ========================= */
    #[On('guardian-selected')]
    public function handleGuardianSelected(int $guardian_id, string $type = 'titular'): void
    {
        $this->guardianMessage = '';
        $this->guardianMessageType = '';

        // Validación cruzada
        if ($type === 'suplente' && $this->guardian_titular_id === $guardian_id) {
            $this->guardianMessage = 'El apoderado titular y suplente no pueden ser la misma persona.';
            $this->guardianMessageType = 'error';
            return;
        }

        if ($type === 'titular' && $this->guardian_suplente_id === $guardian_id) {
            $this->guardianMessage = 'El apoderado titular y suplente no pueden ser la misma persona.';
            $this->guardianMessageType = 'error';
            return;
        }

        if ($type === 'titular') {
            $this->guardian_titular_id = $guardian_id;
            $this->guardianTitular = Guardian::find($guardian_id);
            $this->guardianMessage = 'Apoderado titular asignado correctamente.';
        }

        if ($type === 'suplente') {
            $this->guardian_suplente_id = $guardian_id;
            $this->guardianSuplente = Guardian::find($guardian_id);
            $this->guardianMessage = 'Apoderado suplente asignado correctamente.';
        }

        $this->guardianMessageType = 'success';
        $this->resetErrorBag();
    }

    public function openGuardianTitular(): void
    {
        $this->guardianMessage = '';
        $this->guardianMessageType = '';
        $this->dispatch('open-guardian-modal', type: 'titular');
    }

    public function openGuardianSuplente(): void
    {
        $this->guardianMessage = '';
        $this->guardianMessageType = '';
        $this->dispatch('open-guardian-modal', type: 'suplente');
    }


    public function saveGuardians(): void
    {
        if (!$this->guardian_titular_id) {
            $this->guardianMessage = 'Debe seleccionar un apoderado titular.';
            $this->guardianMessageType = 'error';
            return;
        }

        $this->enrollment->update([
            'guardian_titular_id' => $this->guardian_titular_id,
            'guardian_suplente_id' => $this->guardian_suplente_id,
        ]);

        $this->step = 3;
    }


    /* =========================
       PASO FINAL – CONFIRMAR
       ========================= */
    public function confirmEnrollment()
    {
        $this->validate();

        $this->enrollment->update([
            'course_id' => $this->course_id,
            'lives_with' => $this->lives_with,
            'guardian_relationship' => $this->guardian_relationship,
            'guardian_relationship_other' =>
                $this->guardian_relationship === 'Otro'
                ? $this->guardian_relationship_other
                : null,

            'consent_extra_activities' => $this->consent_extra_activities,
            'consent_photos' => $this->consent_photos,
            'consent_school_bus' => $this->consent_school_bus,
            'consent_internet' => $this->consent_internet,

            'accept_school_rules' => $this->accept_school_rules,
            'accept_coexistence_rules' => $this->accept_coexistence_rules,
            'accept_terms_conditions' => $this->accept_terms_conditions,

            'status' => 'Confirmed',
            'accepted_at' => now(),
            'user_id' => auth()->id(),
        ]);

        // session()->flash('success', 'Matrícula completada correctamente.');
        return redirect()
            ->route('enrollments.new.index')
            ->with('success', 'Matrícula completada correctamente.');
    }

    public function updatedGuardianRelationship($value)
    {
        if ($value !== 'Otro') {
            $this->guardian_relationship_other = null;
        }
    }

    public function updatedIndigenousAncestry($value)
    {
        if ((int) $value !== 1) {
            $this->indigenous_ancestry_type = null;
        }
    }

    public function updatedHasHealthIssues($value)
    {
        if ((int) $value !== 1) {
            $this->health_issues_details = null;
        }
    }

    public function render()
    {
        return view('livewire.enrollment-create-form', [
            'courses' => Course::where('school_year', now()->year + 1)->get(),
        ]);
    }
}
