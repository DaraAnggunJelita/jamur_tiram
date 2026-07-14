<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bibits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('kode_bibit')->unique();
            $table->string('asal_bibit')->nullable();
            $table->date('tanggal_masuk');
            $table->integer('jumlah');
            $table->integer('sisa_stok')->default(0);
            $table->enum('status', ['Pending Konfirmasi Admin', 'Aktif/Siap Pakai', 'Habis'])->default('Aktif/Siap Pakai');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bibits');
    }
};
