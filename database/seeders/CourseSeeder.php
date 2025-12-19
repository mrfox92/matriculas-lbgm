<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\GradeLevel;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        foreach ([2025, 2026] as $year) {

            // Cursos sin letra
            $single = [
                'Pre-Kinder',
                'Kinder',
                '1° Básico',
                '2° Básico',
                '3° Básico',
                '4° Básico',
                '5° Básico',
                '6° Básico',
            ];

            foreach ($single as $name) {
                $lvl = GradeLevel::where('name', $name)->first();

                Course::firstOrCreate([
                    'grade_level_id' => $lvl->id,
                    'letter' => null,
                    'specialty' => null,
                    'school_year' => $year,
                ]);
            }

            // Cursos A/B
            $double = [
                '7° Básico',
                '8° Básico',
                '1° Medio',
                '2° Medio',
            ];

            foreach ($double as $name) {
                $lvl = GradeLevel::where('name', $name)->first();

                foreach (['A', 'B'] as $letter) {
                    Course::firstOrCreate([
                        'grade_level_id' => $lvl->id,
                        'letter' => $letter,
                        'specialty' => null,
                        'school_year' => $year,
                    ]);
                }
            }

            // Cursos con especialidad
            $special = ['3° Medio', '4° Medio'];
            $specialties = [
                'HC',
                'TP Atención de Párvulos',
                'TP Programación',
            ];

            foreach ($special as $name) {
                $lvl = GradeLevel::where('name', $name)->first();

                foreach ($specialties as $spec) {
                    Course::firstOrCreate([
                        'grade_level_id' => $lvl->id,
                        'letter' => null,
                        'specialty' => $spec,
                        'school_year' => $year,
                    ]);
                }
            }
        }
    }
}
