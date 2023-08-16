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
        Schema::create('resident_keys', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
        Schema::create('residents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('key_id')->constrained('resident_keys');
            $table->foreignId('household_id')->constrained('households');
            $table->string('last_name');
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('name_extension');
            $table->string('birth_place');
            $table->date('birth_date');
            $table->string('sex');
            $table->string('civil_status');
            $table->string('citizenship');
            $table->string('occupation');
            $table->string('house_numner');
            $table->string('street_name');
            $table->string('area_name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('residents');

        Schema::dropIfExists('resident_keys');
    }
};
