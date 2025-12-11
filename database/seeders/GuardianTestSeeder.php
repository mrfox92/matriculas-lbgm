<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Guardian;

class GuardianTestSeeder extends Seeder
{
    public function run(): void
    {
        $guardians = [
            ['9.111.111-1', 'Carolina', 'Muñoz', 'Figueroa', 'Femenino'],
            ['7.222.222-2', 'Pedro', 'Soto', 'Gómez', 'Masculino'],
            ['6.333.333-3', 'Andrea', 'Vega', 'Paredes', 'Femenino'],
            ['8.444.444-4', 'Miguel', 'Cares', 'Muñoz', 'Masculino'],
            ['5.555.555-5', 'Verónica', 'Alarcón', 'Romero', 'Femenino'],

            ['17.666.666-6', 'Claudia', 'Vásquez', 'Villanueva', 'Femenino'],
            ['16.777.777-7', 'Rodrigo', 'Pinto', 'Campos', 'Masculino'],
            ['12.888.888-8', 'Macarena', 'Cáceres', 'Sanhueza', 'Femenino'],
            ['13.999.999-9', 'Felipe', 'Garrido', 'Meza', 'Masculino'],
            ['15.101.010-1', 'Paula', 'Cáceres', 'Díaz', 'Femenino'],

            ['18.202.202-2', 'Ximena', 'Ruiz', 'Fernández', 'Femenino'],
            ['14.303.303-3', 'Claudio', 'Rivas', 'Rocha', 'Masculino'],
            ['19.404.404-4', 'Daniela', 'Espinoza', 'Mora', 'Femenino'],
            ['22.505.505-5', 'Héctor', 'Quintana', 'Mella', 'Masculino'],
            ['10.606.606-6', 'Natalia', 'Orellana', 'Bustamante', 'Femenino'],

            ['11.707.707-7', 'Pablo', 'Campos', 'Riveros', 'Masculino'],
            ['20.808.808-8', 'Marcela', 'Sandoval', 'Valdés', 'Femenino'],
            ['21.909.909-9', 'Raúl', 'Méndez', 'Carvajal', 'Masculino'],
            ['13.010.101-0', 'Gabriela', 'Toro', 'Yáñez', 'Femenino'],
            ['14.020.202-1', 'Cristian', 'López', 'Bustamante', 'Masculino'],
        ];

        foreach ($guardians as $g) {
            Guardian::firstOrCreate(
                ['rut' => $g[0]],
                [
                    'first_name' => $g[1],
                    'last_name_father' => $g[2],
                    'last_name_mother' => $g[3],
                    'gender' => $g[4],
                    'birth_date' => now()->subYears(rand(28,55)),

                    'address' => 'Villa Los Robles #' . rand(10,200),
                    'commune' => 'Máfil',
                    'phone' => '+569' . rand(50000000,59999999),
                    'emergency_phone' => '+569' . rand(60000000,69999999),

                    'education_level' => 'Media completa',
                    'employment_status' => 'Empleado',
                    'work_main_place' => 'Fuera del hogar',
                    'workplace' => 'Empresa Servicios',
                    'work_phone' => '+566322' . rand(1000,9999),

                    'authorized_to_pickup' => true,
                ]
            );
        }
    }
}
