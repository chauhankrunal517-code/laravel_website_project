<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>GourmetGo - Food Delivery</title>

    <!-- Google Font -->
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

</head>

<body>

<!-- =====================================================
     HEADER
===================================================== -->

<header class="main-header">

    <div class="header-container">

        <!-- LOGO -->

        <a href="{{ route('login') }}" class="logo">

            <div class="logo-icon">
                <i class="fa-solid fa-utensils"></i>
            </div>

            <span>GourmetGo</span>

        </a>


        <!-- NAVIGATION -->

        <nav class="main-nav">

            <a href="{{ route('login') }}" class="active">
                Home
            </a>

            <a href="{{ route('login') }}">
                Menu
            </a>

            <a href="{{ route('login') }}">
                Restaurants
            </a>


        </nav>


        <!-- RIGHT SIDE -->

        <div class="header-right">

            <!-- DELIVERY ADDRESS -->

            <div class="delivery-address">

                <i class="fa-solid fa-location-dot"></i>

                <span>
                    Enter Delivery Address
                </span>

            </div>


            <!-- CART -->

            <a href="#" class="cart-icon">

                <i class="fa-solid fa-cart-shopping"></i>

            </a>


            <!-- LOGIN -->

            <a href="{{ url('login') }}" class="login-btn">
                Login
            </a>


            <!-- SIGN UP -->

            <a href="{{ url('Profile') }}" class="signup-btn">
                👤 Profile
            </a>

        </div>

    </div>

</header>


<!-- =====================================================
     HERO SECTION
===================================================== -->

<section class="hero">

    <div class="hero-container">

        <!-- HERO TEXT -->

        <div class="hero-content">

            <span class="hero-small-title">
                Fastest Delivery In Town
            </span>

            <h1>

                Fresh &amp;

                <br>

                <span>Delicious</span>

                <br>

                Food Delivered

                <br>

                to Your Door

            </h1>

            <p>

                Order your favourite meals from the best
                restaurants near you.

                <br>

                Fast, fresh and delivered under 30 minutes.

            </p>


            <!-- SEARCH -->

            <div class="hero-search">

                <input
                    type="text"
                    placeholder="Search food or restaurant...">

                <button type="button">

                    <i class="fa-solid fa-magnifying-glass"></i>

                    Search

                </button>

            </div>


            <!-- HERO RATING -->

            <div class="hero-rating">

                <div class="rating-stars">
                    ★★★★★
                </div>

                <strong>
                    4.9
                </strong>

                <span>
                    Rating
                </span>

                <div class="rating-divider"></div>

                <i class="fa-solid fa-clock"></i>

                <strong>
                    20 Min
                </strong>

                <span>
                    Delivery
                </span>

            </div>

        </div>


        <!-- HERO IMAGE -->

        <div class="hero-image">

            <div class="hero-circle">

                <img
                    src="{{ asset('burger.png') }}"
                    alt="Delicious Food">

            </div>


            <!-- PRICE TAG -->

            <div class="price-tag">

                <span>
                    Starting from
                </span>

                <strong>
                    $18.99
                </strong>

            </div>

        </div>

    </div>

</section>


<!-- =====================================================
     EXPLORE MENU
===================================================== -->

<section class="menu-section">

    <div class="section-title">

        <h2>
            Explore Menu
        </h2>

        <p>
            Discover delicious food by categories
        </p>

    </div>


    <div class="category-grid">


        <!-- PIZZA -->

        <div class="category active">

            <div class="category-img">

                <img
                    src="{{ asset('pizza.png') }}"
                    alt="Pizza">

            </div>

            <h3>
                Pizza
            </h3>

            <span>
                12 Items
            </span>

        </div>


        <!-- ITALIAN -->

        <div class="category">

            <div class="category-img">

                <img
                    src="{{ asset('italian.png') }}"
                    alt="Italian">

            </div>

            <h3>
                Italian
            </h3>

            <span>
                18 Items
            </span>

        </div>


        <!-- DESSERT -->

        <div class="category">

            <div class="category-img">

                <img
                    src="{{ asset('dessert.png') }}"
                    alt="Dessert">

            </div>

            <h3>
                Dessert
            </h3>

            <span>
                15 Items
            </span>

        </div>

    </div>

