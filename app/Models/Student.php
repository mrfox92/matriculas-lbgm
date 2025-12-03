<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'rut', 'last_name_father', 'last_name_mother', 'first_name',
        'gender', 'birth_date', 'nationality',
        'religion', 'religion_other',
        'indigenous_ancestry', 'indigenous_ancestry_type',
        'address', 'city', 'phone_mobile', 'phone_emergency',
        'has_chronic_health_issues', 'chronic_health_details',
        'rne', 'previous_enrollment_number'
    ];

    protected $casts = [
        'birth_date' => 'date',
        'indigenous_ancestry' => 'boolean',
        'has_chronic_health_issues' => 'boolean',
    ];

    /* -------------------- RELACIONES -------------------- */

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function guardians()
    {
        return $this->belongsToMany(Guardian::class, 'guardian_student')
                    ->withPivot('lives_with')
                    ->withTimestamps();
    }

    /* -------------------- ACCESSORS -------------------- */

    public function getFullNameAttribute()
    {
        return "{$this->last_name_father} {$this->last_name_mother} {$this->first_name}";
    }

    /* -------------------- SCOPES -------------------- */

    public function scopeRut($query, $rut)
    {
        return $query->where('rut', $rut);
    }

    public function scopeSearch($query, $value)
    {
        return $query->where('rut', 'like', "%$value%")
            ->orWhere('first_name', 'like', "%$value%")
            ->orWhere('last_name_father', 'like', "%$value%")
            ->orWhere('last_name_mother', 'like', "%$value%");
    }
}
