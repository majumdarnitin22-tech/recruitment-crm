<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('candidates', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('first_name', 100);
            $table->string('last_name', 100)->nullable();
            $table->string('phone', 50);
            $table->string('email', 255)->nullable();
            $table->string('education', 255)->nullable();
            $table->decimal('last_salary', 15, 2)->nullable();
            $table->decimal('expected_salary', 15, 2)->nullable();
            $table->enum('shift_preference', ['day', 'night', 'any', 'rotating'])->default('any');
            $table->uuid('client_id')->nullable();
            $table->uuid('job_profile_id')->nullable();
            $table->string('source', 100)->nullable();
            $table->uuid('recruiter_id')->nullable();
            $table->enum('status', ['new', 'in_progress', 'joined', 'rejected'])->default('new');
            $table->boolean('is_shortlisted')->default(false);
            $table->text('shortlist_reason')->nullable();
            $table->text('notes')->nullable();
            $table->string('cv_url')->nullable();
            $table->date('doj')->nullable();
            $table->boolean('doj_reminder_sent')->default(false);
            $table->timestamps();
            
            // Optional foreign keys
            // $table->foreign('client_id')->references('id')->on('clients')->onDelete('set null');
            // $table->foreign('job_profile_id')->references('id')->on('job_profiles')->onDelete('set null');
            // $table->foreign('recruiter_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('candidates');
    }
};
