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
        Schema::create('work__histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('JobTitle')->nullable();
            $table->string('Employer')->nullable();
            $table->string('Location')->nullable();
            $table->string('stdmonthsW')->nullable();
            $table->string('endmonthsW')->nullable();
            $table->year('stdyearsW')->nullable();
            $table->year('endyearsW')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('work__histories');
    }
};
