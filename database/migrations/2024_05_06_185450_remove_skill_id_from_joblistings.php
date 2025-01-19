<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('joblistings', function (Blueprint $table) {
            // Drop the foreign key constraint
            $table->dropForeign(['skill_id']); // Use the exact name of the foreign key constraint if not default
            // Drop the skill_id column
            $table->dropColumn('skill_id');
        });
    }

    public function down()
    {
        Schema::table('joblistings', function (Blueprint $table) {
            // Re-add the skill_id column
            $table->unsignedBigInteger('skill_id');
            $table->foreign('skill_id')->references('id')->on('skills')->onDelete('cascade');
        });
    }
};
