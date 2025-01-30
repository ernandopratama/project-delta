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
        Schema::create('pasien_checkups', function (Blueprint $table) {
            $table->id();
            $table->string('pasien');
            $table->dateTime('checkup_at');
            $table->string('tinggi_badan');
            $table->string('berat_badan');
            $table->string('systole');
            $table->string('diastole');
            $table->string('heart_rate');
            $table->string('respiration_rate');
            $table->string('temperature');
            $table->text('result')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pasien_checkups');
    }
};
