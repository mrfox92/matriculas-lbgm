<?php

namespace Database\Seeders\Legacy;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Student;
use App\Models\Enrollment;
use App\Models\Course;

class TerceroMedioTPParvulos2025Seeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {

            // Curso 3° Medio TP Párvulos – año escolar 2026
            $course = Course::whereHas('gradeLevel', function ($q) {
                $q->where('name', '3° Medio');
            })
                ->where('specialty', 'TP Atención de Párvulos')
                ->where('school_year', 2026)
                ->firstOrFail();

            $students = [

                /* =====================================================
                 * BLOQUE 1 (1–8)
                 * ===================================================== */

                [
                    'rut' => '22.802.683-2',
                    'first_name' => 'Angeline Victoria',
                    'last_name_father' => 'Lara',
                    'last_name_mother' => 'Pérez',
                    'gender' => 'Femenino',
                    'birth_date' => '2008-08-25',
                    'nationality' => 'Chilena',
                    'religion' => 'Ninguna',
                    'address' => 'Villa Austral, Calle Puerto Cisne 422',
                    'commune' => 'Valdivia',
                    'phone' => '929053829',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => false,
                ],
                [
                    'rut' => '22.898.459-0',
                    'first_name' => 'Valentina Dianette',
                    'last_name_father' => 'López',
                    'last_name_mother' => 'López',
                    'gender' => 'Femenino',
                    'birth_date' => '2008-12-16',
                    'nationality' => 'Chilena',
                    'religion' => 'Evangélica',
                    'address' => 'Av. Pedro de Valdivia',
                    'commune' => 'Máfil',
                    'phone' => '975569769',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => false,
                ],
                [
                    'rut' => '22.997.298-8',
                    'first_name' => 'Martina Monserrat',
                    'last_name_father' => 'Gutiérrez',
                    'last_name_mother' => 'Barriga',
                    'gender' => 'Femenino',
                    'birth_date' => '2009-03-14',
                    'nationality' => 'Chilena',
                    'religion' => 'Evangélica',
                    'address' => 'Las Lomas, Fundo Brasil S/N',
                    'commune' => 'Máfil',
                    'phone' => '9873220290',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => false,
                ],
                [
                    'rut' => '22.762.363-2',
                    'first_name' => 'Vania Paulina',
                    'last_name_father' => 'Muñoz',
                    'last_name_mother' => 'Cárdenas',
                    'gender' => 'Femenino',
                    'birth_date' => '2008-07-04',
                    'nationality' => 'Chilena',
                    'religion' => 'Católica',
                    'address' => 'Germán Furhop S/N',
                    'commune' => 'Máfil',
                    'phone' => '966076290',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => true,
                ],
                [
                    'rut' => '22.858.611-0',
                    'first_name' => 'Dayana Sarai',
                    'last_name_father' => 'Cares',
                    'last_name_mother' => 'Alvarado',
                    'gender' => 'Femenino',
                    'birth_date' => '2008-10-30',
                    'nationality' => 'Chilena',
                    'religion' => 'Evangélica',
                    'address' => 'Blanco Encalada S/N',
                    'commune' => 'Máfil',
                    'phone' => null,
                    'indigenous' => null,
                    'health' => true,
                    'pie' => true,
                ],
                [
                    'rut' => '22.531.814-k',
                    'first_name' => 'Catalina Ignacia',
                    'last_name_father' => 'Cárdenas',
                    'last_name_mother' => 'Pérez',
                    'gender' => 'Femenino',
                    'birth_date' => '2007-10-22',
                    'nationality' => 'Chilena',
                    'religion' => 'Católica',
                    'address' => 'Villa Los Alcaldes, Pasaje Angelino Leal 141, Máfil',
                    'commune' => 'Máfil',
                    'phone' => '996970626',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => false,
                ],
                [
                    'rut' => '22.480.539-k',
                    'first_name' => 'Hansel David',
                    'last_name_father' => 'Duarte',
                    'last_name_mother' => 'Milling',
                    'gender' => 'Masculino',
                    'birth_date' => '2007-08-08',
                    'nationality' => 'Chilena',
                    'religion' => 'Evangélica',
                    'address' => 'Villa Los Castaños, Víctor Soto Briceño',
                    'commune' => 'Máfil',
                    'phone' => '953272873',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => true,
                ],
                [
                    'rut' => '22.803.778-8',
                    'first_name' => 'Antonella Almendra',
                    'last_name_father' => 'Escobar',
                    'last_name_mother' => 'Cañoles',
                    'gender' => 'Femenino',
                    'birth_date' => '2008-08-24',
                    'nationality' => 'Chilena',
                    'religion' => 'Ninguna',
                    'address' => 'Santa Elena K1',
                    'commune' => 'Máfil',
                    'phone' => '935337977',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => false,
                ],

                /* =====================================================
                 * BLOQUE 2 (9–17)
                 * ===================================================== */

                [
                    'rut' => '22.521.070-5',
                    'first_name' => 'Marisela Araceli',
                    'last_name_father' => 'Grandon',
                    'last_name_mother' => 'Salinas',
                    'gender' => 'Femenino',
                    'birth_date' => '2007-10-03',
                    'nationality' => 'Chilena',
                    'religion' => 'Ninguna',
                    'address' => 'Sector Rinconada S/N',
                    'commune' => 'Máfil',
                    'phone' => '9651008729',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => false,
                ],
                [
                    'rut' => '22.961.064-3',
                    'first_name' => 'Janiss Anahiss',
                    'last_name_father' => 'Henríquez',
                    'last_name_mother' => 'Vergara',
                    'gender' => 'Femenino',
                    'birth_date' => '2009-02-28',
                    'nationality' => 'Chilena',
                    'religion' => 'Católica',
                    'address' => 'Villa Las Palmeras, Pasaje L.P. #179',
                    'commune' => 'Máfil',
                    'phone' => '986959936',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => true,
                ],
                [
                    'rut' => '22.901.856-6',
                    'first_name' => 'Franchesca Yanara',
                    'last_name_father' => 'Herrera',
                    'last_name_mother' => 'Chico',
                    'gender' => 'Femenino',
                    'birth_date' => '2008-12-03',
                    'nationality' => 'Chilena',
                    'religion' => 'Evangélica',
                    'address' => 'Sector Linguiento, Máfil',
                    'commune' => 'Máfil',
                    'phone' => '956017744',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => false,
                ],
                [
                    'rut' => '22.263.875-5',
                    'first_name' => 'Paz Almendra',
                    'last_name_father' => 'Loaiza',
                    'last_name_mother' => 'Gallegos',
                    'gender' => 'Femenino',
                    'birth_date' => '2006-10-18',
                    'nationality' => 'Chilena',
                    'religion' => 'Evangélica',
                    'address' => 'Las Palmeras #225',
                    'commune' => 'Máfil',
                    'phone' => '979003861',
                    'indigenous' => null,
                    'health' => true,
                    'pie' => true,
                ],
                [
                    'rut' => '22.998.463-2',
                    'first_name' => 'Alejandra Andrea',
                    'last_name_father' => 'Meneses',
                    'last_name_mother' => 'Antillanca',
                    'gender' => 'Femenino',
                    'birth_date' => '2009-04-15',
                    'nationality' => 'Chilena',
                    'religion' => 'Católica',
                    'address' => 'Sector Linguiento, Máfil',
                    'commune' => 'Máfil',
                    'phone' => '956873554',
                    'indigenous' => 'Mapuche',
                    'health' => false,
                    'pie' => true,
                ],
                [
                    'rut' => '22.907.554-3',
                    'first_name' => 'Martina Antonella',
                    'last_name_father' => 'Peña',
                    'last_name_mother' => 'Molina',
                    'gender' => 'Femenino',
                    'birth_date' => '2008-12-26',
                    'nationality' => 'Chilena',
                    'religion' => 'Evangélica',
                    'address' => 'Pobl. Arboleda, Calle Juan 23 N°4',
                    'commune' => 'Máfil',
                    'phone' => '938962316',
                    'indigenous' => null,
                    'health' => true,
                    'pie' => false,
                ],
                [
                    'rut' => '22.892.901-8',
                    'first_name' => 'Tatiana del Carmen',
                    'last_name_father' => 'Quichel',
                    'last_name_mother' => 'Parra',
                    'gender' => 'Femenino',
                    'birth_date' => '2008-11-18',
                    'nationality' => 'Chilena',
                    'religion' => 'Católica',
                    'address' => 'B. O’Higgins 340',
                    'commune' => 'Máfil',
                    'phone' => '945324818',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => false,
                ],
                [
                    'rut' => '23.002.354-9',
                    'first_name' => 'Sigrid Alexandra',
                    'last_name_father' => 'Vallejos',
                    'last_name_mother' => 'Matus',
                    'gender' => 'Femenino',
                    'birth_date' => '2009-04-21',
                    'nationality' => 'Chilena',
                    'religion' => 'Católica',
                    'address' => 'Folilco S/N',
                    'commune' => 'Máfil',
                    'phone' => '995043334',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => false,
                ],
                [
                    'rut' => '22.573.052-0',
                    'first_name' => 'Clarita Antonia',
                    'last_name_father' => 'Vergara',
                    'last_name_mother' => 'Ruiz',
                    'gender' => 'Femenino',
                    'birth_date' => '2007-11-27',
                    'nationality' => 'Chilena',
                    'religion' => 'Evangélica',
                    'address' => 'Psje Monte Grande #34, Villa Porvenir',
                    'commune' => 'Máfil',
                    'phone' => '937588808',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => true,
                ],
            ];

            foreach ($students as $s) {

                $student = Student::firstOrCreate(
                    ['rut' => strtolower(trim($s['rut']))],
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
                        'has_health_issues' => $s['health'],
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
