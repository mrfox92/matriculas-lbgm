<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    protected $fillable = [
        'student_id',
        'course_id',
        'school_year',
        'guardian_titular_id',
        'guardian_suplente_id',
        'user_id',
        'enrollment_date',
        'enrollment_type',
        'status',
        'previous_grade_level_id',
        'is_repeating',
        'has_health_issues',
        'health_issues_details',
        'is_pie_student',
        'needs_lunch',
        'lives_with',
        'consent_extra_activities',
        'consent_field_trips',
        'consent_photos',
        'consent_school_bus',
        'consent_internet',
        'internal_enrollment_number',
        'notes',
        // nuevo: Reglamentos y términos
        'accept_school_rules',
        'accept_coexistence_rules',
        'accept_terms_conditions',
        'coexistence_manual_version',
        'accepted_at',
        //  relacion apoderado con estudiante
        'guardian_relationship',
        'guardian_relationship_other',
    ];

    protected $casts = [
        'enrollment_date' => 'date',
        'accepted_at' => 'datetime',
        'is_repeating' => 'boolean',
        'has_health_issues' => 'boolean',
        'is_pie_student' => 'boolean',
        'needs_lunch' => 'boolean',
        'consent_extra_activities' => 'boolean',
        'consent_field_trips' => 'boolean',
        'consent_photos' => 'boolean',
        'consent_school_bus' => 'boolean',
        'consent_internet' => 'boolean',
        // legales
        'accept_school_rules' => 'boolean',
        'accept_coexistence_rules' => 'boolean',
        'accept_terms_conditions' => 'boolean',
    ];

    /* -------------------- RELACIONES -------------------- */

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class)->with('gradeLevel');
    }

    public function guardianTitular()
    {
        return $this->belongsTo(Guardian::class, 'guardian_titular_id');
    }

    public function guardianSuplente()
    {
        return $this->belongsTo(Guardian::class, 'guardian_suplente_id');
    }

    public function digitador()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /* -------------------- SCOPES -------------------- */

    public function scopeYear($query, $year)
    {
        return $query->where('school_year', $year);
    }

    public function scopeCourse($query, $courseId)
    {
        return $query->where('course_id', $courseId);
    }

    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopeSearchStudent($query, $value)
    {
        return $query->whereHas('student', function ($q) use ($value) {
            $q->search($value);
        });
    }
    public function scopeApplyFilters($query, array $filters)
    {
        if (!empty($filters['courseId'])) {
            $query->where('course_id', $filters['courseId']);
        }

        if (!empty($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        if (!empty($filters['enrollmentType'])) {
            $query->where('enrollment_type', $filters['enrollmentType']);
        }

        // level (si lo estás usando en el panel)
        if (!empty($filters['level'])) {
            $query->whereHas('course.gradeLevel', function ($q) use ($filters) {
                // aquí filtras por tu lógica de niveles (pre básica / básica / media / adulta)
                // depende de cómo definiste $levels en el componente
            });
        }

        return $query;
    }

}
