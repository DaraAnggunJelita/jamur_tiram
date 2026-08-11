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
            $table->string('nama_kups', 60)->default('KUPS Harapan Asri');
            $table->string('sub_judul', 60)->default('Nagari Sijunjung');
            $table->text('deskripsi_singkat')->nullable();
            $table->text('tentang_kami')->nullable();
            $table->text('visi')->nullable();
            $table->text('misi')->nullable();
            $table->integer('jumlah_anggota')->nullable();
            $table->integer('siklus_panen')->nullable();
            $table->integer('tahun_berdiri')->nullable();
            $table->string('alamat', 150)->default('Nagari Sijunjung, Kab. Sijunjung, Sumatera Barat');
            $table->string('nomor_telepon', 15)->nullable();
            $table->string('email', 60)->nullable();
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
