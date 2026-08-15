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
        Schema::dropIfExists('peringatans');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('peringatans', function (Blueprint $table) {
            $table->id();
            $table->enum('kategori', ['Sterilisasi', 'Kumbung', 'Panen']);
            $table->unsignedBigInteger('referensi_id');
            $table->enum('level', ['Waspada', 'Kritis'])->default('Kritis');
            $table->text('pesan');
            $table->boolean('is_read')->default(false);
            $table->timestamps();
        });
    }
};
