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
        Schema::create('salaryscales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mangach');
            $table->float('bacluong');
            $table->float('hesoluong');
            $table->foreign('mangach')->references('id')->on('ranks')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salaryscales');
    }
};
