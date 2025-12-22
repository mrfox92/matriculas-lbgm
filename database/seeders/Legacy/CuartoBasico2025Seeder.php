<?php

namespace Database\Seeders\Legacy;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Student;
use App\Models\Enrollment;
use App\Models\Course;

class CuartoBasico2025Seeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {

            $course = Course::whereHas('gradeLevel', fn ($q) =>
                $q->where('name', '4° Básico')
            )->where('school_year', 2026)->firstOrFail();

            $students = [

                [
                    'rut' => '24.953.116-2',
                    'first_name' => 'Alan Aarón',
                    'last_name_father' => 'Abarca',
                    'last_name_mother' => 'Peña',
                    'gender' => 'Masculino',
                    'birth_date' => '2015-03-11',
                    'nationality' => 'Chilena',
                    'religion' => 'Católica',
                    'address' => 'Runca S/N',
                    'commune' => 'Máfil',
                    'phone' => '942563004',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => false,
                ],
                [
                    'rut' => '25.072.579-5',
                    'first_name' => 'Sofía Antonia',
                    'last_name_father' => 'Antio',
                    'last_name_mother' => 'Caiumpoy',
                    'gender' => 'Femenino',
                    'birth_date' => '2015-08-12',
                    'nationality' => 'Chilena',
                    'religion' => 'Evangélica',
                    'address' => 'Mulpun Alto S/N',
                    'commune' => 'Máfil',
                    'phone' => null,
                    'indigenous' => 'Mapuche',
                    'health' => false,
                    'pie' => false,
                ],
                [
                    'rut' => '25.168.825-7',
                    'first_name' => 'Leonardo Ignacio',
                    'last_name_father' => 'Bustamante',
                    'last_name_mother' => 'Torres',
                    'gender' => 'Masculino',
                    'birth_date' => '2015-10-23',
                    'nationality' => 'Chilena',
                    'religion' => 'Evangélica',
                    'address' => 'Ruta 5 Sur KM 804',
                    'commune' => 'Máfil',
                    'phone' => '990975134',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => false,
                ],

                // 4
                [
                    'rut' => '25.009.785-9',
                    'first_name' => 'Ángel Sebastián Giovanni',
                    'last_name_father' => 'Carrasco',
                    'last_name_mother' => 'Ortiz',
                    'gender' => 'Masculino',
                    'birth_date' => '2015-06-11',
                    'nationality' => 'Chilena',
                    'religion' => 'Católica',
                    'address' => 'Los Pellines 341, Pobl. Padre Hurtado',
                    'commune' => 'Máfil',
                    'phone' => '942818297',
                    'indigenous' => 'Mapuche',
                    'health' => false,
                    'pie' => false,
                ],

                // 5
                [
                    'rut' => '25.113.842-7',
                    'first_name' => 'Josué Manuel',
                    'last_name_father' => 'Cheuquellanca',
                    'last_name_mother' => 'Ojeda',
                    'gender' => 'Masculino',
                    'birth_date' => '2015-09-11',
                    'nationality' => 'Chilena',
                    'religion' => 'Evangélica',
                    'address' => 'Comunidad Ancalipe, Folilco Las Alturas',
                    'commune' => 'Máfil',
                    'phone' => '995741485',
                    'indigenous' => 'Mapuche',
                    'health' => false,
                    'pie' => false,
                ],

                // 6
                [
                    'rut' => '24.982.618-9',
                    'first_name' => 'Javier Alexander',
                    'last_name_father' => 'Duath',
                    'last_name_mother' => 'Catrichéo',
                    'gender' => 'Masculino',
                    'birth_date' => '2015-05-12',
                    'nationality' => 'Chilena',
                    'religion' => 'Evangélica',
                    'address' => 'Villa Entre Ríos, Curalefú 253',
                    'commune' => 'Máfil',
                    'phone' => '927699836',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => false,
                ],

                // 7
                [
                    'rut' => '25.209.561-6',
                    'first_name' => 'Arlette Yarely',
                    'last_name_father' => 'Duque',
                    'last_name_mother' => 'Antio',
                    'gender' => 'Femenino',
                    'birth_date' => '2015-11-27',
                    'nationality' => 'Chilena',
                    'religion' => 'Otra',
                    'address' => 'Sector Mulpun S/N, Comunidad Huemal Curín',
                    'commune' => 'Máfil',
                    'phone' => '982266559',
                    'indigenous' => 'Mapuche',
                    'health' => true,
                    'pie' => true,
                ],

                // 8
                [
                    'rut' => '25.104.863-0',
                    'first_name' => 'Francisca Emiliana',
                    'last_name_father' => 'Galuez',
                    'last_name_mother' => 'González',
                    'gender' => 'Femenino',
                    'birth_date' => '2015-09-02',
                    'nationality' => 'Chilena',
                    'religion' => 'Católica',
                    'address' => 'Los Pedales 327, Pobl. Padre Hurtado',
                    'commune' => 'Máfil',
                    'phone' => '978834426',
                    'indigenous' => null,
                    'health' => true,
                    'pie' => false,
                ],

                // 9
                [
                    'rut' => '25.252.229-8',
                    'first_name' => 'Sofía Ignacia',
                    'last_name_father' => 'Lizama',
                    'last_name_mother' => 'Escare',
                    'gender' => 'Femenino',
                    'birth_date' => '2016-01-11',
                    'nationality' => 'Chilena',
                    'religion' => 'Católica',
                    'address' => 'Linguiento S/N',
                    'commune' => 'Máfil',
                    'phone' => '938811175',
                    'indigenous' => null,
                    'health' => true,
                    'pie' => false,
                ],

                // 10
                [
                    'rut' => '25.075.004-8',
                    'first_name' => 'Emiliano Andrés',
                    'last_name_father' => 'Madrid',
                    'last_name_mother' => 'Iturrieta',
                    'gender' => 'Masculino',
                    'birth_date' => '2015-08-14',
                    'nationality' => 'Chilena',
                    'religion' => 'Evangélica',
                    'address' => 'Darío Salas #655, Pobl. Libertad',
                    'commune' => 'Máfil',
                    'phone' => '964203948',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => false,
                ],

                // 11
                [
                    'rut' => '24.841.526-6',
                    'first_name' => 'Emily Monserrat',
                    'last_name_father' => 'Narin',
                    'last_name_mother' => 'Saravia',
                    'gender' => 'Femenino',
                    'birth_date' => '2014-12-31',
                    'nationality' => 'Chilena',
                    'religion' => 'Ninguna',
                    'address' => 'Sector Runca S/N',
                    'commune' => 'Máfil',
                    'phone' => '940758407',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => false,
                ],

                // 12
                [
                    'rut' => '24.955.887-6',
                    'first_name' => 'Isabella Andrea Amelia',
                    'last_name_father' => 'Amelia',
                    'last_name_mother' => null,
                    'gender' => 'Femenino',
                    'birth_date' => '2015-04-13',
                    'nationality' => 'Chilena',
                    'religion' => 'Católica',
                    'address' => 'Villa Entre Ríos, Pasaje Río 376',
                    'commune' => 'Máfil',
                    'phone' => '964280103',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => false,
                ],

                // 13
                [
                    'rut' => '24.981.267-6',
                    'first_name' => 'Alan Iam',
                    'last_name_father' => 'Meneses',
                    'last_name_mother' => 'Pinilla',
                    'gender' => 'Masculino',
                    'birth_date' => '2015-06-06',
                    'nationality' => 'Chilena',
                    'religion' => 'Ninguna',
                    'address' => 'Pasaje Carol Urzúa S/N',
                    'commune' => 'Máfil',
                    'phone' => '936541882',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => false,
                ],

                // 14
                [
                    'rut' => '25.010.077-9',
                    'first_name' => 'Vicente Javier',
                    'last_name_father' => 'Mera',
                    'last_name_mother' => 'Alarcón',
                    'gender' => 'Masculino',
                    'birth_date' => '2015-06-09',
                    'nationality' => 'Chilena',
                    'religion' => 'Evangélica',
                    'address' => 'Iñaque Huerto 11',
                    'commune' => 'Máfil',
                    'phone' => '991339672',
                    'indigenous' => 'Mapuche',
                    'health' => true,
                    'pie' => true,
                ],

                // 15
                [
                    'rut' => '28.377.124-5',
                    'first_name' => 'Sebastián Daniel',
                    'last_name_father' => 'Mujica',
                    'last_name_mother' => 'Blake',
                    'gender' => 'Masculino',
                    'birth_date' => '2016-03-23',
                    'nationality' => 'Chilena',
                    'religion' => 'Evangélica',
                    'address' => 'Fundo Las Lomas',
                    'commune' => 'Máfil',
                    'phone' => '959859982',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => false,
                ],

                // 16
                [
                    'rut' => '100.597.555-3',
                    'first_name' => 'Dylan',
                    'last_name_father' => 'Palomino',
                    'last_name_mother' => 'Ayaviri',
                    'gender' => 'Masculino',
                    'birth_date' => '2002-02-01',
                    'nationality' => 'Boliviana',
                    'religion' => 'Evangélica',
                    'address' => 'Ruta 5 Sur KM 804',
                    'commune' => 'Máfil',
                    'phone' => '984923601',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => false,
                ],

                // 17
                [
                    'rut' => '25.117.430-K',
                    'first_name' => 'Ángel Agustín',
                    'last_name_father' => 'Pincheira',
                    'last_name_mother' => 'Triviños',
                    'gender' => 'Masculino',
                    'birth_date' => '2015-09-14',
                    'nationality' => 'Chilena',
                    'religion' => 'Católica',
                    'address' => 'Fundo Las Lomas',
                    'commune' => 'Máfil',
                    'phone' => '992451684',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => false,
                ],

                // 18
                [
                    'rut' => '25.120.564-7',
                    'first_name' => 'Josefa Monserrat',
                    'last_name_father' => 'Queupan',
                    'last_name_mother' => 'Montecinos',
                    'gender' => 'Femenino',
                    'birth_date' => '2015-09-27',
                    'nationality' => 'Chilena',
                    'religion' => 'Católica',
                    'address' => 'Los Copihues 109, Villa San Luis (Runca)',
                    'commune' => 'Máfil',
                    'phone' => '958727621',
                    'indigenous' => 'Mapuche',
                    'health' => false,
                    'pie' => false,
                ],

                // 19
                [
                    'rut' => '25.051.791-2',
                    'first_name' => 'Lyndsay Julieta',
                    'last_name_father' => 'Seguel',
                    'last_name_mother' => 'Albornoz',
                    'gender' => 'Femenino',
                    'birth_date' => '2015-05-25',
                    'nationality' => 'Chilena',
                    'religion' => 'Católica',
                    'address' => 'Villa San Luis, Pasaje Los Copihues #112',
                    'commune' => 'Máfil',
                    'phone' => '973428683',
                    'indigenous' => null,
                    'health' => true,
                    'pie' => false,
                ],

                // 20
                [
                    'rut' => '24.977.570-3',
                    'first_name' => 'Hebweth Jair',
                    'last_name_father' => 'Sepúlveda',
                    'last_name_mother' => 'Beroíza',
                    'gender' => 'Masculino',
                    'birth_date' => '2015-05-06',
                    'nationality' => 'Chilena',
                    'religion' => 'Evangélica',
                    'address' => 'Fundo Casas Máfil, Quiñeo Norte S/N',
                    'commune' => 'Máfil',
                    'phone' => '993403725',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => false,
                ],

                // 21
                [
                    'rut' => '25.122.274-6',
                    'first_name' => 'Antonella Fernanda',
                    'last_name_father' => 'Vargas',
                    'last_name_mother' => 'Garrido',
                    'gender' => 'Femenino',
                    'birth_date' => '2015-09-19',
                    'nationality' => 'Chilena',
                    'religion' => 'Católica',
                    'address' => 'Fundo Juan Carlos Leman',
                    'commune' => 'Máfil',
                    'phone' => '939064756',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => false,
                ],

                // 22
                [
                    'rut' => '25.027.655-9',
                    'first_name' => 'Maytte Rocío Belén',
                    'last_name_father' => 'Velásquez',
                    'last_name_mother' => 'Loncochino',
                    'gender' => 'Femenino',
                    'birth_date' => '2015-06-26',
                    'nationality' => 'Chilena',
                    'religion' => 'Católica',
                    'address' => 'Fundo Las Quemas',
                    'commune' => 'Máfil',
                    'phone' => '944003261',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => true,
                ],

                // 23
                [
                    'rut' => '25.366.513-0',
                    'first_name' => 'Amaral Esperanza',
                    'last_name_father' => 'Vergara',
                    'last_name_mother' => 'Hernández',
                    'gender' => 'Femenino',
                    'birth_date' => '2016-05-03',
                    'nationality' => 'Chilena',
                    'religion' => 'Evangélica',
                    'address' => 'Linguiento, Callejón Los Troncos Parcela 46',
                    'commune' => 'Máfil',
                    'phone' => '964214181',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => false,
                ],

                // 24
                [
                    'rut' => '25.247.018-2',
                    'first_name' => 'Génesis Noemí',
                    'last_name_father' => 'Villar',
                    'last_name_mother' => 'Cañoles',
                    'gender' => 'Femenino',
                    'birth_date' => '2015-12-31',
                    'nationality' => 'Chilena',
                    'religion' => 'Católica',
                    'address' => 'Blanco Encalada 177 Casa B Interior',
                    'commune' => 'Máfil',
                    'phone' => '951999268',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => false,
                ],

                // 25
                [
                    'rut' => '24.979.380-9',
                    'first_name' => 'Dylan Anthony Jasper',
                    'last_name_father' => 'Villar',
                    'last_name_mother' => 'Mora',
                    'gender' => 'Masculino',
                    'birth_date' => '2015-05-08',
                    'nationality' => 'Chilena',
                    'religion' => 'Católica',
                    'address' => 'El Maitén 220, Villa Altos de Llastuco',
                    'commune' => 'Máfil',
                    'phone' => '972416966',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => false,
                ],

                // 26
                [
                    'rut' => '25.021.764-1',
                    'first_name' => 'Denisse Aylen',
                    'last_name_father' => 'Sepúlveda',
                    'last_name_mother' => 'Ríos',
                    'gender' => 'Femenino',
                    'birth_date' => null,
                    'nationality' => 'Chilena',
                    'religion' => 'Ninguna',
                    'address' => 'Folilco, Sector Sede Social',
                    'commune' => 'Máfil',
                    'phone' => '977663039',
                    'indigenous' => 'Mapuche',
                    'health' => true,
                    'pie' => true,
                ],

                // 27
                [
                    'rut' => '25.110.387-9',
                    'first_name' => 'Tomás Alexander',
                    'last_name_father' => 'Villaroel',
                    'last_name_mother' => 'Gómez',
                    'gender' => 'Masculino',
                    'birth_date' => '2015-09-08',
                    'nationality' => 'Chilena',
                    'religion' => 'Católica',
                    'address' => 'Av. Arturo Prat 222',
                    'commune' => 'Máfil',
                    'phone' => '996310362',
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
