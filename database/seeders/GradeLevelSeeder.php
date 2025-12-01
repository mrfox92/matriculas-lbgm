<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GradeLevel;

// SEEDER: carga todos los niveles desde Pre-Kinder a 4° Medio.
// Se usa luego para crear los cursos concretos de cada año.

class GradeLevelSeeder extends Seeder
{
    public function run(): void
    {
        $levels = [
            ['name' => 'Pre-Kinder', 'order' => 1],
            ['name' => 'Kinder',     'order' => 2],
            ['name' => '1° Básico',  'order' => 3],
            ['name' => '2° Básico',  'order' => 4],
            ['name' => '3° Básico',  'order' => 5],
            ['name' => '4° Básico',  'order' => 6],
            ['name' => '5° Básico',  'order' => 7],
            ['name' => '6° Básico',  'order' => 8],
            ['name' => '7° Básico',  'order' => 9],
            ['name' => '8° Básico',  'order' => 10],
            ['name' => '1° Medio',   'order' => 11],
            ['name' => '2° Medio',   'order' => 12],
            ['name' => '3° Medio',   'order' => 13],
            ['name' => '4° Medio',   'order' => 14],
        ];

        foreach ($levels as $level) {
            GradeLevel::firstOrCreate(
                ['order' => $level['order']],
                ['name' => $level['name']]
            );
        }
    }
}
