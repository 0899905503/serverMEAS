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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('tennv', 50);
            $table->string('gioitinh', 50);
            $table->dateTime('ngaysinh');
            $table->string('diachi', 240);
            $table->string('sdt')->nullable();
            $table->string('trinhdo', 50);
            $table->string('quoctich', 50);
            $table->string('dantoc', 50);
            $table->string('tongiao', 50)->nullable();
            $table->string('cccd', 20);
            $table->dateTime('ngaycap');
            $table->string('noicap', 50);
            $table->dateTime('ngayvaolam');
            $table->string('ngoaingu', 50)->nullable();
            $table->string('tinhoc', 50);
            $table->string('diachithuongtru', 50);
            // $table->unsignedBigInteger('mabacluong_id');
            // $table->foreign('mabacluong_id')->references('id')->on('salaryscales');
            // $table->unsignedBigInteger('maphucap_id');
            // $table->foreign('maphucap_id')->references('id')->on('subsidies');
            // $table->string('name',50)->nullable() ->> nullable() : mac dinh true duoc phep null
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
