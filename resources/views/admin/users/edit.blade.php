@extends('layouts.app')

@section('title', 'Edit User: ' . $user->name)

@section('content')
    <h1>Edit User: {{ $user->name }}</h1>

    <form action="{{ route('admin.users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" class="form-control" 
                   value="{{ old('name', $user->name) }}" required>
            @error('name')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" class="form-control" 
                   value="{{ old('email', $user->email) }}" required>
            @error('email')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="role">Change Role:</label>
            <select id="role" name="role" class="form-control" required>
                @foreach ($roles as $role)
                    <option value="{{ $role }}" {{ old('role', $user->role) == $role ? 'selected' : '' }}>
                        {{ ucfirst($role) }}
                    </option>
                @endforeach
            </select>
            @error('role')
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

        <button type="submit" class="btn btn-warning">Update User</button>
    </form>

    <a href="{{ route('admin.users.index') }}" class="back-link">← Back to User List</a>
@endsection