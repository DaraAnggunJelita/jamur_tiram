<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('production_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inokulasi_id')->constrained('inokulasis')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->date('tanggal');
            $table->double('jumlah_panen');
            $table->enum('kualitas_panen', ['Kualitas Bagus', 'Kualitas Cukup', 'Kualitas Buruk/Layu']);
            $table->enum('status_distribusi', ['Belum Didistribusikan', 'Siap Jual Segar', 'Siap Jual Grosir', 'Pengolahan Kuliner Rendang'])->default('Belum Didistribusikan');
            $table->enum('status_validasi', ['pending', 'valid', 'invalid'])->default('pending');
            $table->text('catatan')->nullable();
            $table->foreignId('validated_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('production_reports');
    }
};
