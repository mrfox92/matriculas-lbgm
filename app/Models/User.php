<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'rut',
        'password',
        'active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'active' => 'boolean',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | MUTATOR PARA NORMALIZAR RUT
    |--------------------------------------------------------------------------
    | Se ejecuta SIEMPRE que se guarda/actualiza un usuario.
    | Deja el rut con formato oficial: 11111111-1
    */
    public function setRutAttribute($value)
    {
        // limpiar puntos, guiones y espacios
        $clean = strtoupper(str_replace(['.', '-', ' '], '', $value));

        if (strlen($clean) < 2) {
            $this->attributes['rut'] = $clean;
            return;
        }

        // separar número y dígito verificador
        $dv = substr($clean, -1);
        $num = substr($clean, 0, -1);

        // guardar SIEMPRE como 11111111-1
        $this->attributes['rut'] = $num . '-' . $dv;
    }

    // Relaciones (las que ya tenías)
    public function enrollmentsProcessed()
    {
        return $this->hasMany(Enrollment::class, 'user_id');
    }

    public function auditLogs()
    {
        return $this->hasMany(AuditLog::class);
    }
}
