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

            // Titular
            $titular = $guardians[$i % $guardians->count()];

            $student->guardians()->syncWithoutDetaching([
                $titular->id => ['lives_with' => true]
            ]);

            // Suplente
            $suplente = $guardians[($i + 1) % $guardians->count()];

            $student->guardians()->syncWithoutDetaching([
                $suplente->id => ['lives_with' => false]
            ]);
        }
    }
}
