<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('baglogs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Petugas yang input
            $table->date('tanggal');
            $table->integer('jumlah_baglog_aktif');
            $table->string('kondisi_kumbung'); // Suhu, kelembaban, dll.
            $table->enum('status_validasi', ['pending', 'valid'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('baglogs');
    }
};
