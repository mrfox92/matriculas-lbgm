<?php

namespace Database\Seeders\Legacy;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Student;
use App\Models\Enrollment;
use App\Models\Course;

class TerceroBasico2025Seeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {

            $course = Course::whereHas('gradeLevel', fn ($q) =>
                $q->where('name', '3° Básico')
            )->where('school_year', 2026)->firstOrFail();

            $students = [

                [
                    'rut' => '25.283.118-5',
                    'first_name' => 'Richard Abraham',
                    'last_name_father' => 'Valenzuela',
                    'last_name_mother' => 'Ormeño',
                    'gender' => 'Masculino',
                    'birth_date' => '2016-02-03',
                    'nationality' => 'Chilena',
                    'religion' => 'Ninguna',
                    'address' => 'Sin información',
                    'commune' => 'Máfil',
                    'phone' => '937483022',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => false,
                ],
                [
                    'rut' => '25.440.119-6',
                    'first_name' => 'Gael Alejandro',
                    'last_name_father' => 'Alarcón',
                    'last_name_mother' => 'Carrillo',
                    'gender' => 'Masculino',
                    'birth_date' => '2016-07-08',
                    'nationality' => 'Chilena',
                    'religion' => 'Evangélica',
                    'address' => 'Molco S/N',
                    'commune' => 'Máfil',
                    'phone' => '948697204',
                    'indigenous' => null,
                    'health' => true,
                    'pie' => false,
                ],
                [
                    'rut' => '25.403.657-9',
                    'first_name' => 'Javier Eduardo',
                    'last_name_father' => 'Cartes',
                    'last_name_mother' => 'Barría',
                    'gender' => 'Masculino',
                    'birth_date' => '2016-06-06',
                    'nationality' => 'Chilena',
                    'religion' => 'Católica',
                    'address' => 'Sector Linguento, Máfil',
                    'commune' => 'Máfil',
                    'phone' => '971951319',
                    'indigenous' => 'Mapuche',
                    'health' => false,
                    'pie' => false,
                ],
                [
                    'rut' => '26.634.000-1',
                    'first_name' => 'Román Alesandro',
                    'last_name_father' => 'Hernández',
                    'last_name_mother' => 'Duarte',
                    'gender' => 'Masculino',
                    'birth_date' => '2016-10-11',
                    'nationality' => 'Venezolana',
                    'religion' => 'Evangélica',
                    'address' => 'Calle John Kennedy Pasaje Monte Grande #145B',
                    'commune' => 'Máfil',
                    'phone' => '928987338',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => false,
                ],
                [
                    'rut' => '25.516.639-5',
                    'first_name' => 'Amanda Bernardita',
                    'last_name_father' => 'Bernardita',
                    'last_name_mother' => null,
                    'gender' => 'Femenino',
                    'birth_date' => '2016-09-23',
                    'nationality' => 'Chilena',
                    'religion' => 'Evangélica',
                    'address' => 'Víctor Soto Briceño 229',
                    'commune' => 'Máfil',
                    'phone' => '949152558',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => false,
                ],
                [
                    'rut' => '25.330.850-8',
                    'first_name' => 'Bruno Alonso',
                    'last_name_father' => 'Díaz',
                    'last_name_mother' => 'Hormazábal',
                    'gender' => 'Masculino',
                    'birth_date' => '2016-03-24',
                    'nationality' => 'Chilena',
                    'religion' => 'Católica',
                    'address' => 'Huillón S/N',
                    'commune' => 'Máfil',
                    'phone' => '968495610',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => true,
                ],
                [
                    'rut' => '25.696.100-8',
                    'first_name' => 'Fernanda Trinidad',
                    'last_name_father' => 'Díaz',
                    'last_name_mother' => 'Lagos',
                    'gender' => 'Femenino',
                    'birth_date' => '2017-02-24',
                    'nationality' => 'Chilena',
                    'religion' => 'Evangélica',
                    'address' => 'Mulpun Kilómetro 16, Sector Comunidad',
                    'commune' => 'Máfil',
                    'phone' => '946177788',
                    'indigenous' => 'Mapuche',
                    'health' => true,
                    'pie' => false,
                ],
                [
                    'rut' => '25.455.644-0',
                    'first_name' => 'Francisco Ignacio',
                    'last_name_father' => 'Contreras',
                    'last_name_mother' => 'Quiñones',
                    'gender' => 'Masculino',
                    'birth_date' => '2016-07-25',
                    'nationality' => 'Chilena',
                    'religion' => 'Católica',
                    'address' => 'Llastuco KM 6.5',
                    'commune' => 'Máfil',
                    'phone' => '964009422',
                    'indigenous' => null,
                    'health' => true,
                    'pie' => true,
                ],
                [
                    'rut' => '25.345.940-9',
                    'first_name' => 'Simón Lucas',
                    'last_name_father' => 'Muñoz',
                    'last_name_mother' => 'Montes',
                    'gender' => 'Masculino',
                    'birth_date' => '2016-04-12',
                    'nationality' => 'Chilena',
                    'religion' => 'Evangélica',
                    'address' => 'Sector Iñaque, Letrero Mi Casa',
                    'commune' => 'Máfil',
                    'phone' => '989335729',
                    'indigenous' => 'Mapuche',
                    'health' => true,
                    'pie' => false,
                ],
                [
                    'rut' => '25.520.073-9',
                    'first_name' => 'Felipe Darkiel',
                    'last_name_father' => 'Muñoz',
                    'last_name_mother' => 'Méndez',
                    'gender' => 'Masculino',
                    'birth_date' => '2016-09-25',
                    'nationality' => 'Chilena',
                    'religion' => 'Evangélica',
                    'address' => 'Villa Padre Hurtado, Palo Santo 378',
                    'commune' => 'Máfil',
                    'phone' => '944868983',
                    'indigenous' => null,
                    'health' => true,
                    'pie' => true,
                ],
                [
                    'rut' => '25.588.303-8',
                    'first_name' => 'Eric Nataniel',
                    'last_name_father' => 'Rivas',
                    'last_name_mother' => 'Bravo',
                    'gender' => 'Masculino',
                    'birth_date' => '2016-12-04',
                    'nationality' => 'Chilena',
                    'religion' => 'Católica',
                    'address' => 'Darío Salas 865',
                    'commune' => 'Máfil',
                    'phone' => '930563877',
                    'indigenous' => null,
                    'health' => true,
                    'pie' => true,
                ],
                [
                    'rut' => '25.677.731-2',
                    'first_name' => 'Ignacio Esteban',
                    'last_name_father' => 'Valenzuela',
                    'last_name_mother' => 'Briceño',
                    'gender' => 'Masculino',
                    'birth_date' => '2017-02-20',
                    'nationality' => 'Chilena',
                    'religion' => 'Otra',
                    'address' => 'Pidey S/N Camino a Llastuco',
                    'commune' => 'Máfil',
                    'phone' => '978386967',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => true,
                ],
            ];

            foreach ($students as $s) {

                $student = Student::firstOrCreate(
                    ['rut' => strtolower($s['rut'])],
                    [
                        'first_name' => $s['first_name'],
                        'last_name_father' => $s['last_name_father'],
                        'last_name_mother' => $s['last_name_mother'],
                        'gender' => $s['gender'],
                        'birth_date' => $s['birth_date'],
                        'nationality' => $s['nationality'],
                        'religion' => $s['religion'],
                        'address' => $s['address'],
                        'commune' => $s['commune'],
                        'phone' => $s['phone'],
                        'indigenous_ancestry' => !empty($s['indigenous']),
                        'indigenous_ancestry_type' => $s['indigenous'],
                    ]
                );

                Enrollment::firstOrCreate(
                    [
                        'student_id' => $student->id,
                        'school_year' => 2026,
                    ],
                    [
                        'course_id' => $course->id,
                        'enrollment_type' => 'Returning Student',
                        'status' => 'Pending',
                        'has_health_issues' => $s['health'],
                        'is_pie_student' => $s['pie'],
                    ]
                );
            }
        });
    }
}
