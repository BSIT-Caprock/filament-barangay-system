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
        Schema::create('resident_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('resident_id')->constrained('residents');
            $table->foreignId('household_record_id')->constrained('household_records');
            $table->string('last_name');
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('name_extension');
            //$table->foreignId('birth_place_id')->constrained('birth_places');
            $table->string('birth_place');
            $table->date('birth_date');
            $table->string('sex');
            $table->string('civil_status');
            $table->string('citizenship');
            $table->string('occupation');
            $table->foreignId('residence_id')->constrained('residences');
            $table->date('accomplished_at');
            $table->string('accomplished_by');
            $table->string('attested_by');
            $table->string('left_thumbmark');
            $table->string('right_thumbmark');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resident_records');
    }
};
