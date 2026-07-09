<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sterilisasis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('baglog_id')->constrained('baglogs')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->date('tanggal');
            $table->integer('durasi_pengukusan'); // dalam jam
            $table->enum('kondisi_air', ['Aman', 'Menipis', 'Habis']);
            $table->enum('kestabilan_api', ['Stabil-Besar', 'Mengecil', 'Padam']);
            $table->enum('status_sterilisasi', ['aman', 'berisiko'])->default('aman');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sterilisasis');
    }
};
