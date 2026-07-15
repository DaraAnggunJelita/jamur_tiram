<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("ALTER TABLE production_reports MODIFY COLUMN status_validasi ENUM('pending', 'valid', 'invalid', 'dibatalkan') DEFAULT 'pending' NOT NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE production_reports MODIFY COLUMN status_validasi ENUM('pending', 'valid', 'invalid') DEFAULT 'pending' NOT NULL");
    }
};
