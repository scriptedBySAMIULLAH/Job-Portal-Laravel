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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_id')->constrained('joblistings')->onDelete('cascade');
            $table->foreignId('jobseeker_id')->constrained('jobseekers')->onDelete('cascade');
            $table->enum('status', ['Pending', 'Shortlisted', 'Rejected', 'Accepted'])->nullable();
            $table->string('cv')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
