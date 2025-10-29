<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description'];

    // 1. Relationship: Course to Classes (One-to-Many)
    public function classes()
    {
        // A Course has many Classes (sections/groups)
        return $this->hasMany(Classes::class); 
    }


    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

}
