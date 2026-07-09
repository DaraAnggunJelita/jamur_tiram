<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('monitoring_kumbungs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inokulasi_id')->constrained('inokulasis')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->date('tanggal');
            $table->enum('kondisi_udara', ['Sejuk', 'Hangat', 'Panas/Gersang']);
            $table->enum('kondisi_lantai', ['Basah/Lembab', 'Kering']);
            $table->integer('jumlah_penyiraman')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('monitoring_kumbungs');
    }
};
