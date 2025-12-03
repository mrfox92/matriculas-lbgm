<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'grade_level_id', 'letter', 'specialty',
        'school_year', 'max_capacity'
    ];

    public function gradeLevel()
    {
        return $this->belongsTo(GradeLevel::class);
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    /* Scopes útiles */

    public function scopeYear($query, $year)
    {
        return $query->where('school_year', $year);
    }
}
