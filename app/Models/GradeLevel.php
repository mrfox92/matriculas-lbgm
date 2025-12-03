<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GradeLevel extends Model
{
    protected $fillable = ['name', 'order'];

    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
