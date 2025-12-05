<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('guardians', function (Blueprint $table) {
            $table->id();

            // Datos básicos
            $table->string('rut')->unique();
            $table->string('last_name_father');
            $table->string('last_name_mother')->nullable();
            $table->string('first_name');

            // Datos personales
            $table->enum('gender', ['Femenino', 'Masculino', 'Otro'])->nullable();
            $table->date('birth_date')->nullable();

            // Contacto y dirección
            $table->string('address')->nullable();
            $table->string('commune')->nullable();               // comuna del apoderado
            $table->string('phone')->nullable();                 // teléfono de contacto
            $table->string('emergency_phone')->nullable();       // teléfono de emergencia

            // Nivel educacional
            $table->enum('education_level', [
                'Básica incompleta', 'Básica completa',
                'Media incompleta', 'Media completa',
                'Técnico nivel medio', 'Técnico nivel superior',
                'Profesional', 'Postgrado', 'Otro'
            ])->nullable();

            // Situación laboral
            $table->string('employment_status')->nullable();  // Dueña de casa / Empleado / Independiente / etc.
            $table->enum('work_main_place', ['En el hogar', 'Fuera del hogar', 'No trabaja'])->nullable();
            $table->string('workplace')->nullable();          // Lugar donde trabaja
            $table->string('work_phone')->nullable();         // Teléfono laboral

            // Quién puede retirar al estudiante
            $table->boolean('authorized_to_pickup')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('guardians');
    }
};
