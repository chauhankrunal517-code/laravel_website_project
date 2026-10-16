<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GourmetGo Login</title>
    <link rel="stylesheet" href="{{ asset('css/l.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
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

        <h3>Welcome Back to</h3>
        <h1>Gourmet<span>Go</span></h1>
        <p class="description">Sign in to enjoy delicious meals, exclusive offers, and lightning-fast delivery right to your doorstep.</p>

        <div class="feature-row">
            <div class="feature-card"><i class="fa-solid fa-star"></i><h4>4.9</h4><span>Customer Rating</span></div>
            <div class="feature-card"><i class="fa-solid fa-truck-fast"></i><h4>20-Min</h4><span>Fast Delivery</span></div>
            <div class="feature-card"><i class="fa-solid fa-gift"></i><h4>Daily</h4><span>Special Offers</span></div>
            <div class="feature-card"><i class="fa-solid fa-seedling"></i><h4>100%</h4><span>Fresh Ingredients</span></div>
        </div>
    </div>

    <div class="right">
        <div class="login-card">
            <h1>Login</h1>
            <p class="sub-title">Access your GourmetGo account to continue ordering your favorite meals.</p>

            @if(session('success'))
                <div class="success-message">{{ session('success') }}</div>
            @endif

            @if($errors->any())
                <div class="error-message">{{ $errors->first() }}</div>
            @endif

            <form action="{{ route('userlogin') }}" method="POST">
                @csrf

                <div class="input-box">
                    <i class="fa-solid fa-user-shield"></i>
                    <select name="login_type" required>
                        <option value="">Login As</option>
                        <option value="user" {{ old('login_type') === 'user' ? 'selected' : '' }}>User</option>
                        <option value="admin" {{ old('login_type') === 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                </div>

                <div class="input-box">
                    <i class="fa-solid fa-envelope"></i>
                    <input type="email" name="email" placeholder="Email Address" value="{{ old('email') }}" required>
                </div>

                <div class="input-box">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" name="password" placeholder="Password" required>
                </div>

                <div class="remember">
                    <label><input type="checkbox" name="remember"> Remember Me</label>
                    <a href="{{ route('forgot.password') }}">Forgot Password?</a>
                </div>

                <button type="submit" class="login-btn">
                    Login <i class="fa-solid fa-arrow-right"></i>
                </button>
            </form>

            <div class="signup-link">
                Don't have an account?
                <a href="{{ route('signup') }}">Create Account</a>
            </div>
        </div>
    </div>
</div>

<div class="footer">
    <div><i class="fa-solid fa-shield-halved"></i>100% Secure Payments</div>
    <div><i class="fa-solid fa-headset"></i>24/7 Customer Support</div>
    <div><i class="fa-solid fa-lock"></i>Your data is safe with us</div>
</div>
</body>
</html>
