<?php

namespace Database\Seeders;

use App\Models\Classes;
use App\Models\Course;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

// database/seeders/DatabaseSeeder.php

// ... (other use statements)

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create a dedicated Admin User
        User::firstOrCreate(
            ['email' => 'admin@school.com'],
            [
                'name' => 'Super Admin',
                'role' => 'admin',
                'password' => Hash::make('password'),
            ]
        );

        // 2. Create 5 Teachers (non-admin)
        $teachers = User::factory()->count(5)->teacher()->create();

        // 3. Create 10 Courses
        $courses = Course::factory()->count(10)->create();

        // 4. Create 10 Classes and associate them with courses and teachers
        Classes::factory()->count(10)->create();

        // ... (rest of the seeding logic remains the same)
    }
}