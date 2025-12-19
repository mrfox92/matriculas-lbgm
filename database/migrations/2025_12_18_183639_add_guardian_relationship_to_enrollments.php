<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('enrollments', function (Blueprint $table) {
            $table->enum('guardian_relationship', ['Madre', 'Padre', 'Otro'])
                ->nullable()
                ->after('guardian_titular_id');

            $table->string('guardian_relationship_other')
                ->nullable()
                ->after('guardian_relationship');
        });
    }

    public function down(): void
    {
        Schema::table('enrollments', function (Blueprint $table) {
            $table->dropColumn([
                'guardian_relationship',
                'guardian_relationship_other',
            ]);
        });
    }
};
