<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>School System - @yield('title')</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="header">
        <div class="logo">
            <a href="{{ route('dashboard') }}">School System</a>
        </div>
<nav>
            <a href="{{ route('dashboard') }}">Dashboard</a>
            
            @auth
                {{-- Link to Course/Class Management (Only for Admin/Teacher) --}}
                @if (Auth::user()->role === 'teacher' || Auth::user()->role === 'admin')
                    <a href="{{ route('courses.index') }}">Courses</a>
                    <a href="{{ route('classes.index') }}">Classes</a>
                @endif
                
                {{-- NEW: Enrollment Link (Only for Students) --}}
                @if (Auth::user()->role === 'student')
                    <a href="{{ route('enrollment.index') }}" 
                       style="color: #4caf50; font-weight: 700;">Enroll in Classes</a>
                @endif

                {{-- Admin Management Link (Only for Admin) --}}
                @if (Auth::user()->role === 'admin')
                    <a href="{{ route('admin.users.index') }}" 
                       style="color: #ffeb3b; font-weight: 700;">User Management</a>
                @endif
                
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                        Log Out ({{ Auth::user()->name }})
                    </a>
                </form>
            @endauth
        </nav>
    </div>

    <main class="container">
        @if (session('success'))
            <div style="background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; padding: 10px; margin-bottom: 20px; border-radius: 4px;">
                {{ session('success') }}
            </div>
        @endif
        @if ($errors->any())
            <div style="background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; padding: 10px; margin-bottom: 20px; border-radius: 4px;">
                Please fix the following errors:
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        @yield('content')
    </main>
</body>
</html>