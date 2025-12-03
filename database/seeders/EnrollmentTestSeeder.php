<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Enrollment;
use App\Models\Student;
use App\Models\Guardian;
use App\Models\Course;
use App\Models\User;

class EnrollmentTestSeeder extends Seeder
{
    public function run(): void
    {
        $digitador = User::where('email', 'digitador@lbgm.cl')->first();

        $courses2025 = Course::where('school_year', 2025)->get();
        $courses2026 = Course::where('school_year', 2026)->get();

        $students = Student::all();

        foreach ($students as $i => $student) {

            $guardianTitular = $student->guardians()->first();
            $guardianSuplente = $student->guardians()->skip(1)->first();

            $course2025 = $courses2025[$i % $courses2025->count()];
            $course2026 = $courses2026[$i % $courses2026->count()];

            // MATRÍCULA 2025 (solo para mitad de alumnos)
            if ($i < 5) {
                Enrollment::firstOrCreate([
                    'student_id' => $student->id,
                    'school_year' => 2025,
                ], [
                    'course_id' => $course2025->id,
                    'guardian_titular_id' => $guardianTitular->id,
                    'guardian_suplente_id' => optional($guardianSuplente)->id,
                    'user_id' => $digitador->id,
                    'status' => 'Confirmed',
                    'enrollment_type' => 'Returning Student',
                ]);
            }

            // MATRÍCULA 2026 (todos)
            Enrollment::firstOrCreate([
                'student_id' => $student->id,
                'school_year' => 2026,
            ], [
                'course_id' => $course2026->id,
                'guardian_titular_id' => $guardianTitular->id,
                'guardian_suplente_id' => optional($guardianSuplente)->id,
                'user_id' => $digitador->id,
                'status' => 'Pending',
                'enrollment_type' => $i < 5 ? 'Returning Student' : 'New Student',
            ]);
        }
    }
}
