<?php

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

            $table->boolean('lives_with')->default(false);

            $table->timestamps();

            $table->unique(['guardian_id', 'student_id'], 'unique_guardian_student_relation');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('guardian_student');
    }
};
