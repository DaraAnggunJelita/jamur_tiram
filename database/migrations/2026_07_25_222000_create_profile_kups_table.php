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
        Schema::create('profile_kups', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kups')->default('KUPS Harapan Asri');
            $table->string('sub_judul')->default('Nagari Sijunjung');
            $table->text('deskripsi_singkat')->nullable();
            $table->text('tentang_kami')->nullable();
            $table->text('visi')->nullable();
            $table->text('misi')->nullable();
            $table->integer('jumlah_anggota')->default(15);
            $table->integer('siklus_panen')->default(5);
            $table->integer('tahun_berdiri')->default(2021);
            $table->string('alamat')->default('Nagari Sijunjung, Kab. Sijunjung, Sumatera Barat');
            $table->string('nomor_telepon')->nullable();
            $table->string('email')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile_kups');
    }
};
