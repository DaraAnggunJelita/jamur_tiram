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
            $table->integer('siklus_panen')->default(1);
            $table->double('berat_grade_a')->default(0);
            $table->double('berat_grade_b')->default(0);
            $table->double('jumlah_panen')->default(0); // sum of A and B
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
