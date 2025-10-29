@extends('layouts.app')

@section('title', 'Class Schedule')

@section('content')
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h1>All Classes</h1>
        <a href="{{ route('classes.create') }}" class="btn btn-primary">Create New Class</a>
    </div>

    @if ($classes->isEmpty())
        <p>No classes have been defined yet. Start by creating one!</p>
    @else
        <table class="data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Class Name</th>
                    <th>Year</th>
                    <th>Course</th>
                    <th>Teacher</th>
                    <th>Students</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($classes as $class)
                    <tr>
                        <td>{{ $class->id }}</td>
                        <td>{{ $class->name }}</td>
                        <td>{{ $class->year }}</td>
                        <td>{{ $class->course->name ?? 'N/A' }}</td>
                        <td>{{ $class->teacher->name ?? 'N/A' }}</td>
                        <td>{{ $class->students->count() }}</td>
                        <td>
                            <a href="{{ route('classes.show', $class) }}" class="btn btn-info">View</a>
                            
                            <a href="{{ route('classes.edit', $class) }}" class="btn btn-warning">Edit</a>
                            
                            <form action="{{ route('classes.destroy', $class) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete the class: {{ $class->name }}? This will also unenroll all students.')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection