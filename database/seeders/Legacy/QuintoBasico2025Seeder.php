<?php

namespace Database\Seeders\Legacy;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Student;
use App\Models\Enrollment;
use App\Models\Course;

class QuintoBasico2025Seeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {

            $course = Course::whereHas('gradeLevel', fn ($q) =>
                $q->where('name', '5° Básico')
            )->where('school_year', 2026)->firstOrFail();

            $students = [

                // 1
                [
                    'rut' => '24.806.493-5',
                    'first_name' => 'Isabel Ignacia',
                    'last_name_father' => 'Quilodrán',
                    'last_name_mother' => 'Concha',
                    'gender' => 'Femenino',
                    'birth_date' => '2014-11-21',
                    'nationality' => 'Chilena',
                    'religion' => 'Católica',
                    'address' => 'Chacabuco 630',
                    'commune' => 'Máfil',
                    'phone' => '956995764854',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => false,
                ],

                // 2
                [
                    'rut' => '24.865.724-3',
                    'first_name' => 'Daniel Nicolás',
                    'last_name_father' => 'Ruiz',
                    'last_name_mother' => 'Contreras',
                    'gender' => 'Masculino',
                    'birth_date' => '2015-01-16',
                    'nationality' => 'Chilena',
                    'religion' => 'Católica',
                    'address' => 'Putregel S/N',
                    'commune' => 'Máfil',
                    'phone' => '975373067',
                    'indigenous' => 'Mapuche',
                    'health' => false,
                    'pie' => false,
                ],

                // 3
                [
                    'rut' => '24.914.447-9',
                    'first_name' => 'Maicol Jhariel',
                    'last_name_father' => 'Valenzuela',
                    'last_name_mother' => 'Ormeño',
                    'gender' => 'Masculino',
                    'birth_date' => '2015-02-28',
                    'nationality' => 'Chilena',
                    'religion' => null,
                    'address' => null,
                    'commune' => 'Máfil',
                    'phone' => '937483022',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => false,
                ],

                // 4
                [
                    'rut' => '24.634.509-0',
                    'first_name' => 'Keitlyn Mileidy',
                    'last_name_father' => 'Valenzuela',
                    'last_name_mother' => 'Ormeño',
                    'gender' => 'Femenino',
                    'birth_date' => '2014-05-18',
                    'nationality' => 'Chilena',
                    'religion' => null,
                    'address' => 'Santa Laura Sitio 3',
                    'commune' => 'Máfil',
                    'phone' => '974107869',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => false,
                ],

                // 5
                [
                    'rut' => '24.596.775-6',
                    'first_name' => 'Tahiel Linkoya',
                    'last_name_father' => 'Curin',
                    'last_name_mother' => 'Curin',
                    'gender' => 'Femenino',
                    'birth_date' => '2014-04-15',
                    'nationality' => 'Chilena',
                    'religion' => 'Evangélica',
                    'address' => 'Mulpun, La Comunidad',
                    'commune' => 'Máfil',
                    'phone' => '949484537',
                    'indigenous' => 'Mapuche',
                    'health' => false,
                    'pie' => false,
                ],

                // 6
                [
                    'rut' => '24.641.141-7',
                    'first_name' => 'Benjamín',
                    'last_name_father' => 'Hipólito',
                    'last_name_mother' => null,
                    'gender' => 'Masculino',
                    'birth_date' => '2014-05-26',
                    'nationality' => 'Chilena',
                    'religion' => 'Católica',
                    'address' => 'Diagonal Chahnduy S/N',
                    'commune' => 'Máfil',
                    'phone' => '995248350',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => false,
                ],

                // 7
                [
                    'rut' => '24.629.517-4',
                    'first_name' => 'Nahiara Millaray',
                    'last_name_father' => 'Álvarez',
                    'last_name_mother' => 'Mena',
                    'gender' => 'Femenino',
                    'birth_date' => '2014-05-22',
                    'nationality' => 'Chilena',
                    'religion' => 'Otra',
                    'address' => 'Sector Runca S/N',
                    'commune' => 'Máfil',
                    'phone' => '942642225',
                    'indigenous' => null,
                    'health' => true,
                    'pie' => false,
                ],

                // 8
                [
                    'rut' => '24.901.543-1',
                    'first_name' => 'Sebastián Issac',
                    'last_name_father' => 'Bascuñán',
                    'last_name_mother' => 'Muñoz',
                    'gender' => 'Masculino',
                    'birth_date' => '2015-05-15',
                    'nationality' => 'Chilena',
                    'religion' => 'Evangélica',
                    'address' => 'O’Higgins 466, Máfil',
                    'commune' => 'Máfil',
                    'phone' => '931791511',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => true,
                ],

                // 9
                [
                    'rut' => '24.636.432-5',
                    'first_name' => 'Alonso Emiliano',
                    'last_name_father' => 'Bustamante',
                    'last_name_mother' => 'Torres',
                    'gender' => 'Masculino',
                    'birth_date' => '2014-06-02',
                    'nationality' => 'Chilena',
                    'religion' => 'Evangélica',
                    'address' => 'Ruta 5 Sur KM 804',
                    'commune' => 'Máfil',
                    'phone' => '990975134',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => false,
                ],

                // 10
                [
                    'rut' => '24.703.354-8',
                    'first_name' => 'Esteban Eduardo',
                    'last_name_father' => 'Cáceres',
                    'last_name_mother' => 'Aguilera',
                    'gender' => 'Masculino',
                    'birth_date' => '2014-07-30',
                    'nationality' => 'Chilena',
                    'religion' => 'Católica',
                    'address' => 'Santa Laura S/N',
                    'commune' => 'Máfil',
                    'phone' => '962662914',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => true,
                ],

                // 11
                [
                    'rut' => '24.934.596-2',
                    'first_name' => 'Javier Ignacio',
                    'last_name_father' => 'Ebner',
                    'last_name_mother' => 'Carrasco',
                    'gender' => 'Masculino',
                    'birth_date' => '2015-03-21',
                    'nationality' => 'Chilena',
                    'religion' => 'Católica',
                    'address' => 'Villa San Luis #108, Runca',
                    'commune' => 'Máfil',
                    'phone' => '979919495',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => false,
                ],

                // 12
                [
                    'rut' => '24.903.903-9',
                    'first_name' => 'Fernanda Cristel',
                    'last_name_father' => 'Gómez',
                    'last_name_mother' => 'López',
                    'gender' => 'Femenino',
                    'birth_date' => '2015-02-18',
                    'nationality' => 'Chilena',
                    'religion' => 'Otra',
                    'address' => 'Chancoyán Parcela 10',
                    'commune' => 'Máfil',
                    'phone' => '993996786',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => false,
                ],
                                // 13
                [
                    'rut' => '24.705.839-7',
                    'first_name' => 'Raúl Maximiliano',
                    'last_name_father' => 'Guerrero',
                    'last_name_mother' => 'Muñoz',
                    'gender' => 'Masculino',
                    'birth_date' => '2014-08-06',
                    'nationality' => 'Chilena',
                    'religion' => null,
                    'address' => 'La Traca 404',
                    'commune' => 'Máfil',
                    'phone' => '983896220',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => false,
                ],

                // 14
                [
                    'rut' => '24.826.889-1',
                    'first_name' => 'Matei Yesenia',
                    'last_name_father' => 'Jil',
                    'last_name_mother' => 'Salinas',
                    'gender' => 'Femenino',
                    'birth_date' => '2014-12-12',
                    'nationality' => 'Chilena',
                    'religion' => 'Evangélica',
                    'address' => 'Rinconada S/N',
                    'commune' => 'Máfil',
                    'phone' => '994024107',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => false,
                ],

                // 15
                [
                    'rut' => '24.851.640-2',
                    'first_name' => 'Kevin Alexander',
                    'last_name_father' => 'Matus',
                    'last_name_mother' => 'Contreras',
                    'gender' => 'Masculino',
                    'birth_date' => '2015-01-02',
                    'nationality' => 'Chilena',
                    'religion' => null,
                    'address' => 'Villa Mafilita, Pasaje Francisco Taladriz',
                    'commune' => 'Máfil',
                    'phone' => '932041165',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => true,
                ],

                // 16
                [
                    'rut' => '24.783.461-3',
                    'first_name' => 'Jahaziel Patricio',
                    'last_name_father' => 'Muñoz',
                    'last_name_mother' => 'Álvarez',
                    'gender' => 'Masculino',
                    'birth_date' => '2014-10-24',
                    'nationality' => 'Chilena',
                    'religion' => 'Católica',
                    'address' => 'Juan Verdaguier, Pasaje Vicuña S/N',
                    'commune' => 'Máfil',
                    'phone' => '987647017',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => false,
                ],

                // 17
                [
                    'rut' => '24.722.572-2',
                    'first_name' => 'Eduard Benjamín',
                    'last_name_father' => 'Muñoz',
                    'last_name_mother' => 'González',
                    'gender' => 'Masculino',
                    'birth_date' => '2014-08-22',
                    'nationality' => 'Chilena',
                    'religion' => 'Evangélica',
                    'address' => 'Iñaque Huerto 7',
                    'commune' => 'Máfil',
                    'phone' => '986812121',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => false,
                ],

                // 18
                [
                    'rut' => '24.687.050-0',
                    'first_name' => 'Gabriel Alejandro',
                    'last_name_father' => 'Ortiz',
                    'last_name_mother' => 'Cárcamo',
                    'gender' => 'Masculino',
                    'birth_date' => '2014-07-10',
                    'nationality' => 'Chilena',
                    'religion' => 'Evangélica',
                    'address' => 'Fundo Molco S/N',
                    'commune' => 'Máfil',
                    'phone' => '940398995',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => false,
                ],

                // 19
                [
                    'rut' => '24.740.243-8',
                    'first_name' => 'Ignacia Dannitza',
                    'last_name_father' => 'Panchilla',
                    'last_name_mother' => 'Henríquez',
                    'gender' => 'Femenino',
                    'birth_date' => '2014-03-13',
                    'nationality' => 'Chilena',
                    'religion' => 'Católica',
                    'address' => 'Pasaje Los Copihues #66',
                    'commune' => 'Máfil',
                    'phone' => '987523476',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => false,
                ],

                // 20
                [
                    'rut' => '24.793.455-3',
                    'first_name' => 'Franco Antonio',
                    'last_name_father' => 'Riquelme',
                    'last_name_mother' => 'Silva',
                    'gender' => 'Masculino',
                    'birth_date' => '2014-11-02',
                    'nationality' => 'Chilena',
                    'religion' => 'Católica',
                    'address' => 'Calle El Maitén #173',
                    'commune' => 'Máfil',
                    'phone' => '954548651',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => false,
                ],

                // 21
                [
                    'rut' => '24.688.112-k',
                    'first_name' => 'Pascal Ignacia',
                    'last_name_father' => 'Rojas',
                    'last_name_mother' => 'Rebolledo',
                    'gender' => 'Femenino',
                    'birth_date' => '2014-07-20',
                    'nationality' => 'Chilena',
                    'religion' => 'Otra',
                    'address' => 'Rinconada S/N',
                    'commune' => 'Máfil',
                    'phone' => '947536819',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => false,
                ],

                // 22
                [
                    'rut' => '24.868.405-4',
                    'first_name' => 'Sebastián Antonio',
                    'last_name_father' => 'Sepúlveda',
                    'last_name_mother' => 'Coronado',
                    'gender' => 'Masculino',
                    'birth_date' => '2015-01-17',
                    'nationality' => 'Chilena',
                    'religion' => 'Católica',
                    'address' => 'Runca S/N',
                    'commune' => 'Máfil',
                    'phone' => '995675988',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => true,
                ],

                // 23
                [
                    'rut' => '24.902.998-k',
                    'first_name' => 'Antonella Ignacia',
                    'last_name_father' => 'Valladares',
                    'last_name_mother' => 'Hidalgo',
                    'gender' => 'Femenino',
                    'birth_date' => '2015-02-17',
                    'nationality' => 'Chilena',
                    'religion' => 'Otra',
                    'address' => 'Parcela Lote 2B, Mulpun',
                    'commune' => 'Máfil',
                    'phone' => '958056633',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => false,
                ],

                // 24
                [
                    'rut' => '24.838.302-k',
                    'first_name' => 'Alison Pascal',
                    'last_name_father' => 'Vergara',
                    'last_name_mother' => 'Azúa',
                    'gender' => 'Femenino',
                    'birth_date' => '2014-12-27',
                    'nationality' => 'Chilena',
                    'religion' => 'Evangélica',
                    'address' => 'Colonia Iñaque, Huerto N°3',
                    'commune' => 'Máfil',
                    'phone' => '934904186',
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
