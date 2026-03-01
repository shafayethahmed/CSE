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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();

            $table->string('course_code')->unique();   // e.g., CSE401
            $table->string('course_title');            // e.g., Machine Learning
            $table->enum('course_credit', ['1.0','1.5','2.0','2.5','3.0','3.5','4.0','4.5','5.0']);            $table->enum('semester', ['1-1','1-2','2-1','2-2','3-1','3-2','4-1','4-2' ]);
            $table->enum('course_type', ['theory','lab','project']);
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
