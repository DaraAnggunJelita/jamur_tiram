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
            $table->foreignId('distribusi_bibit_id')->nullable()->after('bibit_id')->constrained('distribusi_bibits')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inokulasis', function (Blueprint $table) {
            $table->dropForeign(['distribusi_bibit_id']);
            $table->dropColumn('distribusi_bibit_id');
        });
    }
};
