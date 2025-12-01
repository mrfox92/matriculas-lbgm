<?php
// TABLA: students (estudiantes).
// Basada en el formulario "INDIVIDUALIZACIÓN DEL ALUMNO": apellidos, nombres, RUN, sexo, f.nacimiento,
// nacionalidad, religión, ascendencia indígena, dirección, comuna, teléfonos, salud, PIE, almuerzo, etc.:contentReference[oaicite:1]{index=1}
//
// INTEGRIDAD:
//  - rut único.
// RELACIONES:
//  - 1:N con enrollments (matrículas).
//  - N:N con guardians (apoderados) vía guardian_student.

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();

            $table->string('rut')->unique();
            $table->string('last_name_father');
            $table->string('last_name_mother')->nullable();
            $table->string('first_name');

            $table->enum('gender', ['Femenino', 'Masculino', 'Otro'])->nullable();
            $table->date('birth_date')->nullable();

            $table->string('nationality')->nullable();
            $table->enum('religion', ['Católica', 'Evangélica', 'Otra', 'Ninguna'])
                  ->nullable();
            $table->string('religion_other')->nullable(); // cuando se selecciona "Otra"
            $table->boolean('indigenous_ancestry')->default(false);

            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('phone_mobile')->nullable();
            $table->string('phone_emergency')->nullable();

            // Salud general del estudiante (detalle permanente)
            $table->boolean('has_chronic_health_issues')->default(false);
            $table->text('chronic_health_details')->nullable();

            // Datos SIGE opcionales
            $table->string('rne')->nullable();
            $table->string('previous_enrollment_number')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
