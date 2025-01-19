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
        Schema::create('joblistings', function (Blueprint $table) {
            $table->id();
            $table->string('jobtitle');
            $table->string('description');
            $table->foreignId('skill_id')->constrained('skills');
            $table->enum('profiency', ['Beigneer', 'Intermediate', 'Pro'])->default('Beigneer');
            $table->integer('salary');
            $table->enum('gender', ['Male', 'Female', 'Any'])->default('Any');
            $table->enum('jobtype', ['Full Time', 'Part Time', 'Contract','Temporary'])->default('Temporary');
            $table->foreignId('location_id')->constrained('locations');
            $table->integer('numberofpositions');
            
            $table->integer('agelimit');// age limit ko change krna int krna 
            $table->string('workinghours');
            $table->enum('experiencelevel', ['Entry Level', 'Mid Level', 'Senior Level']);
            $table->date('endson');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('joblistings');
    }
};
