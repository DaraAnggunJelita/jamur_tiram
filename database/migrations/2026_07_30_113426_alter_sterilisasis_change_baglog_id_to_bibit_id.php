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
        Schema::table('sterilisasis', function (Blueprint $table) {
            $table->dropForeign(['baglog_id']);
            $table->dropColumn('baglog_id');
            $table->foreignId('bibit_id')->nullable()->after('id')->constrained('bibits')->onDelete('cascade');
        });

        Schema::dropIfExists('baglogs');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sterilisasis', function (Blueprint $table) {
            $table->dropForeign(['bibit_id']);
            $table->dropColumn('bibit_id');
        });
    }
};