</section>


<!-- =====================================================
     POPULAR DISHES
===================================================== -->

<section class="popular-section">

    <div class="section-title popular-title">

        <div>

            <h2>
                Popular Dishes
            </h2>

            <p>
                Our most loved dishes
            </p>

        </div>


        <a
            href="{{ route('Menu') }}"
            class="view-all">

            View All →

        </a>

    </div>


    <div class="food-grid">


        <!-- =================================================
             FOOD CARD 1
        ================================================== -->

        <div class="food-card">

            <div class="food-image">

                <img
                    src="{{ asset('burger.png') }}"
                    alt="Double Cheese Burger">

                <span class="badge">
                    Popular
                </span>

            </div>


            <div class="food-content">

                <div class="rating">

                    <i class="fa-solid fa-star"></i>

                    <span>
                        4.8
                    </span>

                    <small>
                        (120)
                    </small>

                </div>


                <h3>
                    Double Cheese Burger
                </h3>


                <p class="restaurant">

                    <i class="fa-solid fa-store"></i>

                    Burger Hub

                </p>


                <div class="food-bottom">

                    <div class="price">

                        <small>
                            Starting from
                        </small>

                        <strong>
                            $12.99
                        </strong>

                    </div>


                    <!-- PLUS BUTTON -->
                    <!-- CLICK = MENU PAGE -->

                    <a
                        href="{{ route('Menu') }}"
                        class="add-btn"
                        title="Go to Menu">

                        <i class="fa-solid fa-plus"></i>

                    </a>

                </div>

            </div>

        </div>


        <!-- =================================================
             FOOD CARD 2
        ================================================== -->

        <div class="food-card">

            <div class="food-image">

                <img
                    src="{{ asset('pizza.png') }}"
                    alt="Margherita Pizza">

                <span class="badge">
                    Best Seller
                </span>

            </div>


            <div class="food-content">

                <div class="rating">

                    <i class="fa-solid fa-star"></i>

                    <span>
                        4.9
                    </span>

                    <small>
                        (98)
                    </small>

                </div>


                <h3>
                    Margherita Pizza
                </h3>


                <p class="restaurant">

                    <i class="fa-solid fa-store"></i>

                    Pizza House

                </p>


                <div class="food-bottom">

                    <div class="price">

                        <small>
                            Starting from
                        </small>

                        <strong>
                            $15.50
                        </strong>

                    </div>


                    <!-- PLUS BUTTON -->
                    <!-- CLICK = MENU PAGE -->

                    <a
                        href="{{ route('Menu') }}"
                        class="add-btn"
                        title="Go to Menu">

                        <i class="fa-solid fa-plus"></i>

                    </a>

                </div>

            </div>

        </div>


        <!-- =================================================
             FOOD CARD 3
        ================================================== -->

        <div class="food-card">

            <div class="food-image">

                <img
                    src="{{ asset('Paneer.png') }}"
                    alt="Paneer Butter Masala">


                <button
                    type="button"
                    class="favorite">

                    <i class="fa-regular fa-heart"></i>

                </button>


                <span class="badge">
                    Chef Choice
                </span>

            </div>


            <div class="food-content">

                <div class="rating">

                    <i class="fa-solid fa-star"></i>

                    <span>
                        4.7
                    </span>

                    <small>
                        (86)
                    </small>

                </div>


                <h3>
                    Paneer Butter Masala
                </h3>


                <p class="restaurant">

                    <i class="fa-solid fa-store"></i>

                    Indian Spice

                </p>


                <div class="food-bottom">

                    <div class="price">

                        <small>
                            Starting from
                        </small>

                        <strong>
                            $18.00
                        </strong>

                    </div>


                    <!-- PLUS BUTTON -->
                    <!-- CLICK = MENU PAGE -->

                    <a
                        href="{{ route('Menu') }}"
                        class="add-btn"
                        title="Go to Menu">

                        <i class="fa-solid fa-plus"></i>

                    </a>

                </div>

            </div>

        </div>


        <!-- =================================================
             FOOD CARD 4
        ================================================== -->

        <div class="food-card">

            <div class="food-image">

                <img
                    src="{{ asset('chinese.png') }}"
                    alt="Chinese Bell">


                <button
                    type="button"
                    class="favorite">

                    <i class="fa-regular fa-heart"></i>

                </button>


                <span class="badge">
                    Trending
                </span>

            </div>


            <div class="food-content">

                <div class="rating">

                    <i class="fa-solid fa-star"></i>

                    <span>
                        4.6
                    </span>

                    <small>
                        (72)
                    </small>

                </div>


                <h3>
                    Chinese Bell
                </h3>


                <p class="restaurant">

                    <i class="fa-solid fa-store"></i>

                    Chinese Bell

                </p>


                <div class="food-bottom">

                    <div class="price">

                        <small>
                            Starting from
                        </small>

                        <strong>
                            $14.50
                        </strong>

                    </div>


                    <!-- PLUS BUTTON -->
                    <!-- CLICK = MENU PAGE -->

                    <a
                        href="{{ route('Menu') }}"
                        class="add-btn"
                        title="Go to Menu">

                        <i class="fa-solid fa-plus"></i>

                    </a>

                </div>

            </div>

        </div>

    </div>

