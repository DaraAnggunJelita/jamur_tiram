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
        Schema::table('ews_settings', function (Blueprint $table) {
            if (Schema::hasColumn('ews_settings', 'min_durasi_sterilisasi')) {
                $table->dropColumn('min_durasi_sterilisasi');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ews_settings', function (Blueprint $table) {
            $table->integer('min_durasi_sterilisasi')->default(7);
        });
    }
};
