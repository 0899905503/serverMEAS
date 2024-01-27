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
        Schema::create('relationship', function (Blueprint $table) {
            $table->unsignedBigInteger('manv');
            $table->unsignedBigInteger('matn');
            $table->foreign('manv')->references('manv')->on('employees')->cascadeOnDelete();
            $table->foreign('matn')->references('matn')->on('relatives')->cascadeOnDelete();
            $table->string('loaiquanhe');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('relationship');
    }
};
