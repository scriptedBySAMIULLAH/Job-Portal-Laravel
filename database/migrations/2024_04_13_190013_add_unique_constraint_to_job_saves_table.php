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
        Schema::table('job_saves', function (Blueprint $table) {
          // Adding a unique constraint on multiple columns
        $table->unique(['job_id', 'jobseeker_id'], 'job_user_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('job_saves', function (Blueprint $table) {
            $table->dropUnique('job_user_unique');
        });
    }
};
