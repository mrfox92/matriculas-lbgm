<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guardian extends Model
{
    protected $fillable = [
        'rut', 'last_name_father', 'last_name_mother', 'first_name',
        'gender', 'birth_date',
        'address', 'city', 'phone_mobile', 'phone_emergency',
        'education_level', 'employment_status',
        'work_main_place', 'workplace', 'work_phone',
        'authorized_to_pickup'
    ];

    protected $casts = [
        'birth_date' => 'date',
        'authorized_to_pickup' => 'boolean',
    ];

    /* -------------------- RELACIONES -------------------- */

    public function students()
    {
        return $this->belongsToMany(Student::class, 'guardian_student')
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
