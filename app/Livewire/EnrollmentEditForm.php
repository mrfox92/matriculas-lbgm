<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Enrollment;
use App\Models\Student;
use App\Models\Guardian;
use App\Models\Course;
use App\Models\AuditLog;
use Livewire\Attributes\On;

class EnrollmentEditForm extends Component
{
    public Enrollment $enrollment;

    /* ----------------------------
       CAMPOS DEL ESTUDIANTE
       ---------------------------- */
    public $student_id;
    public $rut;
    public $first_name;
    public $last_name_father;
    public $last_name_mother;
    public $gender;
    public $birth_date;
    public $nationality;

    public $religion;
    public $religion_other;

    public $indigenous_ancestry;
    public $indigenous_ancestry_type;

    public $address;
    public $commune;
    public $phone;
    public $emergency_phone;

    public $has_health_issues;
    public $health_issues_details;

    /* ----------------------------
       DATOS MATRÍCULA
       ---------------------------- */
    public $course_id;
    public $lives_with;
    public $is_pie_student;
    public $needs_lunch;

    /* Autorizaciones */
    public $consent_extra_activities;
    public $consent_photos;
    public $consent_school_bus;
    public $consent_internet;

    /* ----------------------------
   ACEPTACIONES LEGALES
   ---------------------------- */
    public bool $accept_school_rules = false;
    public bool $accept_coexistence_rules = false;
    public bool $accept_terms_conditions = false;

    public ?string $coexistence_manual_version = null;

    /* ----------------------------
       APODERADOS
       ---------------------------- */
    public $guardian_titular_id;
    public $guardian_suplente_id;

    public $guardianTitular;
    public $guardianSuplente;
    /* ----------------------------
       MODAL SELECCIONADO
       ---------------------------- */
    public string $guardianSelecting = ''; // 'titular' | 'suplente'
    /* ----------------------------
       MENSAJES DE ERROR
       ---------------------------- */
    public string $guardianMessage = '';
    public string $guardianMessageType = ''; // success | error
    // Datos familiares
    public ?string $guardian_relationship = null;
    public ?string $guardian_relationship_other = null;
    /* ----------------------------
       LISTADO PUEBLOS ORIGINARIOS
       ---------------------------- */
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
    /* ----------------------------
      LISTADO NACIONALIDADES
      ---------------------------- */
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

    /* ----------------------------
        EVENTO LISTENER
   ---------------------------- */
    #[On('guardian-selected')]
public function handleGuardianSelected(int $guardian_id, string $type): void
{
    $guardianId = (int) $guardian_id;

    if (!in_array($type, ['titular', 'suplente'], true)) {
        return;
    }

    $this->guardianMessage = '';
    $this->guardianMessageType = '';

    $titularId  = $this->guardian_titular_id ? (int) $this->guardian_titular_id : null;
    $suplenteId = $this->guardian_suplente_id ? (int) $this->guardian_suplente_id : null;

    // ✅ Validación: no pueden ser el mismo
    if (
        ($type === 'titular'  && $suplenteId !== null && $guardianId === $suplenteId) ||
        ($type === 'suplente' && $titularId  !== null && $guardianId === $titularId)
    ) {
        $this->guardianMessage = 'El apoderado titular y suplente no pueden ser la misma persona.';
        $this->guardianMessageType = 'error';
        return;
    }

    if ($type === 'titular') {
        $this->guardian_titular_id = $guardianId;
        $this->guardianTitular = Guardian::find($guardianId);
    } else {
        $this->guardian_suplente_id = $guardianId;
        $this->guardianSuplente = Guardian::find($guardianId);
    }

    $this->guardianMessage = 'Apoderado actualizado correctamente.';
    $this->guardianMessageType = 'success';
}

    /* ----------------------------
       REGLAS DE VALIDACION
       ---------------------------- */

    protected function rules()
    {
        return [
            // legales
            'accept_school_rules' => 'accepted',
            'accept_coexistence_rules' => 'accepted',
            'accept_terms_conditions' => 'accepted',
            // parentesco
            'guardian_relationship' => 'nullable|in:Madre,Padre,Otro',
            'guardian_relationship_other' => 'nullable|string|min:2',

        ];
    }

