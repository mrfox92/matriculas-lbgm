<?php

namespace Database\Seeders\Legacy;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Student;
use App\Models\Enrollment;
use App\Models\Course;

class SextoBasico2025Seeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {

            $course = Course::whereHas('gradeLevel', fn ($q) =>
                $q->where('name', '6° Básico')
            )->where('school_year', 2026)->firstOrFail();

            $students = [

                // 1
                [
                    'rut' => '24.455.774-0',
                    'first_name' => 'Joaquín Eleaser',
                    'last_name_father' => 'Álvarez',
                    'last_name_mother' => 'Godoy',
                    'gender' => 'Masculino',
                    'birth_date' => '2013-11-15',
                    'nationality' => 'Chilena',
                    'religion' => 'Católica',
                    'address' => 'Población Libertad S/N',
                    'commune' => 'Máfil',
                    'phone' => '942642225',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => false,
                ],

                // 2
                [
                    'rut' => '24.388.963-4',
                    'first_name' => 'Yesenia Nicol',
                    'last_name_father' => 'Olivera',
                    'last_name_mother' => 'Berrocal',
                    'gender' => 'Femenino',
                    'birth_date' => '2013-09-29',
                    'nationality' => 'Chilena',
                    'religion' => 'Católica',
                    'address' => 'Balmaceda 796',
                    'commune' => 'Máfil',
                    'phone' => '935922744',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => true,
                ],

                // 3
                [
                    'rut' => '24.378.254-6',
                    'first_name' => 'Fernanda Seleni',
                    'last_name_father' => 'Bórquez',
                    'last_name_mother' => 'Santana',
                    'gender' => 'Femenino',
                    'birth_date' => '2013-08-28',
                    'nationality' => 'Chilena',
                    'religion' => 'Evangélica',
                    'address' => 'Predio Santa Laura Lote 1',
                    'commune' => 'Máfil',
                    'phone' => '95730754',
                    'indigenous' => null,
                    'health' => true,
                    'pie' => true,
                ],

                // 4
                [
                    'rut' => '24.525.828-3',
                    'first_name' => 'Karla Ignacia',
                    'last_name_father' => 'Burgos',
                    'last_name_mother' => 'Gallardo',
                    'gender' => 'Femenino',
                    'birth_date' => '2014-01-09',
                    'nationality' => 'Chilena',
                    'religion' => 'Católica',
                    'address' => 'Fundo Los Avellanos, Malinto',
                    'commune' => 'Máfil',
                    'phone' => '991274642',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => true,
                ],

                // 5
                [
                    'rut' => '24.008.121-0',
                    'first_name' => 'Florencia Ignacia',
                    'last_name_father' => 'Cárdenas',
                    'last_name_mother' => 'Barriga',
                    'gender' => 'Femenino',
                    'birth_date' => '2012-07-13',
                    'nationality' => 'Chilena',
                    'religion' => 'Evangélica',
                    'address' => 'Las Lomas, Fundo Brasil',
                    'commune' => 'Máfil',
                    'phone' => '987320290',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => false,
                ],

                // 6
                [
                    'rut' => '24.380.554-6',
                    'first_name' => 'Francisca Anaís',
                    'last_name_father' => 'Castillo',
                    'last_name_mother' => 'Quezada',
                    'gender' => 'Femenino',
                    'birth_date' => '2013-09-05',
                    'nationality' => 'Chilena',
                    'religion' => 'Católica',
                    'address' => 'Villa Entre Ríos, Rucapichiu',
                    'commune' => 'Máfil',
                    'phone' => '982278325',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => false,
                ],

                // 7
                [
                    'rut' => '24.451.221-6',
                    'first_name' => 'Richard Andrés',
                    'last_name_father' => 'Cerna',
                    'last_name_mother' => 'Chavol',
                    'gender' => 'Masculino',
                    'birth_date' => '2013-11-09',
                    'nationality' => 'Chilena',
                    'religion' => 'Evangélica',
                    'address' => 'Fundo Las Lomas',
                    'commune' => 'Máfil',
                    'phone' => '971393861',
                    'indigenous' => 'Mapuche',
                    'health' => false,
                    'pie' => false,
                ],

                // 8
                [
                    'rut' => '24.315.565-7',
                    'first_name' => 'Emilio Cristóbal',
                    'last_name_father' => 'Coronado',
                    'last_name_mother' => 'Sepúlveda',
                    'gender' => 'Masculino',
                    'birth_date' => '2013-06-20',
                    'nationality' => 'Chilena',
                    'religion' => 'Evangélica',
                    'address' => 'Villa San Luis 145, Runca',
                    'commune' => 'Máfil',
                    'phone' => '995082520',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => true,
                ],

                // 9
                [
                    'rut' => '24.428.346-2',
                    'first_name' => 'Emmanuel Andrés',
                    'last_name_father' => 'Espinoza',
                    'last_name_mother' => 'Salazar',
                    'gender' => 'Masculino',
                    'birth_date' => '2013-10-23',
                    'nationality' => 'Chilena',
                    'religion' => 'Evangélica',
                    'address' => 'Vera Meneses #38',
                    'commune' => 'Máfil',
                    'phone' => '999293757',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => false,
                ],

                // 10
                [
                    'rut' => '24.596.666-0',
                    'first_name' => 'Paz Alondra',
                    'last_name_father' => 'Flandez',
                    'last_name_mother' => 'Carrillo',
                    'gender' => 'Femenino',
                    'birth_date' => '2014-04-06',
                    'nationality' => 'Chilena',
                    'religion' => 'Evangélica',
                    'address' => 'Molco S/N',
                    'commune' => 'Máfil',
                    'phone' => '948697206',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => true,
                ],

                // 11
                [
                    'rut' => '24.483.703-4',
                    'first_name' => 'Emely',
                    'last_name_father' => 'Ebolett',
                    'last_name_mother' => null,
                    'gender' => 'Femenino',
                    'birth_date' => '2013-12-02',
                    'nationality' => 'Chilena',
                    'religion' => 'Evangélica',
                    'address' => 'La Traca N°88',
                    'commune' => 'Máfil',
                    'phone' => '983117318',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => false,
                ],

                // 12
                [
                    'rut' => '24.624.206-2',
                    'first_name' => 'Antonia Elena',
                    'last_name_father' => 'Inostroza',
                    'last_name_mother' => 'Cabezas',
                    'gender' => 'Femenino',
                    'birth_date' => '2014-05-17',
                    'nationality' => 'Chilena',
                    'religion' => 'Católica',
                    'address' => 'Pedro de Valdivia 168',
                    'commune' => 'Máfil',
                    'phone' => '95659983',
                    'indigenous' => null,
                    'health' => true,
                    'pie' => false,
                ],

                // 13
                [
                    'rut' => '24.234.004-3',
                    'first_name' => 'Fernando Gustavo',
                    'last_name_father' => 'Leal',
                    'last_name_mother' => 'Muñoz',
                    'gender' => 'Masculino',
                    'birth_date' => '2013-03-31',
                    'nationality' => 'Chilena',
                    'religion' => 'Católica',
                    'address' => 'Sector San Pedro, Chihuao',
                    'commune' => 'Máfil',
                    'phone' => '940705888',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => true,
                ],

                // 14
                [
                    'rut' => '24.541.700-4',
                    'first_name' => 'Antonia Fernanda',
                    'last_name_father' => 'Maldonado',
                    'last_name_mother' => 'Bascuñán',
                    'gender' => 'Femenino',
                    'birth_date' => '2014-02-14',
                    'nationality' => 'Chilena',
                    'religion' => 'Evangélica',
                    'address' => 'Mulpun, Haras Militar S/N',
                    'commune' => 'Máfil',
                    'phone' => '981696197',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => false,
                ],

                // 15
                [
                    'rut' => '24.449.906-6',
                    'first_name' => 'Martín Alexis',
                    'last_name_father' => 'Matus',
                    'last_name_mother' => 'Milling',
                    'gender' => 'Masculino',
                    'birth_date' => '2013-11-08',
                    'nationality' => 'Chilena',
                    'religion' => 'Evangélica',
                    'address' => 'Villa Las Palmeras 193',
                    'commune' => 'Máfil',
                    'phone' => '987022487',
                    'indigenous' => null,
                    'health' => true,
                    'pie' => true,
                ],

                // 16
                [
                    'rut' => '24.270.925-k',
                    'first_name' => 'Kamila Belén',
                    'last_name_father' => 'Meneses',
                    'last_name_mother' => 'Antillanca',
                    'gender' => 'Femenino',
                    'birth_date' => '2013-05-06',
                    'nationality' => 'Chilena',
                    'religion' => 'Evangélica',
                    'address' => 'Linguiento',
                    'commune' => 'Máfil',
                    'phone' => '956873554',
                    'indigenous' => 'Mapuche',
                    'health' => false,
                    'pie' => true,
                ],

                // 17
                [
                    'rut' => '24.276.425-0',
                    'first_name' => 'José Eduardo',
                    'last_name_father' => 'Molina',
                    'last_name_mother' => 'Valderas',
                    'gender' => 'Masculino',
                    'birth_date' => '2013-05-11',
                    'nationality' => 'Chilena',
                    'religion' => null,
                    'address' => 'Fundo Collahue',
                    'commune' => 'Máfil',
                    'phone' => '927513077',
                    'indigenous' => 'Mapuche',
                    'health' => false,
                    'pie' => false,
                ],

                // 18
                [
                    'rut' => '24.581.835-1',
                    'first_name' => 'Damián Alexander',
                    'last_name_father' => 'Osorio',
                    'last_name_mother' => 'Moraga',
                    'gender' => 'Masculino',
                    'birth_date' => '2014-03-29',
                    'nationality' => 'Chilena',
                    'religion' => 'Evangélica',
                    'address' => 'Los Troncos 43B, Linguiento Runca',
                    'commune' => 'Máfil',
                    'phone' => '936982725',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => false,
                ],

                // 19
                [
                    'rut' => '24.289.617-3',
                    'first_name' => 'Amy Anthonella',
                    'last_name_father' => 'Rodríguez',
                    'last_name_mother' => 'Pinto',
                    'gender' => 'Femenino',
                    'birth_date' => '2013-05-30',
                    'nationality' => 'Chilena',
                    'religion' => 'Católica',
                    'address' => 'Sector Linguiento, Camino Los Troncos Parcela 19',
                    'commune' => 'Máfil',
                    'phone' => '989600582',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => false,
                ],

                // 20
                [
                    'rut' => '24.316.228-9',
                    'first_name' => 'Sebastián Alejandro',
                    'last_name_father' => 'Rojas',
                    'last_name_mother' => 'Rebolledo',
                    'gender' => 'Masculino',
                    'birth_date' => '2013-06-27',
                    'nationality' => 'Chilena',
                    'religion' => 'Católica',
                    'address' => 'Pidey S/N',
                    'commune' => 'Máfil',
                    'phone' => '947536819',
                    'indigenous' => 'Mapuche',
                    'health' => false,
                    'pie' => true,
                ],

                // 21
                [
                    'rut' => '24.353.813-0',
                    'first_name' => 'José Patricio',
                    'last_name_father' => 'Subiabre',
                    'last_name_mother' => 'Pinto',
                    'gender' => 'Masculino',
                    'birth_date' => '2013-06-18',
                    'nationality' => 'Chilena',
                    'religion' => 'Evangélica',
                    'address' => 'Fundo Los Maitenes S/N',
                    'commune' => 'Máfil',
                    'phone' => '940750532',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => true,
                ],

                // 22
                [
                    'rut' => '24.300.744-5',
                    'first_name' => 'Isidora Pascale',
                    'last_name_father' => 'Vargas',
                    'last_name_mother' => 'Guzmán',
                    'gender' => 'Femenino',
                    'birth_date' => '2013-06-11',
                    'nationality' => 'Chilena',
                    'religion' => 'Católica',
                    'address' => 'Huilón, Santa Elena S/N',
                    'commune' => 'Máfil',
                    'phone' => '933552449',
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
