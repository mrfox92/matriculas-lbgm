<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;

class StudentTestSeeder extends Seeder
{
    public function run(): void
    {
        $students = [
            // Antiguos
            [
                'rut' => '24.111.111-1',
                'first_name' => 'Benjamín',
                'last_name_father' => 'Lagos',
                'last_name_mother' => 'Muñoz',

                'gender' => 'Masculino',
                'birth_date' => '2014-05-11',
                'nationality' => 'Chilena',
                'religion' => 'Católica',

                'address' => 'Sector Mulpun S/N',
                'commune' => 'Máfil',
                'phone' => '+56924440000',
                'emergency_phone' => '+56920000000',

                'indigenous_ancestry' => false,
                'indigenous_ancestry_type' => null,

                // OJO: nombres alineados a la tabla actual
                'has_health_issues' => false,
                'health_issues_details' => null,
            ],

            [
                'rut' => '24.111.111-2',
                'first_name' => 'Antonia',
                'last_name_father' => 'Vera',
                'last_name_mother' => 'Ortiz',

                'gender' => 'Femenino',
                'birth_date' => '2013-09-23',
                'nationality' => 'Chilena',
                'religion' => 'Evangélica',

                'address' => 'Población Las Lumas 33',
                'commune' => 'Máfil',
                'phone' => '+56924440001',
                'emergency_phone' => '+56920000001',

                'indigenous_ancestry' => false,
                'indigenous_ancestry_type' => null,

                'has_health_issues' => false,
                'health_issues_details' => null,
            ],

            
        ];

        foreach ($students as $s) {
            Student::firstOrCreate(['rut' => $s['rut']], $s);
        }
    }
}
