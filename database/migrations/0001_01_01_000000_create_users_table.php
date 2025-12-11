<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('first_name', 100);
            $table->string('last_name', 100)->nullable();
            $table->string('email', 255)->unique();
            $table->string('phone', 20)->nullable();
            $table->enum('role', ['admin', 'manager', 'recruiter', 'client']);
            $table->string('password_hash');
            $table->boolean('is_active')->default(true);
            $table->string('timezone', 50)->default('Asia/Kolkata');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