    public function openGuardianModal(string $type): void
    {
        // $this->guardianSelecting = $type;

        // $this->dispatch('open-guardian-modal', [
        //     'type' => $type,
        // ]);
        $this->dispatch('open-guardian-modal', type: $type);
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

    /* ----------------------------
       INICIALIZACIÓN
       ---------------------------- */
    public function mount(Enrollment $enrollment)
    {
        $this->guardianMessage = '';
        $this->guardianMessageType = '';

        $this->enrollment = $enrollment;
        $this->fillFromModels();
    }


    /* ----------------------------
       CARGA DE CAMPOS
       ---------------------------- */
    private function fillFromModels()
    {
        $s = $this->enrollment->student;

        // Estudiante
        $this->student_id = $s->id;
        $this->rut = $s->rut;
        $this->first_name = $s->first_name;
        $this->last_name_father = $s->last_name_father;
        $this->last_name_mother = $s->last_name_mother;
        $this->gender = $s->gender;
        $this->birth_date = optional($s->birth_date)->format('Y-m-d');
        $this->nationality = $s->nationality;

        $this->religion = $s->religion;
        $this->religion_other = $s->religion_other;

        $this->indigenous_ancestry = (int) $s->indigenous_ancestry;
        $this->indigenous_ancestry_type = $s->indigenous_ancestry_type;

        $this->address = $s->address;
        $this->commune = $s->commune;
        $this->phone = $s->phone;
        $this->emergency_phone = $s->emergency_phone;

        $this->has_health_issues = (int) $s->has_health_issues;
        $this->health_issues_details = $s->health_issues_details;

        // Matrícula
        $this->course_id = $this->enrollment->course_id;
        $this->lives_with = $this->enrollment->lives_with;

        $this->guardian_relationship = $this->enrollment->guardian_relationship;
        $this->guardian_relationship_other = $this->enrollment->guardian_relationship_other;

        $this->is_pie_student = $this->enrollment->is_pie_student;
        $this->needs_lunch = $this->enrollment->needs_lunch;

        $this->consent_extra_activities = $this->enrollment->consent_extra_activities;
        $this->consent_photos = $this->enrollment->consent_photos;
        $this->consent_school_bus = $this->enrollment->consent_school_bus;
        $this->consent_internet = $this->enrollment->consent_internet;

        // Apoderados
        $this->guardian_titular_id = $this->enrollment->guardian_titular_id;
        $this->guardian_suplente_id = $this->enrollment->guardian_suplente_id;

        $this->guardianTitular = $this->enrollment->guardianTitular;
        $this->guardianSuplente = $this->enrollment->guardianSuplente;
        // Reglamentos y convivencia
        $this->accept_school_rules = (bool) $this->enrollment->accept_school_rules;
        $this->accept_coexistence_rules = (bool) $this->enrollment->accept_coexistence_rules;
        $this->accept_terms_conditions = (bool) $this->enrollment->accept_terms_conditions;

        $this->coexistence_manual_version = $this->enrollment->coexistence_manual_version;

    }


    /* ----------------------------
       GUARDAR MATRÍCULA
       ---------------------------- */
    public function save()
    {
        // Agregadas reglas de validaciones
        $this->validate();
        $old = $this->enrollment->toArray();

        // Actualizar estudiante
        $student = Student::find($this->student_id);
        $student->update([
            'rut' => $this->rut,
            'first_name' => $this->first_name,
            'last_name_father' => $this->last_name_father,
            'last_name_mother' => $this->last_name_mother,
            'gender' => $this->gender,
            'birth_date' => $this->birth_date ?: null,
            'nationality' => $this->nationality,
            'religion' => $this->religion,
            'religion_other' => $this->religion_other,
            'indigenous_ancestry' => (bool) $this->indigenous_ancestry,
            'indigenous_ancestry_type' => $this->indigenous_ancestry
                ? $this->indigenous_ancestry_type
                : null,
            'address' => $this->address,
            'commune' => $this->commune,
            'phone' => $this->phone,
            'emergency_phone' => $this->emergency_phone,
            'has_health_issues' => (bool) $this->has_health_issues,
            'health_issues_details' => $this->has_health_issues
                ? $this->health_issues_details
                : null,
        ]);

        // Actualizar matrícula
        $this->enrollment->update([
            'course_id' => $this->course_id,
            'guardian_titular_id' => $this->guardian_titular_id,
            'guardian_suplente_id' => $this->guardian_suplente_id,
            'lives_with' => $this->lives_with,
            'is_pie_student' => $this->is_pie_student,
            'needs_lunch' => $this->needs_lunch,
            'consent_extra_activities' => $this->consent_extra_activities,
            'consent_photos' => $this->consent_photos,
            'consent_school_bus' => $this->consent_school_bus,
            'consent_internet' => $this->consent_internet,
            // legales
            'accept_school_rules' => $this->accept_school_rules,
            'accept_coexistence_rules' => $this->accept_coexistence_rules,
            'accept_terms_conditions' => $this->accept_terms_conditions,
            'coexistence_manual_version' => 'Manual de Convivencia 2026',
            'accepted_at' => now(),
            // parentesco
            'guardian_relationship' => $this->guardian_relationship,
            'guardian_relationship_other' =>
                $this->guardian_relationship === 'Otro'
                ? $this->guardian_relationship_other
                : null,


            'user_id' => Auth::id(),
        ]);

        // Auditoría
        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'updated',
            'auditable_type' => Enrollment::class,
            'auditable_id' => $this->enrollment->id,
            'old_values' => $old,
            'new_values' => $this->enrollment->fresh()->toArray(),
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);

        session()->flash('success', 'La matrícula fue actualizada correctamente.');
    }


    /* ----------------------------
       COMPLETAR MATRÍCULA
       ---------------------------- */
    public function completeEnrollment()
    {
        // Agregadas reglas de validaciones
        $this->validate();
        $old = $this->enrollment->toArray();

        $this->enrollment->update([
            'status' => 'Confirmed',
            'user_id' => Auth::id(),
            'accepted_at' => now(),
        ]);

        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'completed',
            'auditable_type' => Enrollment::class,
            'auditable_id' => $this->enrollment->id,
            'old_values' => $old,
            'new_values' => $this->enrollment->fresh()->toArray(),
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);

        session()->flash('success', 'La matrícula fue marcada como COMPLETADA.');
    }


    /* ----------------------------
       RENDER
       ---------------------------- */
    public function render()
    {
        return view('livewire.enrollment-edit-form', [
            'courses' => Course::where('school_year', $this->enrollment->school_year)->get(),
        ]);
    }
}
