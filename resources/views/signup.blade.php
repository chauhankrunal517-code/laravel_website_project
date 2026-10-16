<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GourmetGo Registration</title>

    <!-- CSS -->
     <link rel="stylesheet" href="{{ asset('css/s.css') }}">
<!-- Font Awesome -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">


</head>

<body>

<div class="container">

    <!-- LEFT SECTION -->

    <div class="left">

        <!-- Logo -->
        <div class="logo">
            <img src="{{ asset('logo1.png') }}" alt="Logo">
            <h2>Gourmet<span>Go</span></h2>
        </div>

        <h1>
            Gourmet<span>Go</span><br>
            Today
        </h1>

        <p>
            Create your account and enjoy delicious meals,
            quick checkout, live order tracking and exclusive rewards.
        </p>

        <!-- Features -->

        <div class="features">

            <div class="feature">
                <i class="fa-solid fa-gift"></i>

                <div>
                    <h4>Exclusive Offers</h4>
                    <small>Enjoy member discounts</small>
                </div>
            </div>

            <div class="feature">
                <i class="fa-solid fa-truck-fast"></i>

                <div>
                    <h4>Fast Delivery</h4>
                    <small>Delivery in 20 minutes</small>
                </div>
            </div>

            <div class="feature">
                <i class="fa-solid fa-location-dot"></i>

                <div>
                    <h4>Live Tracking</h4>
                    <small>Track your order live</small>
                </div>
            </div>

            <div class="feature">
                <i class="fa-solid fa-seedling"></i>

                <div>
                    <h4>Fresh Quality</h4>
                    <small>Fresh ingredients daily</small>
                </div>
            </div>

        </div>

    
       
        <!-- Food Images -->

        <div class="food-images">
            <img src="{{ asset('pizza.png') }}">
            <img src="{{ asset('burger.png') }}">
            <img src="{{ asset('sandwich.png') }}">
        </div>

        <!-- Statistics -->

        <div class="stats">

            <div class="box">
                <i class="fa-solid fa-star"></i>
                <h2>4.9</h2>
                <span>Customer Rating</span>
            </div>

            <div class="box">
                <i class="fa-solid fa-clock"></i>
                <h2>20-Min</h2>
                <span>Delivery Time</span>
            </div>

            <div class="box">
                <i class="fa-solid fa-users"></i>
                <h2>10K+</h2>
                <span>Happy Customers</span>
            </div>

            <div class="box">
                <i class="fa-solid fa-store"></i>
                <h2>500+</h2>
                <span>Top Restaurants</span>
            </div>

        </div>

    </div>

    <!-- RIGHT SECTION -->

    <div class="right">

        <div class="signup-card">

            <!-- Top Logo -->

            

            <h1>Create Account</h1>

            <p class="sub-text">
                Fill in the details below to get started.
            </p>

            <!-- Form -->

            <form action="{{ route('signup.store') }}" method="POST">

    @csrf
                @if ($errors->any())
                    <div style="background:#fff1f1;color:#d63031;padding:12px 15px;border-radius:10px;margin-bottom:15px;font-size:13px;">
                        {{ $errors->first() }}
                    </div>
                @endif

                @if (session('success'))
                    <div style="background:#effff4;color:#168a45;padding:12px 15px;border-radius:10px;margin-bottom:15px;font-size:13px;">
                        {{ session('success') }}
                    </div>
                @endif


    <input
        type="text"
        name="name" autocomplete="name"
        placeholder="Full Name"
        required
    >

    <input
        type="email"
        name="email" autocomplete="email"
        placeholder="Email Address"
        required
    >

    <input
        type="password"
        name="password" autocomplete="new-password"
        placeholder="Password"
        required
    >

    <input
        type="password"
        name="password_confirmation" autocomplete="new-password"
        placeholder="Confirm Password"
        required
    >

    <button type="submit">
        Create Account
    </button>

</form>
            <!-- Divider -->

            <div class="divider">
                <span>OR SIGN UP WITH</span>
            </div>

            <!-- Social Buttons -->

            <div class="social">

                <button>
                    <img src="{{ asset('google.png') }}">
                    Google
                </button>

                <button>
                    <img src="{{ asset('apple.png') }}">
                    Apple
                </button>

                <button>
                    <img src="{{ asset('facebook.png') }}">
                    Facebook
                </button>

            </div>

            <!-- Login -->

            <div class="Login-link">

                Already have an account?

                <a href="{{ route('login') }}">Login</a>

            </div>

        </div>

    </div>

</div>

</body>
</html>