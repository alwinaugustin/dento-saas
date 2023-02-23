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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('name', 250);
            $table->enum('gender', ['male', 'female', 'other']);
            $table->smallinteger('age');
            $table->string('blood_group', 10);
            $table->enum('marital_status', ['married', 'unmarried', 'divorced']);
            $table->string('contact_number', 15);
            $table->string('email_id', 250)->nullable();
            $table->string('immediate_contact', 15)->nullable();
            $table->string('contact_relation', 50)->nullable();
            $table->string('address', 250);
            $table->string('address_2', 250);
            $table->string('city', 50);
            $table->string('state', 50);
            $table->smallinteger('postal_code');
            $table->string('referred_by', 250);
            $table->timestamps();
            $table->softDeletesTz($column = 'deleted_at', $precision = 0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient');
    }
};
