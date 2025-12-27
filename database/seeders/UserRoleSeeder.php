<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserRoleSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | ADMINISTRADORES
        |--------------------------------------------------------------------------
        */

        // Admin técnico del sistema
        $admin = User::firstOrCreate(
            ['email' => 'admin@lbgm.cl'],
            [
                'name' => 'Administrador General',
                'rut' => '11111111-1',
                'password' => Hash::make('admin123'),
            ]
        );
        $admin->assignRole('admin');

        // Administrador Matrículas - Juvenal Zurita
        $juvenal = User::firstOrCreate(
            ['email' => 'juvenal.zurita@eduvaldivia.gob.cl'],
            [
                'name' => 'Juvenal Esteban Zurita Vergara',
                'rut' => '10229985-K',
                'password' => Hash::make('10229985'),
            ]
        );
        $juvenal->assignRole('admin');

        /*
        |--------------------------------------------------------------------------
        | DIGITADORES (PROFESORES MATRÍCULAS)
        |--------------------------------------------------------------------------
        */

        $digitadores = [
            ['Sandra Lorena Gallegos Gallegos', '9162238-6', 'sandra.gallegos@eduvaldivia.gob.cl'],
            ['Pamela Andrea Fernández Aguilar', '15987515-6', 'pamela.fernandez@eduvaldivia.gob.cl'],
            ['Claudia Andrea Monsalve Matamala', '14281116-2', 'claudia.monsalve@eduvaldivia.gob.cl'],
            ['Pamela Andrea Solís Rivera', '14082878-5', 'pamela.solis@eduvaldivia.gob.cl'],
            ['Anabelle Angeline Brandt Bazzi', '16160895-5', 'anabelle.brandt@eduvaldivia.gob.cl'],
            ['Ana María Leal Barría', '9945641-8', 'ana.leal@eduvaldivia.gob.cl'],
            ['Lucas Javier Galvis Abril', '26357066-9', 'lucas.galvis@eduvaldivia.gob.cl'],
            ['Nicole Arlette Saravia Rivas', '17421798-K', 'nicole.saravia@eduvaldivia.gob.cl'],
            ['César Antonio Neira Miranda', '15266143-6', 'cesar.neira@eduvaldivia.gob.cl'],
            ['Aracely Marily Denisse Urrea Sabelle', '16852806-K', 'aracely.urrea@eduvaldivia.gob.cl'],
            ['Víctor Andrés Álvarez Namoncura', '15531144-4', 'victor.alvarez@eduvaldivia.gob.cl'],
            ['Alessandra del Pilar Mendoza Troncoso', '18289678-0', 'alessandra.mendoza@eduvaldivia.gob.cl'],
            ['Juan Alberto Castillo Escobar', '17605092-6', 'juan.castillo@eduvaldivia.gob.cl'],
            ['Fernanda Isabel Manríquez Solís', '18959196-9', 'fernanda.manriquez@eduvaldivia.gob.cl'],
            ['Cristian Alamiro Negrón Llaitul', '12997320-K', 'cristian.negron@eduvaldivia.gob.cl'],
            ['Jaime Francisco Fuentes Uribe', '13402160-8', 'jaime.fuentes@eduvaldivia.gob.cl'],
            ['Luis Javier Sobarzo Sánchez', '18888671-K', 'luis.sobarzo@eduvaldivia.gob.cl'],
            ['Bárbara Lya Rosas Ramírez', '9782344-8', 'barbara.rosas@eduvaldivia.gob.cl'],
            ['David Ignacio Álvarez Guerrero', '17985411-2', 'david.alvarez@eduvaldivia.gob.cl'],
            ['Caroline Margarett Navarrete Olivera', '12336927-0', 'caroline.navarrete@eduvaldivia.gob.cl'],
            ['Yerko Aliro Riquelme Llanquimán', '17654048-6', 'yerko.riquelme@eduvaldivia.gob.cl'],
            // Estudiantes en práctica
            ['Paz Belén Orellana Martin', '22566276-2', 'pazprogramacion@gmail.com'],
            ['Fabián Antonio Riquelme Aguayo', '22379098-4', 'fabiaanriquelmee@gmail.com'],
        ];

        foreach ($digitadores as [$name, $rut, $email]) {
            $user = User::firstOrCreate(
                ['email' => $email],
                [
                    'name' => $name,
                    'rut' => $rut,
                    'password' => Hash::make('matriculalbgm2026'),
                ]
            );

            $user->assignRole('digitador');
        }
    }
}
