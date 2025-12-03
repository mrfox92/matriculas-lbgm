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
            ['rut' => '24.111.111-1', 'first_name' => 'Benjamín', 'last_name_father' => 'Lagos', 'last_name_mother' => 'Muñoz'],
            ['rut' => '24.111.111-2', 'first_name' => 'Antonia',  'last_name_father' => 'Vera',  'last_name_mother' => 'Ortiz'],
            ['rut' => '24.111.111-3', 'first_name' => 'Martín',   'last_name_father' => 'Ovando','last_name_mother' => 'Sepúlveda'],
            ['rut' => '24.111.111-4', 'first_name' => 'Valentina','last_name_father' => 'Caro',  'last_name_mother' => 'Guzmán'],
            ['rut' => '24.111.111-5', 'first_name' => 'Joaquín',  'last_name_father' => 'Pérez', 'last_name_mother' => 'Gallardo'],

            // Nuevos
            ['rut' => '26.222.222-1', 'first_name' => 'Diego',    'last_name_father' => 'Soto',  'last_name_mother' => 'Vidal'],
            ['rut' => '26.222.222-2', 'first_name' => 'Camila',   'last_name_father' => 'Moreno','last_name_mother' => 'Bravo'],
            ['rut' => '26.222.222-3', 'first_name' => 'Tomás',    'last_name_father' => 'Aguilar','last_name_mother' => 'Reyes'],
            ['rut' => '26.222.222-4', 'first_name' => 'Josefa',   'last_name_father' => 'López', 'last_name_mother' => 'Castillo'],
            ['rut' => '26.222.222-5', 'first_name' => 'Ignacio',  'last_name_father' => 'Hidalgo','last_name_mother' => 'Lara'],
        ];

        foreach ($students as $s) {
            Student::firstOrCreate([
                'rut' => $s['rut']
            ], [
                'first_name' => $s['first_name'],
                'last_name_father' => $s['last_name_father'],
                'last_name_mother' => $s['last_name_mother'],
                'address' => "Calle Río 456",
                'city' => "Máfil",
                'phone_mobile' => "+56922222222",
            ]);
        }
    }
}
