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
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('barangay_id')->constrained('barangays');
            $table->string('last_name');
            $table->string('first_name');
            $table->string('middle_name_or_initial')->nullable();
            $table->string('sex')->nullable();
            $table->string('address')->nullable();
            $table->integer('age')->nullable();
            $table->string('civil_status');
            $table->boolean('residency_certificate');
            $table->boolean('indigency_certificate');
            $table->text('message')->nullable();
            $table->timestamps();
        });

        Schema::create('receipts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('request_id')->constrained('requests');
            $table->string('number')->nullable();
            $table->integer('fee_amount');
            $table->integer('stamp_tax_amount');
            $table->date('date_issued');
            $table->integer('receiptable_id');
            $table->string('receiptable_type');
            $table->timestamps();
        });

        Schema::create('residency_certificates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('resident_id')->constrained('residents');
            $table->timestamps();
        });

        Schema::create('indigency_certificates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('resident_id')->constrained('residents');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('indigency_certificates');
        Schema::dropIfExists('residency_certificates');
        Schema::dropIfExists('receipts');
        Schema::dropIfExists('requests');
    }
};
