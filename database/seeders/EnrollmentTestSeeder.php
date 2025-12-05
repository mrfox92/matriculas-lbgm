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
        $digitador = User::where('email','digitador@lbgm.cl')->first();
        $students  = Student::all();
        $courses   = Course::where('school_year', 2026)->get();

        foreach ($students as $i => $s) {

            $tit = $s->guardians()->first();
            $sup = $s->guardians()->skip(1)->first();

            Enrollment::firstOrCreate([
                'student_id' => $s->id,
                'school_year' => 2026,
            ],[
                'course_id' => $courses[$i % $courses->count()]->id,
                'guardian_titular_id' => $tit?->id,
                'guardian_suplente_id' => $sup?->id,
                'user_id' => $digitador?->id,
                'status' => 'Pending',
                'enrollment_type' => 'Returning Student',
            ]);
        }
    }
}
