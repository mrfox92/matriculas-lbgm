<?php
// TABLA: guardians (apoderados).
// Basado en "DATOS APODERADO": apellidos, nombres, RUN, sexo, f.nacimiento,
// dirección, comuna, teléfonos, nivel educacional, situación laboral, lugar de trabajo, etc.:contentReference[oaicite:2]{index=2}
//
// RELACIONES:
//  - N:N con students vía guardian_student.
//  - 1:N con enrollments como titular o suplente.

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('guardians', function (Blueprint $table) {
            $table->id();

            $table->string('rut')->unique();
            $table->string('last_name_father');
            $table->string('last_name_mother')->nullable();
            $table->string('first_name');

            $table->enum('gender', ['Femenino', 'Masculino', 'Otro'])->nullable();
            $table->date('birth_date')->nullable();

            $table->string('address')->nullable();
            $table->string('city')->nullable();

            $table->string('phone_mobile')->nullable();
            $table->string('phone_emergency')->nullable();

            // Nivel educacional (técnico, medio, profesional, etc.)
            $table->enum('education_level', [
                'Básica incompleta','Básica completa',
                'Media incompleta','Media completa',
                'Técnico nivel medio','Técnico nivel superior',
                'Profesional','Postgrado','Otro'
            ])->nullable();

            // Situación laboral (respuesta a pregunta 3)
            $table->string('employment_status')->nullable(); // ej: "Dueña de casa", "Empleado", etc.

            // Pregunta 4: principal lugar de trabajo
            $table->enum('work_main_place', ['En el hogar', 'Fuera del hogar', 'No trabaja'])
                  ->nullable();

            $table->string('workplace')->nullable();
            $table->string('work_phone')->nullable();

            // Para gestión interna (quién puede retirar)
            $table->boolean('authorized_to_pickup')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('guardians');
    }
};
