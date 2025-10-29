<?php

namespace App\Http\Controllers;

use App\Models\Course; // Import the Course Model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; // For explicit validation

class CourseController extends Controller
{
    /**
     * Display a listing of the resource (READ: index).
     */
    public function index()
    {
        $courses = Course::orderBy('name')->get();
        // Pass the courses data to the 'courses.index' view
        return view('courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource (CREATE: form).
     */
    public function create()
    {
        return view('courses.create');
    }

    /**
     * Store a newly created resource in storage (CREATE: store).
     */
    public function store(Request $request)
    {
        // 1. Validate the incoming request data
        $request->validate([
            'name' => 'required|unique:courses|max:255',
            'description' => 'nullable|string',
        ]);

        // 2. Create and save the new Course
        Course::create($request->all());

        // 3. Redirect with a success message
        return redirect()->route('courses.index')->with('success', 'Course created successfully!');
    }

    /**
     * Display the specified resource (READ: show).
     */
    public function show(Course $course)
    {
        // The $course variable is automatically loaded by Laravel (Route Model Binding)
        return view('courses.show', compact('course'));
    }

    /**
     * Show the form for editing the specified resource (UPDATE: form).
     */
    public function edit(Course $course)
    {
        return view('courses.edit', compact('course'));
    }

    /**
     * Update the specified resource in storage (UPDATE: update).
     */
    public function update(Request $request, Course $course)
    {
        // 1. Validate the incoming request data
        $request->validate([
            // Rule: name must be unique, but ignore the current course's ID
            'name' => 'required|max:255|unique:courses,name,' . $course->id,
            'description' => 'nullable|string',
        ]);

        // 2. Update the Course record
        $course->update($request->all());

        // 3. Redirect with a success message
        return redirect()->route('courses.index')->with('success', 'Course updated successfully!');
    }

    /**
     * Remove the specified resource from storage (DELETE: destroy).
     */
    public function destroy(Course $course)
    {
        // 1. Delete the Course
        $course->delete();

        // 2. Redirect back
        return redirect()->route('courses.index')->with('success', 'Course deleted successfully!');
    }
}