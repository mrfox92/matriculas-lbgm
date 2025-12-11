<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRoleSeeder extends Seeder
{
    public function run(): void
    {
        // Usuario Administrador
        $admin = User::firstOrCreate(
            ['email' => 'admin@lbgm.cl'],
            [
                'name'     => 'Administrador General',
                'rut'      => '11111111-1',
                'password' => Hash::make('admin123'),
            ]
        );
        $admin->assignRole('admin');

        // Usuario Digitador
        $digitador = User::firstOrCreate(
            ['email' => 'digitador@lbgm.cl'],
            [
                'name'     => 'Digitador Matrículas',
                'rut'      => '22222222-2',
                'password' => Hash::make('digitador123'),
            ]
        );
        $digitador->assignRole('digitador');

        // Usuario Visualizador
        $viewer = User::firstOrCreate(
            ['email' => 'visualizador@lbgm.cl'],
            [
                'name'     => 'Visualizador',
                'rut'      => '33333333-3',
                'password' => Hash::make('visual123'),
            ]
        );
        $viewer->assignRole('visualizador');
    }
}
