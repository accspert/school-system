<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserManagementController extends Controller
{
    /**
     * Display a listing of all non-admin users.
     */
    public function index()
    {
        // Fetch all users who are NOT 'admin'
        $users = User::where('role', '!=', 'admin')->orderBy('name')->get();
        
        return view('admin.users.index', compact('users'));
    }

    // You can add create and store methods here if you want a general user creation form.
    
    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $user)
    {
        // SECURITY CHECK: Admin cannot edit the super admin user
        if ($user->role === 'admin') {
            return redirect()->route('admin.users.index')->with('error', 'Cannot edit the primary administrator account.');
        }
        
        // Define all available roles (excluding 'admin' for demotion safety, if desired)
        // We'll include 'admin' to allow for promoting a backup admin
        $roles = ['student', 'teacher', 'admin']; 

        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified user.
     */
    public function update(Request $request, User $user)
    {
        // SECURITY CHECK: Admin cannot edit the super admin user
        if ($user->role === 'admin' && $user->id !== $request->user()->id) {
            return redirect()->route('admin.users.index')->with('error', 'Cannot modify the primary administrator account.');
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'role' => ['required', 'in:student,teacher,admin'], // Validate the role change
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
        ]);
        
        $data = $request->only('name', 'email', 'role'); // Capture the role change

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.users.index')->with('success', 'User updated and role changed successfully!');
    }

    /**
     * Remove the specified user.
     */
    public function destroy(User $user)
    {
        // SECURITY CHECK: Admin cannot delete the super admin user
        if ($user->role === 'admin') {
            return redirect()->route('admin.users.index')->with('error', 'Cannot delete the primary administrator account.');
        }
        
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully!');
    }
}