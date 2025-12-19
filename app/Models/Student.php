<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'first_name',
        'last_name_father',
        'last_name_mother',
        'rut',
        'gender',
        'birth_date',
        'nationality',
        'religion',
        'indigenous_ancestry',
        'indigenous_ancestry_type',
        'address',
        'commune',
        'phone',
        'emergency_phone',
        'has_health_issues',
        'health_issues_details',
    ];


    protected $casts = [
        'birth_date' => 'date',
        'indigenous_ancestry' => 'boolean',
        'has_health_issues' => 'boolean',
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

    public function getFullNameAttribute(): string
    {
        return trim("{$this->first_name} {$this->last_name_father} {$this->last_name_mother}");
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
