@extends('layouts.app')

@section('title', 'Create New Class')

@section('content')
    <h1>Create New Class</h1>

    <form action="{{ route('classes.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Class Name (e.g., 101 Math - Fall):</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required>
            @error('name')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="year">Academic Year:</label>
            <input type="number" id="year" name="year" class="form-control" 
                   value="{{ old('year', date('Y')) }}" required min="2000" max="2100">
            @error('year')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="course_id">Select Course:</label>
            <select id="course_id" name="course_id" class="form-control" required>
                <option value="">-- Choose Course --</option>
                @foreach ($courses as $course)
                    <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>
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
                    <option value="{{ $teacher->id }}" {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>
                        {{ $teacher->name }} ({{ $teacher->email }})
                    </option>
                @endforeach
            </select>
            @error('teacher_id')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Create Class</button>
    </form>

    <a href="{{ route('classes.index') }}" class="back-link">← Back to Classes</a>
@endsection