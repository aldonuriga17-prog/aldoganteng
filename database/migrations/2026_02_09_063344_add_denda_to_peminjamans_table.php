<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        if (!Schema::hasColumn('peminjaman', 'denda')) {
            Schema::table('peminjaman', function (Blueprint $table) {
                $table->integer('denda')->default(0)->after('status');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        if (Schema::hasColumn('peminjaman', 'denda')) {
            Schema::table('peminjaman', function (Blueprint $table) {
                $table->dropColumn('denda');
            });
        }
    }
};
