<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>GourmetGo - Restaurants</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
          rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <!-- Restaurant CSS -->
    <link rel="stylesheet" href="{{ asset('css/R.css') }}">

</head>


<body>


<!-- =====================================================
     HEADER
===================================================== -->

<header class="main-header">

    <div class="header-container">


        <!-- LOGO -->

        <a href="{{ route('home') }}"
           class="logo">

            <div class="logo-icon">

                <i class="fa-solid fa-utensils"></i>

            </div>

            <span>
                GourmetGo
            </span>

        </a>


        <!-- NAVIGATION -->

        <nav class="main-nav">

            <a href="{{ route('home') }}">
                home
            </a>

            <a href="{{ route('Menu') }}">
                Menu
            </a>

            <a href="{{ url('Restaurants') }}"
               class="active">
                Restaurants
            </a>

            <a href="{{ url('Offers') }}">
                Offers
            </a>


        </nav>


        <!-- RIGHT MENU -->

        <div class="header-right">


            <!-- LOCATION -->

            <div class="delivery-address">

                <i class="fa-solid fa-location-dot"></i>

                <span>
                    Enter Delivery Address
                </span>

            </div>


            <!-- CART -->

            <a href="#cart"
               class="cart-icon">

                <i class="fa-solid fa-cart-shopping"></i>

            </a>


            <!-- LOGIN -->

            <a href="{{ url('login') }}"
               class="login-btn">

                Login

            </a>


            <!-- SIGN UP -->

            <a href="{{ url('profile') }}"
               class="signup">

                👤 Profile

            </a>

        </div>

    </div>

</header>



<!-- =====================================================
     RESTAURANT HERO
===================================================== -->

<section class="restaurant-hero">


    <img src="{{ asset('banner.png') }}"
         alt="The Patio House">


    <div class="hero-overlay">


        <!-- RESTAURANT LOGO -->

        <div class="restaurant-logo">

            PH

        </div>


        <!-- RESTAURANT INFORMATION -->

        <div class="restaurant-info">

            <h1>
                The Patio House
            </h1>

            <p>
                Italian Restaurant
                • 4.5 ★
                • Outdoor Seating
            </p>


            <div class="rating">

                <span>
                    ⭐ 4.7
                </span>

                <span>
                    125 Reviews
                </span>

                <span>
                    20-30 min
                </span>

            </div>

        </div>

    </div>

</section>



<!-- =====================================================
     RESTAURANT CONTENT
===================================================== -->

