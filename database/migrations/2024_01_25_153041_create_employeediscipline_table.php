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
        Schema::create('employeedisciplines', function (Blueprint $table) {
            $table->id('maklnv');
            $table->unsignedBigInteger('manv');
            $table->unsignedBigInteger('makyluat');
            $table->string('lydo');
            $table->dateTime('ngaykyluat');
            $table->timestamps();
            $table->foreign('manv')->references('manv')->on('employees')->cascadeOnDelete();
            $table->foreign('makyluat')->references('makyluat')->on('disciplines')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employeedisciplines');
    }
};
