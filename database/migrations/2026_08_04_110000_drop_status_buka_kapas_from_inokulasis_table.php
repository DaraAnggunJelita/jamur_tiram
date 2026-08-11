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
        Schema::table('inokulasis', function (Blueprint $table) {
            if (Schema::hasColumn('inokulasis', 'status_buka_kapas')) {
                $table->dropColumn('status_buka_kapas');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inokulasis', function (Blueprint $table) {
            $table->boolean('status_buka_kapas')->default(false);
        });
    }
};
