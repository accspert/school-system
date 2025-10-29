@extends('layouts.app')

@section('title', 'Add New Teacher')

@section('content')
    <h1>Add New Teacher</h1>

    <form action="{{ route('admin.teachers.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required>
            @error('name')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
            @error('email')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" class="form-control" required>
            @error('password')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="password_confirmation">Confirm Password:</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Create Teacher Account</button>
    </form>

    <a href="{{ route('admin.teachers.index') }}" class="back-link">← Back to Teacher List</a>
@endsection