<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Guardian;

class GuardianTestSeeder extends Seeder
{
    public function run(): void
    {
        $guardianes = [
            ['rut' => '9.111.111-1',  'first_name' => 'Carolina', 'last_name_father' => 'Muñoz', 'last_name_mother' => 'Figueroa'],
            ['rut' => '7.222.222-2',  'first_name' => 'Pedro',    'last_name_father' => 'Soto',  'last_name_mother' => 'Gómez'],
            ['rut' => '6.333.333-3',  'first_name' => 'Andrea',   'last_name_father' => 'Vega',  'last_name_mother' => 'Paredes'],
            ['rut' => '8.444.444-4',  'first_name' => 'Miguel',   'last_name_father' => 'Cares', 'last_name_mother' => 'Muñoz'],
            ['rut' => '5.555.555-5',  'first_name' => 'Verónica', 'last_name_father' => 'Alarcón','last_name_mother' => 'Romero'],

            ['rut' => '17.666.666-6', 'first_name' => 'Claudia',  'last_name_father' => 'Vásquez','last_name_mother' => 'Villanueva'],
            ['rut' => '16.777.777-7', 'first_name' => 'Rodrigo',  'last_name_father' => 'Pinto', 'last_name_mother' => 'Campos'],
            ['rut' => '12.888.888-8', 'first_name' => 'Macarena', 'last_name_father' => 'Cáceres','last_name_mother' => 'Sanhueza'],
            ['rut' => '13.999.999-9', 'first_name' => 'Felipe',   'last_name_father' => 'Garrido','last_name_mother' => 'Meza'],
            ['rut' => '15.101.010-1', 'first_name' => 'Paula',    'last_name_father' => 'Cáceres','last_name_mother' => 'Díaz'],
        ];

        foreach ($guardianes as $g) {
            Guardian::firstOrCreate([
                'rut' => $g['rut']
            ], [
                'first_name' => $g['first_name'],
                'last_name_father' => $g['last_name_father'],
                'last_name_mother' => $g['last_name_mother'],
                'gender' => 'Femenino',
                'address' => "Calle Falsa 123",
                'city' => "Máfil",
                'phone_mobile' => "+56911111111",
            ]);
        }
    }
}
