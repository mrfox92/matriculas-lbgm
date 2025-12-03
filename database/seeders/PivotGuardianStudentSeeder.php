<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\Guardian;

class PivotGuardianStudentSeeder extends Seeder
{
    public function run(): void
    {
        $students = Student::all();
        $guardians = Guardian::all();

        foreach ($students as $i => $student) {

            $guardian = $guardians[$i % $guardians->count()];

            $student->guardians()->syncWithoutDetaching([
                $guardian->id => ['lives_with' => true]
            ]);

            // Segundo apoderado en algunos casos
            if ($i % 3 === 0) {
                $extra = $guardians->random();
                $student->guardians()->syncWithoutDetaching([
                    $extra->id => ['lives_with' => false]
                ]);
            }
        }
    }
}
