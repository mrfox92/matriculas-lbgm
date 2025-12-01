<?php
// MIGRACIÓN: agrega campos específicos para el sistema de matrículas
// TABLA: users (ya usada por Sanctum y Spatie).
// Campos nuevos:
//  - rut: RUT del usuario que matricula.
//  - active: para habilitar/deshabilitar el acceso durante el proceso de matrícula.

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('rut')->unique()->nullable()->after('email');
            $table->boolean('active')->default(true)->after('password');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['rut', 'active']);
        });
    }
};
