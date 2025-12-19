<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();

            // Estudiante
            $table->foreignId('student_id')
                ->constrained('students')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            // Curso (a veces no se conoce, se asigna en marzo)
            $table->foreignId('course_id')
                ->nullable()
                ->constrained('courses')
                ->nullOnDelete()
                ->cascadeOnUpdate();

            // Año escolar
            $table->unsignedSmallInteger('school_year');

            // Apoderados del año (titular / suplente)
            $table->foreignId('guardian_titular_id')
                ->nullable() // CLAVE
                ->constrained('guardians')
                ->cascadeOnUpdate()
                ->nullOnDelete();

            $table->foreignId('guardian_suplente_id')
                ->nullable()
                ->constrained('guardians')
                ->cascadeOnUpdate()
                ->nullOnDelete();

            // Usuario que realizó la matrícula
            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->cascadeOnUpdate()
                ->nullOnDelete();

            // Datos del proceso
            $table->date('enrollment_date')->useCurrent();
            $table->enum('enrollment_type', ['New Student', 'Returning Student'])
                  ->default('Returning Student');
            $table->enum('status', ['Pending', 'Confirmed', 'Cancelled'])
                  ->default('Confirmed');

            // Promoción / repitencia
            $table->unsignedBigInteger('previous_grade_level_id')->nullable();
            $table->boolean('is_repeating')->default(false);

            // Formulario: salud del año
            $table->boolean('has_health_issues')->default(false);
            $table->text('health_issues_details')->nullable();
            $table->boolean('is_pie_student')->default(false);
            $table->boolean('needs_lunch')->default(false);

            // Pregunta 1: con quién vive el estudiante
            $table->string('lives_with')->nullable();

            // Autorizaciones
            $table->boolean('consent_extra_activities')->default(false);
            $table->boolean('consent_field_trips')->default(false);
            $table->boolean('consent_photos')->default(false);
            $table->boolean('consent_school_bus')->default(false);
            $table->boolean('consent_internet')->default(false);

            // Interno
            $table->string('internal_enrollment_number')->nullable();
            $table->text('notes')->nullable();

            $table->timestamps();

            $table->unique(
                ['student_id', 'school_year'],
                'one_enrollment_per_student_year'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('enrollments');
    }
};
