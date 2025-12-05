<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();

            // Identificación
            $table->string('rut')->unique();
            $table->string('last_name_father');
            $table->string('last_name_mother')->nullable();
            $table->string('first_name');

            // Datos personales
            $table->enum('gender', ['Femenino', 'Masculino', 'Otro'])->nullable();
            $table->date('birth_date')->nullable();
            $table->string('nationality')->nullable();

            // Religión
            $table->enum('religion', ['Católica', 'Evangélica', 'Otra', 'Ninguna'])->nullable();
            $table->string('religion_other')->nullable();

            // Pueblo originario
            $table->boolean('indigenous_ancestry')->default(false);
            $table->string('indigenous_ancestry_type')->nullable(); // Mapuche, Huilliche, etc.

            // Contacto y dirección
            $table->string('address')->nullable();
            $table->string('commune')->nullable();      // antes city
            $table->string('phone')->nullable();        // antes phone_mobile
            $table->string('emergency_phone')->nullable(); // antes phone_emergency

            // Salud (formulario actual)
            $table->boolean('has_health_issues')->default(false);
            $table->text('health_issues_details')->nullable();

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
