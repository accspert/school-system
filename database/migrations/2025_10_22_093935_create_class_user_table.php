<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Laravel's convention for pivot tables is singular alphabetical names: class_user
        Schema::create('class_user', function (Blueprint $table) {
            
            // Foreign key for the Class
            $table->foreignId('class_id')->constrained()->onDelete('cascade');
            
            // Foreign key for the User (Student)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Set the primary key as a composite of the two columns to ensure uniqueness
            $table->primary(['class_id', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('class_user');
    }
};
