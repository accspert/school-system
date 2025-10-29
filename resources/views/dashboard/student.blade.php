@extends('layouts.app')

@section('title', 'Student Dashboard')

@section('content')
    <h1>Welcome back, {{ Auth::user()->name }}!</h1>
    <p>Your current role is **Student**. Use this dashboard to view your enrolled classes.</p>
    
    <div style="margin-top: 30px; display: flex; justify-content: space-between; align-items: center;">
        <h2>My Enrolled Classes ({{ $enrolledClasses->count() }})</h2>
        <a href="{{ route('enrollment.index') }}" class="btn btn-primary">Enroll in a New Class</a>
    </div>

    @if ($enrolledClasses->isEmpty())
        <p>You are not currently enrolled in any classes. Click the button above to sign up!</p>
    @else
        <table class="data-table">
            <thead>
                <tr>
                    <th>Class Name</th>
                    <th>Course</th>
                    <th>Teacher</th>
                    <th>Year</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($enrolledClasses as $class)
                    <tr>
                        <td>{{ $class->name }}</td>
                        <td>{{ $class->course->name ?? 'N/A' }}</td>
                        <td>{{ $class->teacher->name ?? 'N/A' }}</td>
                        <td>{{ $class->year }}</td>
                        <td>
                            <form action="{{ route('enrollment.unenroll', $class) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to drop {{ $class->name }}?')">Drop Class</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection