<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Guardian;

class GuardianTestSeeder extends Seeder
{
    public function run(): void
    {
        $guardianes = [
            [
                'rut' => '9.111.111-1',
                'first_name' => 'Carolina',
                'last_name_father' => 'Muñoz',
                'last_name_mother' => 'Figueroa',
                'gender' => 'Femenino',
                'birth_date' => '1985-03-22',

                'address' => 'Sector Mulpun S/N',
                'commune' => 'Máfil',
                'phone' => '+56991110000',
                'emergency_phone' => '+56995550000',

                'education_level' => 'Media completa',
                'employment_status' => 'Dueña de casa',
                'work_main_place' => 'En el hogar',
                'workplace' => null,
                'work_phone' => null,
            ],

            [
                'rut' => '7.222.222-2',
                'first_name' => 'Pedro',
                'last_name_father' => 'Soto',
                'last_name_mother' => 'Gómez',
                'gender' => 'Masculino',
                'birth_date' => '1980-02-11',

                'address' => 'Sector Huillón S/N',
                'commune' => 'Máfil',
                'phone' => '+56972220000',
                'emergency_phone' => '+56978880000',

                'education_level' => 'Profesional',
                'employment_status' => 'Empleado',
                'work_main_place' => 'Fuera del hogar',
                'workplace' => 'Constructora Los Ríos',
                'work_phone' => '+56632233445',
            ],

            [
                'rut' => '6.333.333-3',
                'first_name' => 'Andrea',
                'last_name_father' => 'Vega',
                'last_name_mother' => 'Paredes',
                'gender' => 'Femenino',
                'birth_date' => '1983-10-14',

                'address' => 'Población Los Aromos 234',
                'commune' => 'Máfil',
                'phone' => '+56963330000',
                'emergency_phone' => '+56969990000',

                'education_level' => 'Técnico nivel medio',
                'employment_status' => 'Independiente',
                'work_main_place' => 'Fuera del hogar',
                'workplace' => 'Atención estética',
                'work_phone' => '+56961112222',
            ],
        ];

        foreach ($guardianes as $g) {
            Guardian::firstOrCreate(['rut' => $g['rut']], $g);
        }
    }
}
