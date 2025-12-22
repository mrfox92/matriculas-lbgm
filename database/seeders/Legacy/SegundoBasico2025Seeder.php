<?php

namespace Database\Seeders\Legacy;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Student;
use App\Models\Enrollment;
use App\Models\Course;

class SegundoBasico2025Seeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {

            $course = Course::whereHas('gradeLevel', fn ($q) =>
                $q->where('name', '2° Básico')
            )->where('school_year', 2026)->firstOrFail();

            $students = [

                [
                    'rut' => '100.822.021-9',
                    'first_name' => 'Djoranise',
                    'last_name_father' => 'Delva',
                    'last_name_mother' => '',
                    'gender' => 'Femenino',
                    'birth_date' => '2018-02-18',
                    'nationality' => 'Haitiana',
                    'religion' => 'Ninguna',
                    'address' => 'Fundo Los Maitenes S/N',
                    'commune' => 'Máfil',
                    'phone' => '937408574',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => false,
                ],
                [
                    'rut' => '26.086.196-4',
                    'first_name' => 'Luciano',
                    'last_name_father' => 'Dalmiro',
                    'last_name_mother' => '',
                    'gender' => 'Masculino',
                    'birth_date' => '2018-01-20',
                    'nationality' => 'Chilena',
                    'religion' => 'Evangélica',
                    'address' => 'Población Gabriela Mistral Pasaje Monte Grande 12',
                    'commune' => 'Máfil',
                    'phone' => '932240851',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => false,
                ],
                [
                    'rut' => '26.170.445-5',
                    'first_name' => 'Rocío Dennise',
                    'last_name_father' => 'Curin',
                    'last_name_mother' => 'Ortega',
                    'gender' => 'Femenino',
                    'birth_date' => '2018-03-13',
                    'nationality' => 'Chilena',
                    'religion' => 'Evangélica',
                    'address' => 'Mulpun S/N',
                    'commune' => 'Máfil',
                    'phone' => '986249614',
                    'indigenous' => 'Mapuche',
                    'health' => false,
                    'pie' => false,
                ],
                [
                    'rut' => '25.878.743-9',
                    'first_name' => 'Isidora Danae',
                    'last_name_father' => 'Cañoles',
                    'last_name_mother' => 'Curiqueo',
                    'gender' => 'Femenino',
                    'birth_date' => '2017-08-20',
                    'nationality' => 'Chilena',
                    'religion' => 'Ninguna',
                    'address' => 'Huillón S/N',
                    'commune' => 'Máfil',
                    'phone' => null,
                    'indigenous' => null,
                    'health' => false,
                    'pie' => false,
                ],
                [
                    'rut' => '26.001.275-4',
                    'first_name' => 'Renata Octavia',
                    'last_name_father' => 'Astete',
                    'last_name_mother' => 'Brandt',
                    'gender' => 'Femenino',
                    'birth_date' => '2017-11-14',
                    'nationality' => 'Chilena',
                    'religion' => 'Católica',
                    'address' => 'Rubén Darío 3101, Villa Cau-Cau',
                    'commune' => 'Valdivia',
                    'phone' => '964543296',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => false,
                ],
                [
                    'rut' => '25.802.169-k',
                    'first_name' => 'Lía Antonella',
                    'last_name_father' => 'Baiman',
                    'last_name_mother' => 'Mendoza',
                    'gender' => 'Femenino',
                    'birth_date' => null,
                    'nationality' => 'Chilena',
                    'religion' => 'Católica',
                    'address' => null,
                    'commune' => 'Máfil',
                    'phone' => null,
                    'indigenous' => null,
                    'health' => false,
                    'pie' => false,
                ],
                [
                    'rut' => '25.907.252-2',
                    'first_name' => 'Emma Sophia',
                    'last_name_father' => 'Cañoles',
                    'last_name_mother' => 'Cardenas',
                    'gender' => 'Femenino',
                    'birth_date' => '2017-09-11',
                    'nationality' => 'Chilena',
                    'religion' => 'Evangélica',
                    'address' => 'Runca S/N',
                    'commune' => 'Máfil',
                    'phone' => '938891202',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => false,
                ],
                [
                    'rut' => '25.960.024-3',
                    'first_name' => 'Sofía Valentina',
                    'last_name_father' => 'Constanzo',
                    'last_name_mother' => 'Garrido',
                    'gender' => 'Femenino',
                    'birth_date' => '2017-10-27',
                    'nationality' => 'Chilena',
                    'religion' => 'Ninguna',
                    'address' => 'Villa Entre Ríos Paj Río Pichoy 319',
                    'commune' => 'Máfil',
                    'phone' => '931177106',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => false,
                ],
                [
                    'rut' => '25.871.494-6',
                    'first_name' => 'Valentina Ignacia',
                    'last_name_father' => 'Coronado',
                    'last_name_mother' => 'Sepúlveda',
                    'gender' => 'Femenino',
                    'birth_date' => '2017-08-14',
                    'nationality' => 'Chilena',
                    'religion' => 'Evangélica',
                    'address' => 'Villa San Luis Runca 145',
                    'commune' => 'Máfil',
                    'phone' => '995032520',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => true,
                ],
                [
                    'rut' => '25.805.038-k',
                    'first_name' => 'Martín Tomás',
                    'last_name_father' => 'Mendoza',
                    'last_name_mother' => 'Campos',
                    'gender' => 'Masculino',
                    'birth_date' => '2017-06-19',
                    'nationality' => 'Chilena',
                    'religion' => 'Evangélica',
                    'address' => 'Fundo Peñaflor S/N',
                    'commune' => 'Máfil',
                    'phone' => '991645623',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => true,
                ],
                [
                    'rut' => '26.139.917-2',
                    'first_name' => 'Pascal Isidora',
                    'last_name_father' => 'Rubo',
                    'last_name_mother' => 'Godoy',
                    'gender' => 'Femenino',
                    'birth_date' => '2018-02-23',
                    'nationality' => 'Chilena',
                    'religion' => 'Católica',
                    'address' => 'Los Notros N°250',
                    'commune' => 'Máfil',
                    'phone' => '978665327',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => false,
                ],
                [
                    'rut' => '25.932.162-k',
                    'first_name' => 'Jorge Ignacio',
                    'last_name_father' => 'Saez',
                    'last_name_mother' => 'Soto',
                    'gender' => 'Masculino',
                    'birth_date' => '2017-10-04',
                    'nationality' => 'Chilena',
                    'religion' => 'Evangélica',
                    'address' => 'Villa Entre Ríos Pasaje Millahuillin 237',
                    'commune' => 'Máfil',
                    'phone' => '926340599',
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
