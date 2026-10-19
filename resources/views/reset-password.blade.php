
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Reset Password - GourmetGo</title>

    <link rel="stylesheet" href="{{ asset('css/l.css') }}">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
          rel="stylesheet">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>

<body>

<div class="container">

    <div class="left">

        <div class="logo">
            <img src="{{ asset('logo1.png') }}" alt="Logo">

            <div>
                <h2>Gourmet<span>Go</span></h2>
                <p>Fresh Flavors, Fast Delivery.</p>
            </div>
        </div>

        <h3>Reset Your</h3>
        <h1>Gourmet<span>Go</span></h1>

        <p class="description">
            Create a new secure password to get back
            to your GourmetGo account.
        </p>

        <div class="feature-row">

            <div class="feature-card">
                <i class="fa-solid fa-envelope"></i>
                <h4>Email</h4>
                <span>Verify Account</span>
            </div>

            <div class="feature-card">
                <i class="fa-solid fa-key"></i>
                <h4>New</h4>
                <span>Password</span>
            </div>

            <div class="feature-card">
                <i class="fa-solid fa-shield-halved"></i>
                <h4>Secure</h4>
                <span>Account</span>
            </div>

            <div class="feature-card">
                <i class="fa-solid fa-lock"></i>
                <h4>Safe</h4>
                <span>Login</span>
            </div>

        </div>
    </div>

    <div class="right">

        <div class="login-card">

            <h1>Reset Password</h1>

            <p class="sub-title">
                Enter and confirm your new password.
            </p>

            @if(session('success'))
                <div class="success-message">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="error-message">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('password.update.custom') }}"
                  method="POST">

                @csrf

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="input-box">
                    <i class="fa-solid fa-envelope"></i>

                    <input
                        type="email"
                        name="email"
                        placeholder="Registered Email Address"
                        value="{{ old('email', $email) }}"
                        required>
                </div>

                <div class="input-box">
                    <i class="fa-solid fa-lock"></i>

                    <input
                        type="password"
                        name="password"
                        placeholder="New Password (minimum 6 characters)"
                        minlength="6"
                        required>
                </div>

                <div class="input-box">
                    <i class="fa-solid fa-lock"></i>

                    <input
                        type="password"
                        name="password_confirmation"
                        placeholder="Confirm New Password"
                        minlength="6"
                        required>
                </div>

                <button type="submit" class="login-btn">
                    Reset Password
                    <i class="fa-solid fa-key"></i>
                </button>

            </form>

            <div class="signup-link">
                Remember your password?
                <a href="{{ route('login') }}">Back to Login</a>
            </div>

        </div>
    </div>

</div>

<div class="footer">

    <div>
        <i class="fa-solid fa-shield-halved"></i>
        100% Secure Payments
    </div>

    <div>
        <i class="fa-solid fa-headset"></i>
        24/7 Customer Support
    </div>

    <div>
        <i class="fa-solid fa-lock"></i>
        Your data is safe with us
    </div>

</div>

</body>
</html>