<section class="restaurant-section">

    <div class="restaurant-container">


        <!-- =================================================
             LEFT MENU
        ================================================== -->

        <main class="restaurant-menu">


            <!-- CATEGORIES -->

            <div class="categories">

                <button class="active">
                    Must Try
                </button>

                <button>
                    Starters
                </button>

                <button>
                    Main Course
                </button>

                <button>
                    Desserts
                </button>

                <button>
                    Drinks
                </button>

            </div>



            <!-- =================================================
                 MUST TRY
            ================================================== -->

            <h2 class="section-title">
                Must Try
            </h2>


            <!-- FOOD CARD -->

            <div class="food-card">


                <img src="{{ asset('burger.png') }}"
                     alt="Truffle Burger">


                <div class="food-details">

                    <h3>
                        Signature Truffle Burger
                    </h3>

                    <p>
                        Juicy beef patty, fresh lettuce,
                        cheese and truffle sauce.
                    </p>

                </div>


                <div class="price">

                    <h3>
                        $24
                    </h3>

                    <button>
                        Add
                    </button>

                </div>

            </div>



            <!-- FOOD CARD -->

            <div class="food-card">


                <img src="{{ asset('pizza.png') }}"
                     alt="Pizza">


                <div class="food-details">

                    <h3>
                        Signature Pizza
                    </h3>

                    <p>
                        Fresh pizza baked with creamy
                        cheese and delicious toppings.
                    </p>

                </div>


                <div class="price">

                    <h3>
                        $42
                    </h3>

                    <button>
                        Add
                    </button>

                </div>

            </div>



            <!-- =================================================
                 STARTERS
            ================================================== -->

            <h2 class="section-title">
                Starters
            </h2>


            <!-- FOOD CARD -->

            <div class="food-card">


                <img src="{{ asset('salad.png') }}"
                     alt="Artisanal Burrata">


                <div class="food-details">

                    <h3>
                        Artisanal Burrata
                    </h3>

                    <p>
                        Creamy burrata served with
                        fresh tomatoes and herbs.
                    </p>

                </div>


                <div class="price">

                    <h3>
                        $18
                    </h3>

                    <button>
                        Add
                    </button>

                </div>

            </div>



            <!-- FOOD CARD -->

            <div class="food-card">


                <img src="{{ asset('calamari.png') }}"
                     alt="Crispy Calamari">


                <div class="food-details">

                    <h3>
                        Crispy Calamari
                    </h3>

                    <p>
                        Golden fried calamari with
                        garlic dip.
                    </p>

                </div>


                <div class="price">

                    <h3>
                        $16
                    </h3>

                    <button>
                        Add
                    </button>

                </div>

            </div>



            <!-- =================================================
                 MAIN COURSE
            ================================================== -->

            <h2 class="section-title">
                Main Course
            </h2>


            <div class="food-card">


                <img src="{{ asset('pizza.png') }}"
                     alt="Italian Pizza">


                <div class="food-details">

                    <h3>
                        Italian Special Pizza
                    </h3>

                    <p>
                        Traditional Italian pizza with
                        fresh vegetables and mozzarella.
                    </p>

                </div>


                <div class="price">

                    <h3>
                        $28
                    </h3>

                    <button>
                        Add
                    </button>

                </div>

            </div>


        </main>



        <!-- =================================================
             CART
        ================================================== -->

        <aside class="cart-box"
               id="cart">


            <h3>
                Your Cart
            </h3>


            <!-- CART ITEM -->

            <div class="cart-item">

                <img src="{{ asset('burger.png') }}"
                     alt="Truffle Burger">

                <div>

                    <h4>
                        Truffle Burger
                    </h4>

                    <p>
                        $24.00
                    </p>

                </div>

            </div>


            <!-- CART ITEM -->

            <div class="cart-item">

                <img src="{{ asset('calamari.png') }}"
                     alt="Crispy Calamari">

                <div>

                    <h4>
                        Crispy Calamari
                    </h4>

                    <p>
                        $16.00
                    </p>

                </div>

            </div>


            <hr>


            <!-- SUBTOTAL -->

            <div class="cart-row">

                <span>
                    Subtotal
                </span>

                <span>
                    $40
                </span>

            </div>


            <!-- DELIVERY -->

            <div class="cart-row">

                <span>
                    Delivery Fee
                </span>

                <span>
                    $4
                </span>

            </div>


            <!-- TOTAL -->

            <div class="cart-row total">

                <span>
                    Total
                </span>

                <span>
                    $44
                </span>

            </div>


            <!-- CHECKOUT -->

            <button class="checkout">

                Proceed To Checkout

            </button>


            <!-- OFFER -->

            <div class="offer">

                <h4>
                    Get Unlimited Free Delivery
                </h4>

                <p>
                    Subscribe Now
                </p>

            </div>

        </aside>

    </div>

</section>



<!-- =====================================================
     NEWSLETTER
===================================================== -->

<section class="newsletter">


    <div class="newsletter-container">


        <div class="newsletter-text">

            <h2>
                Join our Newsletter
            </h2>

            <p>
                Get the latest restaurant offers
                and discounts.
            </p>

        </div>


        <form class="newsletter-form">

            <input type="email"
                   placeholder="Enter your email"
                   required>

            <button type="submit">
                Subscribe
            </button>

        </form>

    </div>

</section>



<!-- =====================================================
     FOOTER
===================================================== -->

<footer>


    <div class="footer-content">


        <!-- ABOUT -->

        <div class="footer-column">

            <h3>
                GourmetGo
            </h3>

            <p>
                The best food delivery website
                for delicious meals.
            </p>

        </div>


        <!-- COMPANY -->

        <div class="footer-column">

            <h4>
                Company
            </h4>

            <a href="#">
                About
            </a>

            <a href="#">
                Career
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

            <h4>
                Support
            </h4>

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


        <!-- DOWNLOAD -->

        <div class="footer-column">

            <h4>
                Download
            </h4>

            <a href="#"
               class="download-btn">

                <i class="fa-brands fa-apple"></i>
                App Store

            </a>

            <a href="#"
               class="download-btn">

                <i class="fa-brands fa-google-play"></i>
                Google Play

            </a>

        </div>


    </div>


    <!-- FOOTER BOTTOM -->

    <div class="footer-bottom">

        © 2026 GourmetGo. All Rights Reserved.

    </div>

</footer>


</body>

</html>