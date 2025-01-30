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
        Schema::create('pasien_checkup_reseps', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(App\Models\PasienCheckup::class)->constrained()->cascadeOnDelete();
            $table->string('obat_id');
            $table->string('obat');
            $table->integer('qty');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pasien_checkup_reseps');
    }
};
