@extends('layouts.app')

@section('title', 'Class Details: ' . $class->name)

@section('content')
    <h1 style="border-bottom: 2px solid #ddd; padding-bottom: 10px;">{{ $class->name }} ({{ $class->year }})</h1>

    <div style="margin-bottom: 20px;">
        <p><strong>Course:</strong> {{ $class->course->name }}</p>
        <p><strong>Teacher:</strong> {{ $class->teacher->name }} ({{ $class->teacher->email }})</p>
        <p><strong>Total Students:</strong> {{ $class->students->count() }}</p>
    </div>

    <h2 style="margin-top: 30px;">Enrolled Students</h2>
    @if ($class->students->isEmpty())
        <p>No students are currently enrolled in this class.</p>
    @else
        <table class="data-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Joined</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($class->students as $student)
                    <tr>
                        <td>{{ $student->name }}</td>
                        <td>{{ $student->email }}</td>
                        <td>{{ $student->pivot->created_at ? $student->pivot->created_at->format('M d, Y') : 'N/A' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
    
    <div style="margin-top: 20px;">
        <a href="{{ route('classes.edit', $class) }}" class="btn btn-warning">Edit Class</a>
        <a href="{{ route('classes.index') }}" class="back-link" style="margin-left: 10px;">← Back to Classes</a>
    </div>
@endsection