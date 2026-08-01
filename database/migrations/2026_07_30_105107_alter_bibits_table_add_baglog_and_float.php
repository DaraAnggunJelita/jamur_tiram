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
        Schema::table('bibits', function (Blueprint $table) {
            $table->float('jumlah')->change();
            $table->float('sisa_stok')->default(0)->change();
            $table->float('banyak_baglog')->nullable()->after('sisa_stok');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bibits', function (Blueprint $table) {
            $table->dropColumn('banyak_baglog');
            $table->integer('jumlah')->change();
            $table->integer('sisa_stok')->default(0)->change();
        });
    }
};
