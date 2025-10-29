@extends('layouts.app')

@section('title', 'Course List')

@section('content')
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h1>All Courses</h1>
        <a href="{{ route('courses.create') }}" class="btn btn-primary">Add New Course</a>
    </div>

    @if ($courses->isEmpty())
        <p>No courses found. Start by adding one!</p>
    @else
        <table class="data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($courses as $course)
                    <tr>
                        <td>{{ $course->id }}</td>
                        <td>{{ $course->name }}</td>
                        <td>{{ Str::limit($course->description, 50) }}</td>
                        <td>
                            <a href="{{ route('courses.show', $course) }}" class="btn btn-info">View</a>
                            
                            <a href="{{ route('courses.edit', $course) }}" class="btn btn-warning">Edit</a>
                            
                            <form action="{{ route('courses.destroy', $course) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this course?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection