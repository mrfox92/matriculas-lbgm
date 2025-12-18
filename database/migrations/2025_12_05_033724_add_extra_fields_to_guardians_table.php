<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('guardians', function (Blueprint $table) {

            // Relación con el estudiante
            $table->string('lives_with_student')
                ->nullable()
                ->comment('Con quién vive el estudiante');

            // Último nivel cursado textual (para coincidir con ficha)
            $table->string('last_education_level_text')
                ->nullable()
                ->comment('Texto libre nivel educacional (ficha manual)');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('guardians', function (Blueprint $table) {
            //
        });
    }
};
