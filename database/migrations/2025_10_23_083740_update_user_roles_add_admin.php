<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop the old column definition (required to redefine an ENUM)
            $table->dropColumn('role'); 
        });

        Schema::table('users', function (Blueprint $table) {
            // Add the new column definition with 'admin' included
            $table->enum('role', ['student', 'teacher', 'admin'])->default('student')->after('email');
        });
    }

    public function down(): void
    {
        // Revert the column back if needed
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['student', 'teacher'])->default('student')->after('email');
        });
    }
};