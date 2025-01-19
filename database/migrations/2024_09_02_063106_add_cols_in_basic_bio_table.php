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
        Schema::table('basic_bios', function (Blueprint $table) {
            $table->enum('experience_level',['entry_level','junior','mid_level','senior'])->default('junior')->after('yourself');
            $table->string('linkedinprofile')->after('experience_level');
            $table->string('websiteportfolio')->after('linkedinprofile');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('basic_bios', function (Blueprint $table) {
            $table->dropColumn(['experience_level','linkedinprofile','websiteportfolio']);
        });
    }
};
