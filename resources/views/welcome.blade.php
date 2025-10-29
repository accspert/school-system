<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome to the School System</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <style>
        /* Add some specific styling for the welcome page */
        .welcome-page {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            text-align: center;
            background-color: #f4f7f6; /* Match body background */
            padding: 20px;
        }
        .welcome-card {
            background-color: white;
            padding: 40px 60px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        .welcome-card h1 {
            color: #3f51b5; /* Indigo */
            font-size: 2.5rem;
            margin-bottom: 10px;
        }
        .welcome-card p {
            color: #555;
            font-size: 1.2rem;
            margin-bottom: 30px;
        }
        .public-nav a {
            font-size: 1.1rem;
            margin: 0 15px;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s;
        }
        .public-nav .btn-login {
            background-color: #4caf50; /* Green */
            color: white;
        }
        .public-nav .btn-register {
            background-color: #2196f3; /* Blue */
            color: white;
        }
        .public-nav a:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body>
    <div class="welcome-page">
        <div class="welcome-card">
            <h1>Welcome to the School Management System</h1>
            <p>Your centralized hub for managing courses, classes, teachers, and students.</p>

            <div class="public-nav">
                @if (Route::has('login'))
                    @auth
                        {{-- If user is logged in, show a button to the dashboard --}}
                        <a href="{{ url('/dashboard') }}" class="btn-login">Go to Dashboard</a>
                    @else
                        {{-- If user is not logged in, show login and register links --}}
                        <a href="{{ route('login') }}" class="btn-login">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn-register">Register</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </div>
</body>
</html>