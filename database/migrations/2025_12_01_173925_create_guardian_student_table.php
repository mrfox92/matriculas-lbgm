<?php
// TABLA PIVOT: guardian_student.
// RELACIÓN N:N entre guardians y students.
// Guarda año lectivo y rol (Titular / Suplente / Otro).

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('guardian_student', function (Blueprint $table) {
            $table->id();

            $table->foreignId('guardian_id')
                  ->constrained('guardians')
                  ->cascadeOnUpdate()
                  ->cascadeOnDelete();

            $table->foreignId('student_id')
                  ->constrained('students')
                  ->cascadeOnUpdate()
                  ->cascadeOnDelete();

            $table->unsignedSmallInteger('school_year');
            $table->enum('role', ['Titular', 'Suplente', 'Otro'])->default('Titular');

            $table->timestamps();

            $table->unique(
                ['guardian_id', 'student_id', 'school_year', 'role'],
                'unique_guardian_student_by_year_role'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('guardian_student');
    }
};
