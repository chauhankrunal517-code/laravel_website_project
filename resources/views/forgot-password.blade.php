
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Forgot Password - GourmetGo</title>

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

        <h3>Recover Your</h3>

        <h1>Gourmet<span>Go</span></h1>

        <p class="description">
            Forgot your password? No worries.
            Enter your registered email address and
            we will send you a secure password reset link.
        </p>

        <div class="feature-row">

            <div class="feature-card">
                <i class="fa-solid fa-envelope"></i>
                <h4>Email</h4>
                <span>Reset Link</span>
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

            <h1>Forgot Password?</h1>

            <p class="sub-title">
                Enter your registered email to receive a reset link.
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

            <form action="{{ route('password.email.custom') }}"
                  method="POST">

                @csrf

                <div class="input-box">
                    <i class="fa-solid fa-envelope"></i>

                    <input
                        type="email"
                        name="email"
                        placeholder="Registered Email Address"
                        value="{{ old('email') }}"
                        required>
                </div>

                <button type="submit" class="login-btn">
                    Send Reset Link
                    <i class="fa-solid fa-paper-plane"></i>
                </button>

            </form>

            <div class="signup-link">
                Remember your password?
                <a href="{{ route('login') }}">Back to Login</a>
            </div>
            
            <div class="signup-link">
                <a href="{{ route('forgot.password') }}">
                    Forgot Password?
                </a>
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
