<?php

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

            $table->string('letter')->nullable(); // A, B, etc
            $table->enum('specialty', [
                'HC',
                'TP Atención de Párvulos',
                'TP Programación',
            ])->nullable();

            $table->unsignedSmallInteger('school_year');
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
