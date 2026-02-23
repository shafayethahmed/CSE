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
        Schema::create('faculty', function (Blueprint $table) {
            $table->id();
            $table->string('faculty_id')->unique(); // Custom ID (year + serial)
            $table->string('name',255);
            $table->string('email')->unique();
            $table->string('designation');
            $table->string('bachelor_degree')->nullable();
            $table->string('bachelor_university')->nullable();
            $table->string('bachelor_cgpa')->nullable();
            $table->string('master_degree')->nullable();
            $table->string('master_university')->nullable();
            $table->string('master_cgpa')->nullable();
            $table->enum('faculty_status',['active','inactive'])->default('active');
            $table->enum('role',['lecturer','department-head'])->default('lecturer');
            $table->string('password');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faculty');
    }
};
