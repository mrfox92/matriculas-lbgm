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

            $tit = $guardians[$i % $guardians->count()];
            $sup = $guardians[($i + 1) % $guardians->count()];

            $student->guardians()->syncWithoutDetaching([
                $tit->id => ['lives_with' => true],
                $sup->id => ['lives_with' => false],
            ]);
        }
    }
}
