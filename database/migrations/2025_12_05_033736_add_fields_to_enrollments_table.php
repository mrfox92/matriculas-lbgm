<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('enrollments', function (Blueprint $table) {

            // Aceptaciones legales
            $table->boolean('accept_school_rules')
                ->default(false)
                ->comment('Acepta reglamento interno del establecimiento');

            $table->boolean('accept_coexistence_rules')
                ->default(false)
                ->comment('Declara haber leído reglamento de convivencia escolar');

            $table->boolean('accept_terms_conditions')
                ->default(false)
                ->comment('Acepta términos y condiciones del proceso de matrícula');

            // Referencia al manual (versionado)
            $table->string('coexistence_manual_version')
                ->nullable()
                ->comment('Versión del manual de convivencia aceptado');

            $table->timestamp('accepted_at')
                ->nullable()
                ->comment('Fecha/hora aceptación reglamentos');
        });
    }

    public function down(): void
    {
        Schema::table('enrollments', function (Blueprint $table) {
            $table->dropColumn([
                'accept_school_rules',
                'accept_coexistence_rules',
                'accept_terms_conditions',
                'coexistence_manual_version',
                'accepted_at',
            ]);
        });
    }
};
