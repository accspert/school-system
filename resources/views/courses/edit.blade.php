@extends('layouts.app')

@section('title', 'Edit Course: ' . $course->name)

@section('content')
    <h1>Edit Course: {{ $course->name }}</h1>

    <form action="{{ route('courses.update', $course) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Course Name:</label>
            <input type="text" id="name" name="name" class="form-control" 
                   value="{{ old('name', $course->name) }}" required>
            @error('name')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <textarea id="description" name="description" class="form-control" rows="5">{{ old('description', $course->description) }}</textarea>
            @error('description')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="btn btn-warning">Update Course</button>
    </form>

    <a href="{{ route('courses.index') }}" class="back-link">← Back to Courses</a>
@endsection