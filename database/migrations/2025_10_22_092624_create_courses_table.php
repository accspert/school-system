<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // e.g., "Mathematics"
            $table->text('description')->nullable();
            // We'll link this to a teacher later, but for now, keep it simple.
            $table->timestamps(); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
