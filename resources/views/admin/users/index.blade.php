@extends('layouts.app')

@section('title', 'User Management')

@section('content')
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h1>Manage All Users</h1>
        {{-- You might link to a Teacher/Student creation form here if desired --}}
    </div>

    @if ($users->isEmpty())
        <p>No non-admin users found.</p>
    @else
        <table class="data-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td><span style="text-transform: capitalize;">{{ $user->role }}</span></td>
                        <td>
                            <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-warning">Edit Role/User</a>
                            
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete {{ $user->name }}? This is permanent.')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <a href="{{ route('dashboard') }}" class="back-link">← Back to Dashboard</a>
@endsection