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
        Schema::create('ews_settings', function (Blueprint $table) {
            $table->id();
            $table->integer('min_durasi_sterilisasi')->default(7);
            $table->integer('maks_hari_panen')->default(4);
            $table->string('kondisi_udara_kritis')->default('Panas/Gersang');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ews_settings');
    }
};
