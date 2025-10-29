<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // e.g., "Grade 10A"
            $table->integer('year'); // e.g., 2025

            // Foreign Key to link to the Course model
            $table->foreignId('course_id')->constrained()->onDelete('cascade'); 
            
            // Foreign Key to link to the Teacher (User) model
            // The table is 'users', so we constrain to that.
            $table->foreignId('teacher_id')->constrained('users')->onDelete('restrict'); 

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('classes');
    }
};