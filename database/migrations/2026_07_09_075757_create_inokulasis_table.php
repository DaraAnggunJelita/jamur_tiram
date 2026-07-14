<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inokulasis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sterilisasi_id')->constrained('sterilisasis')->onDelete('cascade');
            $table->foreignId('bibit_id')->constrained('bibits')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->date('tanggal');
            $table->integer('jumlah_berhasil');
            $table->integer('jumlah_kontaminasi')->default(0);
            $table->integer('jumlah_bibit_terpakai')->default(0);
            $table->boolean('status_buka_kapas')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inokulasis');
    }
};
