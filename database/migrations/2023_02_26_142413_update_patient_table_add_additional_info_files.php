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
        Schema::table('patients', function($table) {
            $table->text('additional_info')->nullable()->after('postal_code');
            $table->string('patient_file', 500)->nullable()->after('additional_info');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('patient', function($table) {
            $table->dropColumn('additional_info');
            $table->dropColumn('patient_file');
        });
    }
};
