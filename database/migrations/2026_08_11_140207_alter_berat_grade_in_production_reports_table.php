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
        // Mengubah kolom menjadi DECIMAL(5,2)
        \Illuminate\Support\Facades\DB::statement('ALTER TABLE production_reports MODIFY berat_grade_a DECIMAL(5,2) DEFAULT 0');
        \Illuminate\Support\Facades\DB::statement('ALTER TABLE production_reports MODIFY berat_grade_b DECIMAL(5,2) DEFAULT 0');
        \Illuminate\Support\Facades\DB::statement('ALTER TABLE production_reports MODIFY jumlah_panen DECIMAL(5,2) DEFAULT 0');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Kembalikan ke DOUBLE jika di-rollback
        \Illuminate\Support\Facades\DB::statement('ALTER TABLE production_reports MODIFY berat_grade_a DOUBLE DEFAULT 0');
        \Illuminate\Support\Facades\DB::statement('ALTER TABLE production_reports MODIFY berat_grade_b DOUBLE DEFAULT 0');
        \Illuminate\Support\Facades\DB::statement('ALTER TABLE production_reports MODIFY jumlah_panen DOUBLE DEFAULT 0');
    }
};
