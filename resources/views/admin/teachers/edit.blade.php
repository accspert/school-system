@extends('layouts.app')

@section('title', 'Edit Teacher: ' . $teacher->name)

@section('content')
    <h1>Edit Teacher: {{ $teacher->name }}</h1>

    <form action="{{ route('admin.teachers.update', $teacher) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" class="form-control" 
                   value="{{ old('name', $teacher->name) }}" required>
            @error('name')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" class="form-control" 
                   value="{{ old('email', $teacher->email) }}" required>
            @error('email')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="password">New Password (leave blank to keep current):</label>
            <input type="password" id="password" name="password" class="form-control">
            @error('password')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="password_confirmation">Confirm New Password:</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
        </div>

        <button type="submit" class="btn btn-warning">Update Teacher Account</button>
    </form>

    <a href="{{ route('admin.teachers.index') }}" class="back-link">← Back to Teacher List</a>
@endsection