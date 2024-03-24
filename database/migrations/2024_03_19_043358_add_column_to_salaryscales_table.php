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
        Schema::table('salaryscales', function (Blueprint $table) {
            $table->string('luongtheobac')->after('manv');
            $table->double('tongluong')->after('luongtheobac');
            $table->dateTime('thang')->nullable()->after('tongluong');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('salaryscales', function (Blueprint $table) {
            $table->dropColumn('tongluong');
            $table->dropColumn('luongtheobac');

            $table->dropColumn('thang');
        });
    }
};
