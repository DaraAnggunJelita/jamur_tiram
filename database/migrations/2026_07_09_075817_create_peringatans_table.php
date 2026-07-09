<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('peringatans', function (Blueprint $table) {
            $table->id();
            $table->enum('kategori', ['Sterilisasi', 'Kumbung']);
            $table->unsignedBigInteger('referensi_id'); // ID dari tabel sterilisasi atau monitoring_kumbung
            $table->enum('level', ['Waspada', 'Kritis'])->default('Kritis');
            $table->text('pesan');
            $table->boolean('is_read')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peringatans');
    }
};
