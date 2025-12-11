<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;

class StudentTestSeeder extends Seeder
{
    public function run(): void
    {
        $students = [
            ['24.111.111-1', 'Benjamín', 'Lagos', 'Muñoz', 'Masculino'],
            ['24.111.111-2', 'Antonia', 'Vera', 'Ortiz', 'Femenino'],
            ['24.111.111-3', 'Martín', 'Paredes', 'Guzmán', 'Masculino'],
            ['24.111.111-4', 'Valentina', 'Salinas', 'Bravo', 'Femenino'],
            ['24.111.111-5', 'Tomás', 'Rivas', 'Castro', 'Masculino'],

            ['24.111.111-6', 'Isidora', 'Alarcón', 'Díaz', 'Femenino'],
            ['24.111.111-7', 'Sebastián', 'Araya', 'Torres', 'Masculino'],
            ['24.111.111-8', 'Josefa', 'Carrillo', 'Morales', 'Femenino'],
            ['24.111.111-9', 'Cristóbal', 'Navarro', 'Hernández', 'Masculino'],
            ['24.111.112-0', 'Maite', 'Campos', 'Acuña', 'Femenino'],

            ['26.222.222-1', 'Diego', 'Soto', 'Vidal', 'Masculino'],
            ['26.222.222-2', 'Camila', 'Moreno', 'Bravo', 'Femenino'],
            ['26.222.222-3', 'Tomás', 'Aguilar', 'Reyes', 'Masculino'],
            ['26.222.222-4', 'Josefa', 'López', 'Castillo', 'Femenino'],
            ['26.222.222-5', 'Ignacio', 'Hidalgo', 'Lara', 'Masculino'],

            ['26.222.222-6', 'Florencia', 'Garrido', 'Meza', 'Femenino'],
            ['26.222.222-7', 'Lucas', 'Ramírez', 'Oyarzo', 'Masculino'],
            ['26.222.222-8', 'Emilia', 'Cáceres', 'Sanhueza', 'Femenino'],
            ['26.222.222-9', 'Agustín', 'Gómez', 'Lobos', 'Masculino'],
            ['26.222.223-0', 'Javiera', 'Pino', 'Zúñiga', 'Femenino'],
        ];

        foreach ($students as $i => $s) {

            Student::firstOrCreate(
                ['rut' => $s[0]],
                [
                    'first_name' => $s[1],
                    'last_name_father' => $s[2],
                    'last_name_mother' => $s[3],
                    'gender' => $s[4],
                    'birth_date' => now()->subYears(8 + ($i % 6))->subDays(rand(10,200)),
                    'nationality' => 'Chilena',
                    'religion' => ['Católica','Evangélica','Ninguna'][rand(0,2)],

                    'address' => 'Calle Principal #' . rand(100,999),
                    'commune' => 'Máfil',
                    'phone' => '+569' . rand(30000000,39999999),
                    'emergency_phone' => '+569' . rand(40000000,49999999),

                    'indigenous_ancestry' => rand(0,1),
                    'indigenous_ancestry_type' => null,

                    'has_health_issues' => rand(0,1),
                    'health_issues_details' => null,
                ]
            );
        }
    }
}
