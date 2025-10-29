<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Course; 
use App\Models\User;   
use Illuminate\Http\Request;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource (READ: index).
     */
    public function index()
    {
        // Fetch classes and eagerly load their related course and teacher for efficiency
        $classes = Classes::with(['course', 'teacher'])->orderBy('year', 'desc')->get();
        
        // Pass the classes data to the 'classes.index' view
        return view('classes.index', compact('classes'));
    }

    /**
     * Show the form for creating a new resource (CREATE: form).
     */
    public function create()
    {
        // Fetch necessary data for the form dropdowns
        $courses = Course::orderBy('name')->get();
        // Fetch only users with the 'teacher' role for assignment
        $teachers = User::where('role', 'teacher')->orderBy('name')->get(); 

        return view('classes.create', compact('courses', 'teachers'));
    }

    /**
     * Store a newly created resource in storage (CREATE: store).
     */
    public function store(Request $request)
    {
        // 1. Validate the incoming request data
        $request->validate([
            'name' => 'required|unique:classes|max:255',
            'year' => 'required|integer|digits:4',
            'course_id' => 'required|exists:courses,id',
            'teacher_id' => 'required|exists:users,id',
        ]);

        // 2. Create and save the new Classes record
        Classes::create($request->all());

        // 3. Redirect with a success message
        return redirect()->route('classes.index')->with('success', 'Class created successfully!');
    }

    /**
     * Display the specified resource (READ: show).
     */
    public function show(Classes $class)
    {
        // Route model binding retrieves the class. Eager load relationships for the show view.
        $class->load('course', 'teacher', 'students');
        
        return view('classes.show', compact('class'));
    }

    /**
     * Show the form for editing the specified resource (UPDATE: form).
     */
    public function edit(Classes $class)
    {
        // Fetch necessary data for the form dropdowns, just like in the create method
        $courses = Course::orderBy('name')->get();
        $teachers = User::where('role', 'teacher')->orderBy('name')->get(); 

        return view('classes.edit', compact('class', 'courses', 'teachers'));
    }

    /**
     * Update the specified resource in storage (UPDATE: update).
     */
    public function update(Request $request, Classes $class)
    {
        // 1. Validate the incoming request data
        $request->validate([
            // Rule: name must be unique, but ignore the current class's ID
            'name' => 'required|max:255|unique:classes,name,' . $class->id,
            'year' => 'required|integer|digits:4',
            'course_id' => 'required|exists:courses,id',
            'teacher_id' => 'required|exists:users,id',
        ]);

        // 2. Update the Classes record
        $class->update($request->all());

        // 3. Redirect with a success message
        return redirect()->route('classes.index')->with('success', 'Class updated successfully!');
    }

    /**
     * Remove the specified resource from storage (DELETE: destroy).
     */
    public function destroy(Classes $class)
    {
        // 1. Delete the Classes record
        $class->delete();

        // 2. Redirect back
        return redirect()->route('classes.index')->with('success', 'Class deleted successfully!');
    }
}