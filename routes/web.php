<?php
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

// Admin/Teacher Controllers
use App\Http\Controllers\Admin\TeacherManagementController;
use App\Http\Controllers\Admin\UserManagementController;

// Student Controllers
use App\Http\Controllers\Student\EnrollmentController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
| Routes accessible by anyone (unauthenticated users).
*/

// Root URL (Your custom Welcome Page)
Route::get('/', function () {
    return view('welcome');
});


/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
| All routes within this group require the user to be logged in (auth).
*/

Route::middleware(['auth', 'verified'])->group(function () {
    
    // 1. CUSTOM DASHBOARD LOGIC (Handles role-based view loading)

    Route::get('/dashboard', function () {
        $user = User::find(Auth::id());
        
        $classesTaught = collect();
    // TEACHER/ADMIN LOGIC
        if ($user->role === 'teacher' || $user->role === 'admin') {
            // Fetch classes taught by this user, eager loading course and students
            $classesTaught = $user->classesTaught()->with('course', 'students')->get();
        }
        
        // Load admin/teacher dashboard, passing the classes taught
        return view('dashboard.admin', compact('classesTaught')); 

        if ($user->role === 'student') {
            // Load student dashboard with enrolled classes
            $enrolledClasses = $user->classesEnrolled()->with('course', 'teacher')->get();
            return view('dashboard.student', compact('enrolledClasses'));
        } 
        
        // Load admin/teacher dashboard
        return view('dashboard.admin');
    })->name('dashboard');


    // 2. STUDENT ENROLLMENT ROUTES
    Route::controller(EnrollmentController::class)->prefix('enrollment')->group(function () {
        Route::get('/', 'index')->name('enrollment.index');          // View all available classes
        Route::post('/{class}', 'enroll')->name('enrollment.enroll'); // Sign up for a class
        Route::delete('/{class}', 'unenroll')->name('enrollment.unenroll'); // Drop a class
    });


    // 3. CORE MANAGEMENT (Courses & Classes) - Restricted to Admins/Teachers
    Route::resource('courses', CourseController::class)
        ->middleware('is.teacher'); 

    Route::resource('classes', ClassController::class)
        ->middleware('is.teacher');


    // 4. ADMIN MANAGEMENT (Users & Teachers) - Restricted to Admin role only
    // User Management (for editing roles, names, passwords)
    Route::resource('admin/users', UserManagementController::class)
        ->names('admin.users')
        ->middleware('is.admin');
        
    // Teacher Management (if you still need a dedicated teacher creation form)
    Route::resource('admin/teachers', TeacherManagementController::class)
        ->names('admin.teachers')
        ->middleware('is.admin'); 
        

    // 5. PROFILE ROUTES (Standard Breeze/Laravel profile pages)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';