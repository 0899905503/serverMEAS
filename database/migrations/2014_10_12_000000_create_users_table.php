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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('Personal Id')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->char('phone_number', 10)->unique()->nullable();
            $table->enum('gender', ['male', 'female'])->default('male');
            $table->string('address');
            $table->date('birth_date');
            $table->boolean('is_active')->default(true);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('Qualification', 50)->nullable();
            $table->string('Nationality', 50)->nullable();
            $table->string('Ethnicity', 50)->nullable();
            $table->string('Religion', 50)->nullable();
            $table->dateTime('Issue Date')->nullable();
            $table->string('Issued By', 50)->nullable();
            $table->dateTime('Start Date')->nullable();
            $table->string('Language', 50)->nullable();
            $table->string('Computer Science', 50)->nullable();
            $table->string('Permanent Address', 50)->nullable();
            $table->string('avatar')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
