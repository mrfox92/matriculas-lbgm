<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       
        $this->call([
            RoleSeeder::class,
            UserRoleSeeder::class,
            GradeLevelSeeder::class,
            CourseSeeder::class,

            // GuardianTestSeeder::class,
            // StudentTestSeeder::class,
            // PivotGuardianStudentSeeder::class,
            // EnrollmentTestSeeder::class,
            // ======================
            // ALUMNOS ANTIGUOS REALES
            // ======================
            \Database\Seeders\Legacy\PreKinder2025Seeder::class,
            \Database\Seeders\Legacy\Kinder2025Seeder::class,
            \Database\Seeders\Legacy\PrimeroBasico2025Seeder::class,
            \Database\Seeders\Legacy\SegundoBasico2025Seeder::class,
            \Database\Seeders\Legacy\TerceroBasico2025Seeder::class,
            \Database\Seeders\Legacy\CuartoBasico2025Seeder::class,
            \Database\Seeders\Legacy\QuintoBasico2025Seeder::class,
            \Database\Seeders\Legacy\SextoBasico2025Seeder::class,
            \Database\Seeders\Legacy\SeptimoBasicoA2025Seeder::class,
            \Database\Seeders\Legacy\SeptimoBasicoB2025Seeder::class,
            \Database\Seeders\Legacy\OctavoBasicoA2025Seeder::class,
            \Database\Seeders\Legacy\PrimeroMedioA2025Seeder::class,
            \Database\Seeders\Legacy\PrimeroMedioB2025Seeder::class,
            \Database\Seeders\Legacy\SegundoMedioA2025Seeder::class,
            \Database\Seeders\Legacy\SegundoMedioB2025Seeder::class,
            \Database\Seeders\Legacy\TerceroMedioHC2025Seeder::class,
            \Database\Seeders\Legacy\TerceroMedioTPParvulos2025Seeder::class,
            \Database\Seeders\Legacy\TerceroMedioTPProgramacion2025Seeder::class,
        ]);
    }
}
