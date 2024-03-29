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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->integer('patient_id')->references('id')->on('patients')->onDelete('cascade');
            $table->integer('doctor_id')->references('id')->on('doctors');
            $table->string('purpose', 250);
            $table->timestamp('appointment_time');
            $table->text('additional_information');
            $table->string('status',25);
            $table->timestamps();
            $table->softDeletesTz($column = 'deleted_at', $precision = 0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
