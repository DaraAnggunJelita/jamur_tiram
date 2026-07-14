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
        Schema::create('log_inkubasis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inokulasi_id')->constrained('inokulasis')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->integer('persentase_tumbuh'); // 25, 50, 75, 100
            $table->text('catatan')->nullable();
            $table->date('tanggal_catat');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_inkubasis');
    }
};
