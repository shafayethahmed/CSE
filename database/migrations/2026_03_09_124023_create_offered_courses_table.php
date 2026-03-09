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
        Schema::create('offered_courses', function (Blueprint $table) {
            $table->id();
            $table->enum('semester',['1-1','1-2','2-1','2-2','3-1','3-2','4-1','4-2']);
            $table->string('course_code');
            $table->string('course_title');
            $table->string('course_credit');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offered_courses');
    }
};
