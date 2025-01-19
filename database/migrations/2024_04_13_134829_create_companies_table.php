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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('picture')->nullable();
            $table->string('companyname');
            $table->string('companyemail');
            $table->bigInteger('phonenumber');
            // Adding a foreign key reference to locations
            $table->foreignId('location_id')->nullable()->constrained('locations')->onDelete('set null');
            $table->enum('company_type', ['startup', 'medium', 'enterprise'])->default('startup');
            $table->string('websiteurl');
            $table->integer('numberofemployees');
            $table->string('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
