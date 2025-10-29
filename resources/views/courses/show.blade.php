@extends('layouts.app')

@section('title', 'Course Details: ' . $course->name)

@section('content')
    <h1 style="border-bottom: 2px solid #ddd; padding-bottom: 10px;">{{ $course->name }}</h1>

    <div style="margin-bottom: 20px;">
        <p><strong>ID:</strong> {{ $course->id }}</p>
        <p><strong>Created:</strong> {{ $course->created_at->format('M d, Y') }}</p>
    </div>

    <h2 style="margin-top: 30px;">Description</h2>
    <p style="line-height: 1.6;">{{ $course->description ?? 'No description provided.' }}</p>

    {{-- Since Courses don't directly own classes in the model design, this is simpler for now --}}
    
    <a href="{{ route('courses.index') }}" class="back-link">← Back to Courses</a>
@endsection