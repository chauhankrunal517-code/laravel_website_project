<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - GourmetGo</title>
    <link rel="stylesheet" href="{{ asset('css/l.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
<div class="auth-simple">
    <div class="auth-card">
        <div class="brand-small"><img src="{{ asset('logo1.png') }}" alt="GourmetGo"><h2>Gourmet<span>Go</span></h2></div>
        <h1>Reset Password</h1>
        <p>Create a new password for your account.</p>

        @if($errors->any())
            <div class="error-message">{{ $errors->first() }}</div>
        @endif

        <form action="{{ route('password.update') }}" method="POST">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="input-box"><i class="fa-solid fa-envelope"></i><input type="email" name="email" value="{{ $email }}" placeholder="Email Address" required></div>
            <div class="input-box"><i class="fa-solid fa-lock"></i><input type="password" name="password" placeholder="New Password" required></div>
            <div class="input-box"><i class="fa-solid fa-lock"></i><input type="password" name="password_confirmation" placeholder="Confirm New Password" required></div>

            <button class="login-btn" type="submit">Change Password <i class="fa-solid fa-check"></i></button>
        </form>

        <div class="signup-link"><a href="{{ route('login') }}">Back to Login</a></div>
    </div>
</div>
</body>
</html>
