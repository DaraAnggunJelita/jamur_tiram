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
        Schema::dropIfExists('ews_settings');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('ews_settings', function (Blueprint $table) {
            $table->id();
            $table->integer('maks_hari_panen')->default(4);
            $table->string('kondisi_udara_kritis')->default('Panas');
            $table->timestamps();
        });
    }
};
