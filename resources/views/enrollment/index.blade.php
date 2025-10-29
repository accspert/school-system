@extends('layouts.app')

@section('title', 'Available Classes for Enrollment')

@section('content')
    <h1>Available Classes</h1>
    <p>Select any class below to sign up. You will automatically be added to the class roster.</p>

    @if ($availableClasses->isEmpty())
        <p>There are currently no classes available for you to enroll in.</p>
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
                @foreach ($availableClasses as $class)
                    <tr>
                        <td>{{ $class->name }}</td>
                        <td>{{ $class->course->name ?? 'N/A' }}</td>
                        <td>{{ $class->teacher->name ?? 'N/A' }}</td>
                        <td>{{ $class->year }}</td>
                        <td>
                            <form action="{{ route('enrollment.enroll', $class) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-primary" onclick="return confirm('Sign up for {{ $class->name }}?')">Sign Up</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    
    <a href="{{ route('dashboard') }}" class="back-link">← Back to Dashboard</a>
@endsection