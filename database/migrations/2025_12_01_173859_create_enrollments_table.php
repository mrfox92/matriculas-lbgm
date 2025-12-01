<?php
// TABLA: enrollments (matrículas).
// Representa la matrícula de un estudiante en un curso para un año específico.
// Basada en el formulario + anotaciones: alumno PIE, almuerzo, autorizaciones, con quién vive.:contentReference[oaicite:3]{index=3}
//
// RELACIONES:
//  - belongsTo Student
//  - belongsTo Course
//  - belongsTo Guardian (titular y suplente)
//  - belongsTo User (quien digitó la matrícula)
//
// REGLA: un estudiante solo tiene UNA matrícula por año (unique student_id + school_year).

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('student_id')
                  ->constrained('students')
                  ->cascadeOnUpdate()
                  ->restrictOnDelete();

            $table->foreignId('course_id')
                  ->constrained('courses')
                  ->cascadeOnUpdate()
                  ->restrictOnDelete();

            $table->unsignedSmallInteger('school_year');

            $table->foreignId('guardian_titular_id')
                  ->constrained('guardians')
                  ->cascadeOnUpdate()
                  ->restrictOnDelete();

            $table->foreignId('guardian_suplente_id')
                  ->nullable()
                  ->constrained('guardians')
                  ->cascadeOnUpdate()
                  ->nullOnDelete();

            // Usuario que realiza la matrícula (admin/digitador)
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->cascadeOnUpdate()
                  ->restrictOnDelete();

            $table->date('enrollment_date')->default(now());

            $table->enum('enrollment_type', ['New Student', 'Returning Student'])
                  ->default('Returning Student');
            $table->enum('status', ['Pending', 'Confirmed', 'Canceled'])
                  ->default('Confirmed');

            $table->string('internal_enrollment_number')->nullable();

            // Sección SALUD del formulario (por año)
            $table->boolean('has_health_issues')->default(false);
            $table->text('health_issues_details')->nullable();
            $table->boolean('is_pie_student')->default(false);
            $table->boolean('needs_lunch')->default(false);

            // Pregunta 1: con quién vive el estudiante
            $table->string('lives_with')->nullable();

            // AUTORIZACIONES
            $table->boolean('consent_field_trips')->default(false);
            $table->boolean('consent_photos')->default(false);
            $table->boolean('consent_school_bus')->default(false);
            $table->boolean('consent_internet')->default(false);

            $table->text('notes')->nullable();

            $table->timestamps();

            $table->unique(['student_id', 'school_year'], 'one_enrollment_per_student_year');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('enrollments');
    }
};
