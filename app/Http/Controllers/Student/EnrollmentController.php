<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Classes; 
use App\Models\User;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnrollmentController extends Controller
{
    /**
     * Show available classes for a student to enroll in.
     */
    public function index()
    {
        // 1. Get the current student's ID
        $studentId = Auth::id();
        
        // 2. Get all classes the student is NOT currently enrolled in
        $availableClasses = Classes::with('course', 'teacher')
            ->whereDoesntHave('students', function ($query) use ($studentId) {
                $query->where('user_id', $studentId);
            })
            ->orderBy('year', 'desc')
            ->get();

        return view('enrollment.index', compact('availableClasses'));
    }

    /**
     * Enroll the student into the specified class.
     */public function enroll(Classes $class) 
    {
        $user = User::find(Auth::id());
        
        // Quick check to ensure only students can enroll
        if ($user->role !== 'student') {
             return redirect()->route('dashboard')->with('error', 'Only students can enroll in classes.');
        }

        // Attach the student to the class using the many-to-many relationship
        $user->classesEnrolled()->attach($class->id);

        return redirect()->route('dashboard')->with('success', 'Successfully signed up for ' . $class->name . '!');
    }

    /**
     * Unenroll the student from the specified class.
     */
    public function unenroll(Classes $class)
    {
        $user = User::find(Auth::id());

        // Detach the student from the class (removing the pivot record)
        $user->classesEnrolled()->detach($class->id);

        return redirect()->route('dashboard')->with('success', 'Successfully dropped ' . $class->name . '.');
    }
}