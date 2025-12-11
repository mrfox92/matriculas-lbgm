<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Enrollment;
use App\Models\Student;
use App\Models\Course;
use App\Models\User;

class EnrollmentTestSeeder extends Seeder
{
    public function run(): void
    {
        $digitador = User::where('email', 'digitador@lbgm.cl')->first();
        $students = Student::all();

        $courses2026 = Course::where('school_year', 2026)->get();

        foreach ($students as $i => $student) {

            $guardians = $student->guardians;

            $titular = $guardians[0];
            $suplente = $guardians[1];

            Enrollment::firstOrCreate(
                [
                    'student_id' => $student->id,
                    'school_year' => 2026,
                ],
                [
                    'course_id' => $courses2026[$i % $courses2026->count()]->id,
                    'guardian_titular_id' => $titular->id,
                    'guardian_suplente_id' => $suplente->id,

                    'user_id' => $digitador->id,
                    'status' => $i % 3 === 0 ? 'Confirmed' : 'Pending',
                    'enrollment_type' => $i % 2 === 0 ? 'Returning Student' : 'New Student',
                ]
            );
        }
    }
}
