<?php

namespace Database\Seeders\Legacy;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Student;
use App\Models\Enrollment;
use App\Models\Course;

class PreKinder2025Seeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {

            $course = Course::whereHas('gradeLevel', fn ($q) =>
                $q->where('name', 'Pre-Kinder')
            )->where('school_year', 2026)->firstOrFail();

            $students = [

                [
                    'rut' => '27.270.239-k',
                    'first_name' => 'Liam Alexis',
                    'last_name_father' => 'Alvares',
                    'last_name_mother' => 'Curin',
                    'gender' => 'Masculino',
                    'birth_date' => '2020-04-28',
                    'nationality' => 'Chilena',
                    'religion' => 'Evangélica',
                    'address' => 'Comunidad Hueman Curin',
                    'commune' => 'Máfil',
                    'phone' => '965626334',
                    'indigenous' => 'Mapuche',
                    'health' => false,
                    'pie' => false,
                ],

                [
                    'rut' => '27.450.773-k',
                    'first_name' => 'Sofia Isidora',
                    'last_name_father' => 'Bascuñan',
                    'last_name_mother' => 'Muñoz',
                    'gender' => 'Femenino',
                    'birth_date' => '2021-01-18',
                    'nationality' => 'Chilena',
                    'religion' => 'Evangélica',
                    'address' => 'Bernardo O’Higgins 466',
                    'commune' => 'Máfil',
                    'phone' => '952593818',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => false,
                ],

                [
                    'rut' => '27.455.632-3',
                    'first_name' => 'Blanca Ester',
                    'last_name_father' => 'Carrascos',
                    'last_name_mother' => 'Moris',
                    'gender' => 'Femenino',
                    'birth_date' => '2021-01-13',
                    'nationality' => 'Chilena',
                    'religion' => 'Evangélica',
                    'address' => 'Fundo San Carlos, Peña Flor',
                    'commune' => 'Máfil',
                    'phone' => '937488592',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => false,
                ],

                [
                    'rut' => '27.410.294-2',
                    'first_name' => 'Yomar Delva',
                    'last_name_father' => 'Etiene',
                    'last_name_mother' => null,
                    'gender' => 'Masculino',
                    'birth_date' => '2022-11-27',
                    'nationality' => 'Haitiana',
                    'religion' => 'Evangélica',
                    'address' => 'Mulpun',
                    'commune' => 'Máfil',
                    'phone' => '937408547',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => false,
                ],

                [
                    'rut' => '27.473.943-6',
                    'first_name' => 'Santiago Gael',
                    'last_name_father' => 'Galvez',
                    'last_name_mother' => 'Gonzalez',
                    'gender' => 'Masculino',
                    'birth_date' => '2021-02-15',
                    'nationality' => 'Chilena',
                    'religion' => 'Otra',
                    'address' => 'Los Radales #327',
                    'commune' => 'Valdivia',
                    'phone' => '978834426',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => false,
                ],

                [
                    'rut' => '27.482.947-8',
                    'first_name' => 'Ámbar Sofía',
                    'last_name_father' => 'Herrera',
                    'last_name_mother' => 'Albornoz',
                    'gender' => 'Femenino',
                    'birth_date' => '2021-03-05',
                    'nationality' => 'Chilena',
                    'religion' => 'Otra',
                    'address' => 'Rinconada sin número',
                    'commune' => 'Máfil',
                    'phone' => '926366395',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => false,
                ],

                [
                    'rut' => '27.467.572-1',
                    'first_name' => 'Tomás Alonso',
                    'last_name_father' => 'Peña',
                    'last_name_mother' => 'Gonzalez',
                    'gender' => 'Masculino',
                    'birth_date' => '2021-02-10',
                    'nationality' => 'Chilena',
                    'religion' => 'Ninguna',
                    'address' => 'La Traca #200',
                    'commune' => 'Máfil',
                    'phone' => '934812885',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => true,
                ],

                [
                    'rut' => '27.432.479-1',
                    'first_name' => 'Fabián Nicolás',
                    'last_name_father' => 'Riquelme',
                    'last_name_mother' => 'Cisterna',
                    'gender' => 'Masculino',
                    'birth_date' => '2024-12-20',
                    'nationality' => 'Chilena',
                    'religion' => 'Ninguna',
                    'address' => 'Los Notros #225',
                    'commune' => 'Máfil',
                    'phone' => '935295775',
                    'indigenous' => 'si',
                    'health' => false,
                    'pie' => false,
                ],

                [
                    'rut' => '27.454.536-4',
                    'first_name' => 'Celeste',
                    'last_name_father' => 'Colomba',
                    'last_name_mother' => null,
                    'gender' => 'Femenino',
                    'birth_date' => '2025-03-03',
                    'nationality' => 'Chilena',
                    'religion' => 'Ninguna',
                    'address' => 'Sector La Traca 58',
                    'commune' => 'Máfil',
                    'phone' => '975394392',
                    'indigenous' => null,
                    'health' => true,
                    'pie' => true,
                ],

                [
                    'rut' => '27.267.817-0',
                    'first_name' => 'Amanda',
                    'last_name_father' => 'Cortes',
                    'last_name_mother' => 'Seguel Albornoz',
                    'gender' => 'Femenino',
                    'birth_date' => '2020-04-29',
                    'nationality' => 'Chilena',
                    'religion' => 'Otra',
                    'address' => 'Villa San Luis 112 Runca',
                    'commune' => 'Máfil',
                    'phone' => '987018194',
                    'indigenous' => null,
                    'health' => true,
                    'pie' => false,
                ],

                [
                    'rut' => '27.280.023-5',
                    'first_name' => 'Aracely Antonela',
                    'last_name_father' => 'Sepúlveda',
                    'last_name_mother' => 'Ríos',
                    'gender' => 'Femenino',
                    'birth_date' => '2020-05-20',
                    'nationality' => 'Chilena',
                    'religion' => 'Otra',
                    'address' => 'Folilco sector sede social',
                    'commune' => 'Máfil',
                    'phone' => '977663039',
                    'indigenous' => null,
                    'health' => true,
                    'pie' => false,
                ],

                [
                    'rut' => '27.260.872-5',
                    'first_name' => 'Sofia Antonia',
                    'last_name_father' => 'Uribe',
                    'last_name_mother' => 'Sepúlveda',
                    'gender' => 'Femenino',
                    'birth_date' => '2020-04-19',
                    'nationality' => 'Chilena',
                    'religion' => 'Evangélica',
                    'address' => 'Villa Llastuco #155',
                    'commune' => 'Máfil',
                    'phone' => '930117524',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => false,
                ],

                [
                    'rut' => '27.339.968-2',
                    'first_name' => 'Gabriel Aarón',
                    'last_name_father' => 'Vargas',
                    'last_name_mother' => 'Anabalón',
                    'gender' => 'Masculino',
                    'birth_date' => '2020-08-20',
                    'nationality' => 'Chilena',
                    'religion' => 'Ninguna',
                    'address' => 'Huillon s/n',
                    'commune' => 'Máfil',
                    'phone' => '926354744',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => false,
                ],

                [
                    'rut' => '27.500.812-5',
                    'first_name' => 'Tomás Gaspar',
                    'last_name_father' => 'Vivanco',
                    'last_name_mother' => 'Soto',
                    'gender' => 'Masculino',
                    'birth_date' => '2021-03-30',
                    'nationality' => 'Chilena',
                    'religion' => 'Católica',
                    'address' => 'Valdivia #457',
                    'commune' => 'Máfil',
                    'phone' => '993394838',
                    'indigenous' => 'Mapuche',
                    'health' => true,
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
