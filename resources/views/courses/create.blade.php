@extends('layouts.app')

@section('title', 'Create New Course')

@section('content')
    <h1>Create New Course</h1>

    <form action="{{ route('courses.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Course Name:</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required>
            @error('name')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <textarea id="description" name="description" class="form-control" rows="5">{{ old('description') }}</textarea>
            @error('description')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Create Course</button>
    </form>

    <a href="{{ route('courses.index') }}" class="back-link">← Back to Courses</a>
@endsection