</section>


<!-- =====================================================
     FOOTER
===================================================== -->

<footer class="footer">

    <div class="footer-container">


        <!-- BRAND -->

        <div class="footer-brand">

            <a
                href="{{ route('home') }}"
                class="footer-logo">

                <div class="footer-logo-icon">

                    <i class="fa-solid fa-utensils"></i>

                </div>

                <span>
                    GourmetGo
                </span>

            </a>


            <p class="tagline">
                Fresh Flavors, Fast Delivery.
            </p>


            <p class="footer-description">

                Delicious meals from your favourite
                restaurants delivered fresh and fast
                to your door.

            </p>


            <div class="social-icons">

                <a href="#">
                    <i class="fa-brands fa-facebook-f"></i>
                </a>

                <a href="#">
                    <i class="fa-brands fa-instagram"></i>
                </a>

                <a href="#">
                    <i class="fa-brands fa-twitter"></i>
                </a>

                <a href="#">
                    <i class="fa-brands fa-linkedin-in"></i>
                </a>

            </div>

        </div>


        <!-- COMPANY -->

        <div class="footer-column">

            <h3>
                Company
            </h3>

            <a href="#">
                About Us
            </a>

            <a href="#">
                Careers
            </a>

            <a href="#">
                Blog
            </a>

            <a href="#">
                Contact
            </a>

        </div>


        <!-- SUPPORT -->

        <div class="footer-column">

            <h3>
                Support
            </h3>

            <a href="#">
                Help Center
            </a>

            <a href="#">
                FAQ
            </a>

            <a href="#">
                Terms
            </a>

            <a href="#">
                Privacy
            </a>

        </div>


        <!-- APP -->

        <div class="footer-column">

            <h3>
                Download App
            </h3>


            <a
                href="#"
                class="app-button">

                <i class="fa-brands fa-apple"></i>

                App Store

            </a>


            <a
                href="#"
                class="app-button">

                <i class="fa-brands fa-google-play"></i>

                Google Play

            </a>

        </div>

    </div>


    <!-- FOOTER BOTTOM -->

    <div class="footer-bottom">

        <span>
            © 2026 GourmetGo. All Rights Reserved.
        </span>


        <div>

            <a href="#">
                Privacy Policy
            </a>

            <a href="#">
                Terms of Service
            </a>

        </div>

    </div>

</footer>


</body>

</html>