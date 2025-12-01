<?php
// TABLA: grade_levels (niveles de curso).
// EJEMPLOS: Pre-Kinder, Kinder, 1° Básico, ... 4° Medio.
// Se pobla con seeder y se usa como catálogo para crear cursos concretos por año.

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('grade_levels', function (Blueprint $table) {
            $table->id();
            $table->string('name');   // "1° Básico", "3° Medio", etc.
            $table->unsignedTinyInteger('order')->unique(); // orden lógico
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('grade_levels');
    }
};
