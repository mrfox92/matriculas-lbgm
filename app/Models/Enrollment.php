<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    protected $fillable = [
        'student_id', 'course_id', 'school_year',
        'guardian_titular_id', 'guardian_suplente_id',
        'user_id', 'enrollment_date', 'enrollment_type',
        'status', 'previous_grade_level_id', 'is_repeating',
        'has_health_issues', 'health_issues_details',
        'is_pie_student', 'needs_lunch',
        'lives_with',
        'consent_extra_activities',
        'consent_field_trips', 'consent_photos',
        'consent_school_bus', 'consent_internet',
        'internal_enrollment_number', 'notes'
    ];

    protected $casts = [
        'enrollment_date' => 'date',
        'is_repeating' => 'boolean',
        'has_health_issues' => 'boolean',
        'is_pie_student' => 'boolean',
        'needs_lunch' => 'boolean',
        'consent_extra_activities' => 'boolean',
        'consent_field_trips' => 'boolean',
        'consent_photos' => 'boolean',
        'consent_school_bus' => 'boolean',
        'consent_internet' => 'boolean',
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
}
