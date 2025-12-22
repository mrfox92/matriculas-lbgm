<?php

namespace Database\Seeders\Legacy;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Student;
use App\Models\Enrollment;
use App\Models\Course;

class SeptimoBasicoB2025Seeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {

            $course = Course::whereHas('gradeLevel', fn ($q) =>
                $q->where('name', '7° Básico')
            )
            ->where('letter', 'B')
            ->where('school_year', 2026)
            ->firstOrFail();

            $students = [

                [
                    'rut' => '24.141.313-6',
                    'first_name' => 'Pedro Antonia',
                    'last_name_father' => 'Cárdenas',
                    'last_name_mother' => 'Zambrano',
                    'gender' => 'Masculino',
                    'birth_date' => '2012-12-14',
                    'nationality' => 'Chilena',
                    'religion' => 'Católica',
                    'address' => 'Molco',
                    'commune' => 'Máfil',
                    'phone' => '984163250',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => true,
                ],

                [
                    'rut' => '24.182.526-4',
                    'first_name' => 'Abigail Amanda',
                    'last_name_father' => 'Cheuquellan',
                    'last_name_mother' => 'Ojeda',
                    'gender' => 'Femenino',
                    'birth_date' => '2013-02-02',
                    'nationality' => 'Chilena',
                    'religion' => null,
                    'address' => 'Comunidad Ancalipe, Folilco Alturas',
                    'commune' => 'Máfil',
                    'phone' => '995741485',
                    'indigenous' => 'Mapuche',
                    'health' => false,
                    'pie' => false,
                ],

                [
                    'rut' => '23.957.427-0',
                    'first_name' => 'Benjamín Ignacio',
                    'last_name_father' => 'Coñuen',
                    'last_name_mother' => 'Campos',
                    'gender' => 'Masculino',
                    'birth_date' => '2012-05-21',
                    'nationality' => 'Chilena',
                    'religion' => 'Evangélica',
                    'address' => 'Víctor Soto 208, Los Castaños',
                    'commune' => 'Máfil',
                    'phone' => '965604790',
                    'indigenous' => 'Mapuche',
                    'health' => false,
                    'pie' => false,
                ],

                [
                    'rut' => '100.784.008-6',
                    'first_name' => 'Diowana',
                    'last_name_father' => 'Delva',
                    'last_name_mother' => null,
                    'gender' => 'Femenino',
                    'birth_date' => '2012-04-10',
                    'nationality' => 'Haitiana',
                    'religion' => 'Evangélica',
                    'address' => 'Mulpun, Fundo Los Maitenes S/N',
                    'commune' => 'Máfil',
                    'phone' => '937408574',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => false,
                ],

                [
                    'rut' => '24.170.798-9',
                    'first_name' => 'Giovanni Sebastián Alejandro',
                    'last_name_father' => 'Figueroa',
                    'last_name_mother' => 'Velásquez',
                    'gender' => 'Masculino',
                    'birth_date' => '2013-01-19',
                    'nationality' => 'Chilena',
                    'religion' => 'Evangélica',
                    'address' => 'Llastuco N°10',
                    'commune' => 'Máfil',
                    'phone' => '931725894',
                    'indigenous' => null,
                    'health' => true, // asma
                    'pie' => true,
                ],

                [
                    'rut' => '24.000.863-7',
                    'first_name' => 'Dylan Ignacio',
                    'last_name_father' => 'Flores',
                    'last_name_mother' => 'Córdova',
                    'gender' => 'Masculino',
                    'birth_date' => '2012-06-01',
                    'nationality' => 'Chilena',
                    'religion' => 'Católica',
                    'address' => 'Pedro Aguirre Cerda 160',
                    'commune' => 'Máfil',
                    'phone' => '979867329',
                    'indigenous' => 'Mapuche',
                    'health' => false,
                    'pie' => true,
                ],

                [
                    'rut' => '24.115.419-k',
                    'first_name' => 'Yamileth Alejandra',
                    'last_name_father' => 'Henríquez',
                    'last_name_mother' => 'Vergara',
                    'gender' => 'Femenino',
                    'birth_date' => '2012-11-02',
                    'nationality' => 'Chilena',
                    'religion' => 'Católica',
                    'address' => 'Villa Las Palmeras, Pasaje Las Palmeras 179',
                    'commune' => 'Máfil',
                    'phone' => '986959936',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => true,
                ],

                [
                    'rut' => '26.633.910-0',
                    'first_name' => 'Fabián Alejandro',
                    'last_name_father' => 'Hernández',
                    'last_name_mother' => 'Duarte',
                    'gender' => 'Masculino',
                    'birth_date' => '2012-09-11',
                    'nationality' => 'Chilena',
                    'religion' => 'Evangélica',
                    'address' => 'John Kennedy, Pasaje Monte Grande N°145',
                    'commune' => 'Máfil',
                    'phone' => '928987338',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => false,
                ],

                [
                    'rut' => '23.853.252-3',
                    'first_name' => 'Lorenzo Nicolás Ramses',
                    'last_name_father' => 'Jil',
                    'last_name_mother' => 'Salinas',
                    'gender' => 'Masculino',
                    'birth_date' => '2012-01-24',
                    'nationality' => 'Chilena',
                    'religion' => 'Evangélica',
                    'address' => 'Rinconada S/N',
                    'commune' => 'Máfil',
                    'phone' => '921969731',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => false,
                ],

                [
                    'rut' => '24.214.601-8',
                    'first_name' => 'Tomás Elías',
                    'last_name_father' => 'Mansilla',
                    'last_name_mother' => 'Ortega',
                    'gender' => 'Masculino',
                    'birth_date' => '2013-03-08',
                    'nationality' => 'Chilena',
                    'religion' => 'Evangélica',
                    'address' => 'Pidey S/N',
                    'commune' => 'Máfil',
                    'phone' => '990744485',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => false,
                ],

                [
                    'rut' => '23.752.767-4',
                    'first_name' => 'Scarlet Antonel',
                    'last_name_father' => 'Martín',
                    'last_name_mother' => 'Sánchez',
                    'gender' => 'Femenino',
                    'birth_date' => '2011-09-22',
                    'nationality' => 'Chilena',
                    'religion' => 'Evangélica',
                    'address' => 'San Pedro',
                    'commune' => 'Máfil',
                    'phone' => '962014461',
                    'indigenous' => 'Mapuche',
                    'health' => false,
                    'pie' => true,
                ],

                [
                    'rut' => '24.139.917-6',
                    'first_name' => 'Joaquín Isaí',
                    'last_name_father' => 'Muñoz',
                    'last_name_mother' => 'Gonzales',
                    'gender' => 'Masculino',
                    'birth_date' => '2012-12-13',
                    'nationality' => 'Chilena',
                    'religion' => 'Evangélica',
                    'address' => 'Iñaque Huerto 7',
                    'commune' => 'Máfil',
                    'phone' => '986812121',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => false,
                ],

                [
                    'rut' => '24.159.048-8',
                    'first_name' => 'Emilia Ignacia',
                    'last_name_father' => 'Queupan',
                    'last_name_mother' => 'Montecinos',
                    'gender' => 'Femenino',
                    'birth_date' => '2013-01-27',
                    'nationality' => 'Chilena',
                    'religion' => 'Católica',
                    'address' => 'Los Copihues 109, Runca',
                    'commune' => 'Máfil',
                    'phone' => '993334275',
                    'indigenous' => 'Mapuche',
                    'health' => false,
                    'pie' => true,
                ],

                [
                    'rut' => '23.543.170-k',
                    'first_name' => 'Andrea Antonia',
                    'last_name_father' => 'Ramírez',
                    'last_name_mother' => 'Martín',
                    'gender' => 'Femenino',
                    'birth_date' => '2011-01-22',
                    'nationality' => 'Chilena',
                    'religion' => 'Evangélica',
                    'address' => 'San Pedro',
                    'commune' => 'Máfil',
                    'phone' => '987565189',
                    'indigenous' => null,
                    'health' => true,
                    'pie' => true,
                ],

                [
                    'rut' => '23.979.218-9',
                    'first_name' => 'Bárbara Solange',
                    'last_name_father' => 'Soferry',
                    'last_name_mother' => 'Baeza',
                    'gender' => 'Femenino',
                    'birth_date' => '2012-06-07',
                    'nationality' => 'Chilena',
                    'religion' => 'Católica',
                    'address' => 'Juan Verdaguer #366',
                    'commune' => 'Máfil',
                    'phone' => '965719495',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => true,
                ],

                [
                    'rut' => '24.058.479-4',
                    'first_name' => 'Cristian Ariel',
                    'last_name_father' => 'Vega',
                    'last_name_mother' => 'Lara',
                    'gender' => 'Masculino',
                    'birth_date' => '2012-09-06',
                    'nationality' => 'Chilena',
                    'religion' => 'Católica',
                    'address' => 'Karol Urzúa 265',
                    'commune' => 'Máfil',
                    'phone' => '982159340',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => false,
                ],

                [
                    'rut' => '23.692.008-9',
                    'first_name' => 'Jeremías Elías',
                    'last_name_father' => 'Lincocheo',
                    'last_name_mother' => 'Huerañanco',
                    'gender' => 'Masculino',
                    'birth_date' => '2011-07-13',
                    'nationality' => 'Chilena',
                    'religion' => null,
                    'address' => 'Nilhue',
                    'commune' => 'Máfil',
                    'phone' => '968546012',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => false,
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
                        'indigenous_ancestry_type' => $s['indigenous'] ?: null,
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
                        'has_health_issues' => (bool) $s['health'],
                        'is_pie_student' => (bool) $s['pie'],
                    ]
                );
            }
        });
    }
}
