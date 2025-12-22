<?php

namespace Database\Seeders\Legacy;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Student;
use App\Models\Enrollment;
use App\Models\Course;

class TerceroMedioTPProgramacion2025Seeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {

            // Curso 3° Medio TP Programación – año escolar 2026
            $course = Course::whereHas('gradeLevel', function ($q) {
                $q->where('name', '3° Medio');
            })
                ->where('specialty', 'TP Programación')
                ->where('school_year', 2026)
                ->firstOrFail();

            $students = [

                [
                    'rut' => '22.847.919-5',
                    'first_name' => 'Jael Mateo',
                    'last_name_father' => 'Arias',
                    'last_name_mother' => 'Cárdenas',
                    'gender' => 'Masculino',
                    'birth_date' => '2008-10-12',
                    'nationality' => 'Chilena',
                    'religion' => 'Católica',
                    'address' => 'Calle Runca S/N',
                    'commune' => 'Máfil',
                    'phone' => '974304634',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => false,
                ],
                [
                    'rut' => '23.021.517-0',
                    'first_name' => 'Damián Rodrigo Ariel',
                    'last_name_father' => 'Aravena',
                    'last_name_mother' => 'Castro',
                    'gender' => 'Masculino',
                    'birth_date' => '2009-05-16',
                    'nationality' => 'Chilena',
                    'religion' => 'Evangélica',
                    'address' => 'Sector Quesquechan, Fundo Junco',
                    'commune' => 'Máfil',
                    'phone' => '997472841',
                    'indigenous' => 'Mapuche',
                    'health' => false,
                    'pie' => false,
                ],
                [
                    'rut' => '22.659.373-k',
                    'first_name' => 'Miguel Francisco',
                    'last_name_father' => 'Bastian',
                    'last_name_mother' => 'Leal',
                    'gender' => 'Masculino',
                    'birth_date' => '2008-03-03',
                    'nationality' => 'Chilena',
                    'religion' => 'Católica',
                    'address' => 'Las Palmeras 185',
                    'commune' => 'Máfil',
                    'phone' => '947727306',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => true,
                ],
                [
                    'rut' => '22.874.670-3',
                    'first_name' => 'Diego Hernán',
                    'last_name_father' => 'Briones',
                    'last_name_mother' => 'Higuera',
                    'gender' => 'Masculino',
                    'birth_date' => '2008-11-17',
                    'nationality' => 'Chilena',
                    'religion' => 'Católica',
                    'address' => 'El Rauli #260',
                    'commune' => 'Máfil',
                    'phone' => '997381464',
                    'indigenous' => null,
                    'health' => true,
                    'pie' => false,
                ],
                [
                    'rut' => '22.736.291-k',
                    'first_name' => 'Cristopher Alexander',
                    'last_name_father' => 'Díaz',
                    'last_name_mother' => 'Soto',
                    'gender' => 'Masculino',
                    'birth_date' => '2008-06-02',
                    'nationality' => 'Chilena',
                    'religion' => 'Ninguna',
                    'address' => 'Fundo Putabla S/N',
                    'commune' => 'Máfil',
                    'phone' => '958855418',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => false,
                ],
                [
                    'rut' => '22.779.981-1',
                    'first_name' => 'Mathias Benjamín',
                    'last_name_father' => 'Duarte',
                    'last_name_mother' => 'Garridos',
                    'gender' => 'Masculino',
                    'birth_date' => '2008-07-29',
                    'nationality' => 'Chilena',
                    'religion' => 'Católica',
                    'address' => 'Parcelas N°12, Iñaque',
                    'commune' => 'Máfil',
                    'phone' => '977558360',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => false,
                ],
                [
                    'rut' => '22.991.800-1',
                    'first_name' => 'Luis Mario',
                    'last_name_father' => 'Henríquez',
                    'last_name_mother' => 'Alvarado',
                    'gender' => 'Masculino',
                    'birth_date' => '2009-04-08',
                    'nationality' => 'Chilena',
                    'religion' => 'Ninguna',
                    'address' => 'Fundo Las Palomas',
                    'commune' => 'Máfil',
                    'phone' => '974119972',
                    'indigenous' => null,
                    'health' => true,
                    'pie' => false,
                ],
                [
                    'rut' => '22.175.529-4',
                    'first_name' => 'Ignacio Andrés',
                    'last_name_father' => 'Márquez',
                    'last_name_mother' => 'Bustos',
                    'gender' => 'Masculino',
                    'birth_date' => '2006-08-03',
                    'nationality' => 'Chilena',
                    'religion' => 'Católica',
                    'address' => 'Los Copihues 50',
                    'commune' => 'Máfil',
                    'phone' => '936174000',
                    'indigenous' => null,
                    'health' => true,
                    'pie' => true,
                ],
                [
                    'rut' => '22.800.046-9',
                    'first_name' => 'Maximiliano Elías',
                    'last_name_father' => 'Santana',
                    'last_name_mother' => 'Aedo',
                    'gender' => 'Masculino',
                    'birth_date' => '2008-08-01',
                    'nationality' => 'Chilena',
                    'religion' => 'Evangélica',
                    'address' => 'Runca, Laguna Los Patos',
                    'commune' => 'Máfil',
                    'phone' => '982745621',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => false,
                ],
                [
                    'rut' => '22.797.891-0',
                    'first_name' => 'Jair Israel',
                    'last_name_father' => 'Solís',
                    'last_name_mother' => 'Muñoz',
                    'gender' => 'Masculino',
                    'birth_date' => '2008-09-16',
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
                    'rut' => '22.946.413-2',
                    'first_name' => 'Cristopher Ignacio',
                    'last_name_father' => 'Soto',
                    'last_name_mother' => 'Díaz',
                    'gender' => 'Masculino',
                    'birth_date' => '2009-01-23',
                    'nationality' => 'Chilena',
                    'religion' => 'Católica',
                    'address' => 'Huillón, Parcela Los Aromos',
                    'commune' => 'Máfil',
                    'phone' => '977055466',
                    'indigenous' => null,
                    'health' => false,
                    'pie' => false,
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

            /*
             |--------------------------------------------------------------------------
             | NOTA IMPORTANTE
             |--------------------------------------------------------------------------
             | Falta agregar la ficha del estudiante:
             | - Benjamín Cabrera
             | No se encontró información en las planillas originales.
             | Con él, el curso tendría un total de 12 estudiantes.
             |
             */

        });
    }
}
