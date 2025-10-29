<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class TeacherManagementController extends Controller
{

    protected $model = User::class;

 
    public function index()
    {
        // Fetch only users with the 'teacher' role
        $teachers = User::where('role', 'teacher')->orderBy('name')->get();
        
        return view('admin.teachers.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new teacher user.
     */
    public function create()
    {
        return view('admin.teachers.create');
    }

    /**
     * Store a newly created teacher user.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'teacher', // CRITICAL: Force the role to 'teacher'
        ]);

        return redirect()->route('admin.teachers.index')->with('success', 'Teacher created successfully!');
    }

    /**
     * Show the form for editing the specified teacher user.
     */
    public function edit(User $teacher)
    {
        // Ensure only teachers can be edited through this panel
        if ($teacher->role !== 'teacher') {
            abort(404);
        }
        return view('admin.teachers.edit', compact('teacher'));
    }

    /**
     * Update the specified teacher user.
     */
    public function update(Request $request, User $teacher)
    {
        // Ensure only teachers are updated and they don't change their role away from 'teacher'
        if ($teacher->role !== 'teacher') {
             abort(403, 'Permission Denied.');
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            // Ignore the current user's ID when checking uniqueness
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $teacher->id], 
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
        ]);
        
        $data = $request->only('name', 'email');

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $teacher->update($data);

        return redirect()->route('admin.teachers.index')->with('success', 'Teacher updated successfully!');
    }

    /**
     * Remove the specified teacher user.
     */
    public function destroy(User $teacher)
    {
        if ($teacher->role !== 'teacher') {
            abort(403, 'Permission Denied.');
        }
        
        $teacher->delete();

        return redirect()->route('admin.teachers.index')->with('success', 'Teacher deleted successfully!');
    }
}