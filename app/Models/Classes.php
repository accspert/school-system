<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model // <-- Make sure to match your file name
{
    use HasFactory;
    
    // Default table name is 'class_models', but we used 'classes' in migration, so override it.
    protected $table = 'classes';
    protected $fillable = ['name', 'year', 'course_id', 'teacher_id'];

    // 1. Relationship: Class to Course (One-to-Many Inverse)
    public function course()
    {
        // A Class belongs to one Course
        return $this->belongsTo(Course::class);
    }

    // 2. Relationship: Class to Teacher (One-to-Many Inverse)
    public function teacher()
    {
        // A Class belongs to one Teacher (User)
        return $this->belongsTo(User::class, 'teacher_id');
    }

    // 3. Relationship: Class to Students (Many-to-Many)
    public function students()
    {
        // A Class has many Students (Users). The pivot table is 'class_user'.
        return $this->belongsToMany(User::class, 'class_user', 'class_id', 'user_id');
    }
}
