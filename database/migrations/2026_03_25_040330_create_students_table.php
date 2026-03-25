<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\Mime\Email;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('academicId',20)->unique();
            $table->string('email')->unique();
            $table->string('name');
            $table->enum('session',['spring','summer']);
            $table->year('admissionYear');
            $table->enum('semester',['1-1','1-2','2-1','2-2','3-1','3-2','4-1','4-2']);
            $table->string('mobile',15);
            $table->date('dob');
            $table->text('address');
            $table->timestamps();
            $table->index('academicId');
            $table->index('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
