@extends('layouts.app')

@section('title', 'Manage Teachers')

@section('content')
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h1>Manage Teachers</h1>
        <a href="{{ route('admin.teachers.create') }}" class="btn btn-primary">Add New Teacher</a>
    </div>

    @if ($teachers->isEmpty())
        <p>No teacher accounts found.</p>
    @else
        <table class="data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($teachers as $teacher)
                    <tr>
                        <td>{{ $teacher->id }}</td>
                        <td>{{ $teacher->name }}</td>
                        <td>{{ $teacher->email }}</td>
                        <td>
                            <a href="{{ route('admin.teachers.edit', $teacher) }}" class="btn btn-warning">Edit</a>
                            
                            <form action="{{ route('admin.teachers.destroy', $teacher) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('WARNING: Deleting this teacher will remove them from all assigned classes. Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <a href="{{ route('dashboard') }}" class="back-link">← Back to Dashboard</a>
@endsection