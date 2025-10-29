@extends('layouts.app')

@section('title', 'Admin/Teacher Dashboard')

@section('content')
    <h1>Welcome, {{ Auth::user()->name }}!</h1>
    <p>You have **{{ strtoupper(Auth::user()->role) }}** privileges. Use the navigation above to manage the system.</p>
    
    <h2 style="margin-top: 30px;">Management Quick Links</h2>
    <div style="display: flex; gap: 15px; margin-bottom: 40px;">
        <a href="{{ route('courses.index') }}" class="btn btn-info">Manage Courses</a>
        <a href="{{ route('classes.index') }}" class="btn btn-info">Manage Classes</a>
        @if (Auth::user()->role === 'admin')
            <a href="{{ route('admin.users.index') }}" class="btn btn-info">Manage Users</a>
        @endif
    </div>
    
    @if (Auth::user()->role === 'teacher' || Auth::user()->role === 'admin')
        <h2 style="border-bottom: 2px solid #ddd; padding-bottom: 10px;">Your Assigned Classes ({{ $classesTaught->count() }})</h2>

        @if ($classesTaught->isEmpty())
            <p>You are currently not assigned to teach any classes.</p>
        @else
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Class Name</th>
                        <th>Course</th>
                        <th>Students Enrolled</th>
                        <th>Year</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($classesTaught as $class)
                        <tr>
                            <td>{{ $class->name }}</td>
                            <td>{{ $class->course->name ?? 'N/A' }}</td>
                            <td>{{ $class->students->count() }}</td>
                            <td>{{ $class->year }}</td>
                            <td>
                                {{-- Link to the Class Show page to view the roster --}}
                                <a href="{{ route('classes.show', $class) }}" class="btn btn-info">View Roster</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    @endif
@endsection