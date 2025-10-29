<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Classes;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    // 1. Relationship: TEACHER (User) to Courses (One-to-Many)
    // Get the courses taught by this teacher. This is optional based on design, 
    // but the teacher is linked to the Class, which links to the Course.
    public function courses()
    {
        // Assumes a Teacher is linked to a Course (though we linked Teacher to Class in migration)
        return $this->hasMany(Course::class, 'teacher_id'); 
    }

    // 2. Relationship: TEACHER (User) to Classes (One-to-Many)
    public function classesTaught()
    {
        // A Teacher can teach many Classes
        return $this->hasMany(Classes::class, 'teacher_id');
    }

    // 3. Relationship: STUDENT (User) to Classes (Many-to-Many)
    public function classesEnrolled()
    {
        // A Student is enrolled in many classes. The pivot table is 'class_user' (Laravel default).
        return $this->belongsToMany(Classes::class, 'class_user', 'user_id', 'class_id');
    }

    // Helper method to check role (useful for middleware and views)
    public function isTeacher()
    {
        return $this->role === 'teacher';
    }
    
}
