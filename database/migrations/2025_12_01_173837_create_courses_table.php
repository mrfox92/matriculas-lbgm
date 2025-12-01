<?php
// TABLA: courses (cursos por año).
// EJEMPLOS (2026):
//  - Pre-Kinder
//  - Kinder
//  - 1° Básico
//  ...
//  - 7° Básico A, 7° Básico B
//  - 3° Medio HC, 3° Medio TP Atención de Párvulos, 3° Medio TP Programación, etc.
//
// RELACIONES:
//  - belongsTo GradeLevel
//  - hasMany Enrollments.

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();

            $table->foreignId('grade_level_id')
                  ->constrained('grade_levels')
                  ->cascadeOnUpdate()
                  ->restrictOnDelete();

            $table->string('letter')->nullable(); // A, B, etc.
            $table->enum('specialty', [
                'HC',
                'TP Atención de Párvulos',
                'TP Programación',
            ])->nullable();

            $table->unsignedSmallInteger('school_year'); // 2025, 2026...
            $table->unsignedSmallInteger('max_capacity')->nullable();

            $table->timestamps();

            $table->unique(
                ['grade_level_id', 'letter', 'specialty', 'school_year'],
                'unique_course_per_year'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
