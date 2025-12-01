<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Roles base para el sistema de matrículas
        $roles = [
            'admin',
            'digitador',
            'visualizador',
        ];

        foreach ($roles as $roleName) {
            Role::firstOrCreate(
                ['name' => $roleName, 'guard_name' => 'web']
            );
        }
    }
}
