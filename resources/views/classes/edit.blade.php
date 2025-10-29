@extends('layouts.app')

@section('title', 'Edit Class: ' . $class->name)

@section('content')
    <h1>Edit Class: {{ $class->name }}</h1>

    <form action="{{ route('classes.update', $class) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Class Name:</label>
            <input type="text" id="name" name="name" class="form-control" 
                   value="{{ old('name', $class->name) }}" required>
            @error('name')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="year">Academic Year:</label>
            <input type="number" id="year" name="year" class="form-control" 
                   value="{{ old('year', $class->year) }}" required min="2000" max="2100">
            @error('year')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="course_id">Select Course:</label>
            <select id="course_id" name="course_id" class="form-control" required>
                <option value="">-- Choose Course --</option>
                @foreach ($courses as $course)
                    <option value="{{ $course->id }}" {{ old('course_id', $class->course_id) == $course->id ? 'selected' : '' }}>
                        {{ $course->name }}
                    </option>
                @endforeach
            </select>
            @error('course_id')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="teacher_id">Assign Teacher:</label>
            <select id="teacher_id" name="teacher_id" class="form-control" required>
                <option value="">-- Choose Teacher --</option>
                @foreach ($teachers as $teacher)
                    <option value="{{ $teacher->id }}" {{ old('teacher_id', $class->teacher_id) == $teacher->id ? 'selected' : '' }}>
                        {{ $teacher->name }} ({{ $teacher->email }})
                    </option>
                @endforeach
            </select>
            @error('teacher_id')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="btn btn-warning">Update Class</button>
    </form>

    <a href="{{ route('classes.index') }}" class="back-link">← Back to Classes</a>
@endsection