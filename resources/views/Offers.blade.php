<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Premium Truffle Burger - GourmetGo</title>


    <!-- Google Font -->

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
          rel="stylesheet">


    <!-- Font Awesome -->

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">


    <!-- Custom CSS -->

    <link rel="stylesheet"
          href="{{ asset('css/o.css') }}">

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

            <a href="{{ route('Restaurants') }}">
                Restaurants
            </a>

            <a href="{{ url('Offers') }}"
               class="active">
                Offers
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

            <a href="{{ route('cart.index') }}" class="cart-icon">

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
     MAIN
===================================================== -->

<main class="page-container">


    <!-- BREADCRUMB -->

    <div class="breadcrumb">

        <a href="{{ route('home') }}">
            Home
        </a>

        <span>/</span>

        <a href="{{ url('Menu') }}">
            Burgers
        </a>

        <span>/</span>

        <strong>
            Premium Truffle Burger
        </strong>

    </div>



    <!-- =================================================
         PRODUCT SECTION
    ================================================== -->

    <section class="product-section">


        <!-- PRODUCT IMAGES -->

        <div class="product-images">


            <div class="main-image">

                <img src="{{ asset('burger.png') }}"
                     alt="Premium Truffle Burger">

            </div>


            <!-- THUMBNAILS -->

            <div class="thumbnail-list">

                <img src="{{ asset('burger.png') }}"
                     alt="Burger">

                <img src="{{ asset('burger.png') }}"
                     alt="Burger">

                <img src="{{ asset('burger.png') }}"
                     alt="Burger">

                <img src="{{ asset('burger.png') }}"
                     alt="Burger">

            </div>

        </div>



        <!-- =================================================
             PRODUCT INFORMATION
        ================================================== -->

        <div class="product-info">


            <!-- BADGE -->

            <span class="badge">
                BEST SELLER
            </span>


            <h1>
                Premium Truffle Burger
            </h1>


            <!-- RATING -->

            <div class="rating">

                <span class="stars">
                    ★★★★★
                </span>

                <span>
                    4.9
                </span>

                <span class="reviews">
                    124 Reviews
                </span>

                <span class="available">
                    ● In Stock
                </span>

            </div>


            <!-- PRICE -->

            <div class="price">

                ₹145

                <del>
                    ₹200
                </del>

            </div>


            <!-- DESCRIPTION -->

            <p class="description">

                Elevate your taste buds with our signature
                Premium Truffle Burger, crafted with premium
                ingredients and served with fresh vegetables,
                creamy truffle sauce, and perfectly cooked beef.

            </p>



            <!-- FEATURES -->

            <div class="features">


                <div>

                    <i class="fas fa-leaf"></i>

                    <span>
                        Fresh Ingredients
                    </span>

                </div>


                <div>

                    <i class="fas fa-fire"></i>

                    <span>
                        Chef Special
                    </span>

                </div>


                <div>

                    <i class="fas fa-clock"></i>

                    <span>
                        20-30 min delivery
                    </span>

                </div>

            </div>



            <!-- NUTRITION -->

            <h3 class="nutrition-title">
                Nutrition Facts
            </h3>


            <div class="nutrition">


                <div>

                    <strong>
                        750 kcal
                    </strong>

                    <span>
                        Calories
                    </span>

                </div>


                <div>

                    <strong>
                        42g
                    </strong>

                    <span>
                        Protein
                    </span>

                </div>


                <div>

                    <strong>
                        48g
                    </strong>

                    <span>
                        Fat
                    </span>

                </div>


                <div>

                    <strong>
                        56g
                    </strong>

                    <span>
                        Carbs
                    </span>

                </div>

            </div>



            <!-- CART ACTION -->

            <div class="cart-action">


                <div class="quantity">

                    <button>
                        -
                    </button>

                    <span>
                        1
                    </span>

                    <button>
                        +
                    </button>

                </div>


                <button class="add-cart">

                    <i class="fas fa-cart-plus"></i>

                    Add to Cart

                </button>

            </div>


            <!-- BUY NOW -->

            <button class="buy-now">

                Buy Now

            </button>


        </div>

    </section>



    <!-- =================================================
         REVIEWS
    ================================================== -->

    <section class="reviews-section">


        <div class="section-heading">

            <h2>
                Customer Reviews
            </h2>

            <a href="#">
                Write a Review
            </a>

        </div>


        <div class="review-grid">


            <!-- REVIEW 1 -->

            <div class="review-card">


                <div class="review-user">

                    <img src="{{ asset('user1.png') }}"
                         alt="Customer">

                    <div>

                        <h4>
                            Sophia Martinez
                        </h4>

                        <span>
                            ★★★★★
                        </span>

                    </div>

                </div>


                <p>

                    Absolutely delicious! The truffle flavor
                    was amazing and the burger was cooked
                    perfectly.

                </p>


                <img class="review-food"
                     src="{{ asset('burger.png') }}"
                     alt="Food">

            </div>



            <!-- REVIEW 2 -->

            <div class="review-card">


                <div class="review-user">

                    <img src="{{ asset('user2.png') }}"
                         alt="Customer">

                    <div>

                        <h4>
                            James Anderson
                        </h4>

                        <span>
                            ★★★★★
                        </span>

                    </div>

                </div>


                <p>

                    One of the best burgers I've ever had.
                    Excellent quality and great taste.

                </p>


                <img class="review-food"
                     src="{{ asset('burger.png') }}"
                     alt="Food">

            </div>



            <!-- REVIEW 3 -->

            <div class="review-card">


                <div class="review-user">

                    <img src="{{ asset('user3.png') }}"
                         alt="Customer">

                    <div>

                        <h4>
                            Emily Wilson
                        </h4>

                        <span>
                            ★★★★★
                        </span>

                    </div>

                </div>


                <p>

                    Super tasty and fresh. The delivery was
                    fast and everything arrived perfectly.

                </p>


                <img class="review-food"
                     src="{{ asset('burger.png') }}"
                     alt="Food">

            </div>

        </div>

    </section>



    <!-- =================================================
         RECOMMENDED
    ================================================== -->

    <section class="recommend-section">


        <div class="section-heading">

            <h2>
                You Might Also Like
            </h2>


            <div class="slider-buttons">

                <button>
                    ‹
                </button>

                <button>
                    ›
                </button>

            </div>

        </div>


        <div class="product-grid">


            <!-- PRODUCT 1 -->

            <div class="food-card">


                <div class="food-image">

                    <img src="{{ asset('Zinger.png') }}"
                         alt="Spicy Zinger">

                    <span>
                        ♡
                    </span>

                </div>


                <h3>
                    Spicy Zinger
                </h3>


                <div class="food-price">
                    ₹145
                </div>


                <button>
                    Add to Cart
                </button>

            </div>



            <!-- PRODUCT 2 -->

            <div class="food-card">


                <div class="food-image">

                    <img src="{{ asset('casual-double.png') }}"
                         alt="Classic Double">

                    <span>
                        ♡
                    </span>

                </div>


                <h3>
                    Classic Double
                </h3>


                <div class="food-price">
                    ₹135
                </div>


                <button>
                    Add to Cart
                </button>

            </div>



            <!-- PRODUCT 3 -->

            <div class="food-card">


                <div class="food-image">

                    <img src="{{ asset('burger.png') }}"
                         alt="The Garden Burger">

                    <span>
                        ♡
                    </span>

                </div>


                <h3>
                    The Garden Burger
                </h3>


                <div class="food-price">
                    ₹130
                </div>


                <button>
                    Add to Cart
                </button>

            </div>



            <!-- PRODUCT 4 -->

            <div class="food-card">


                <div class="food-image">

                    <img src="{{ asset('bbq-bacon.png') }}"
                         alt="BBQ Bacon King">

                    <span>
                        ♡
                    </span>

                </div>


                <h3>
                    BBQ Bacon King
                </h3>


                <div class="food-price">
                    ₹200
                </div>


                <button>
                    Add to Cart
                </button>

            </div>

        </div>

    </section>



    <!-- =================================================
         NEWSLETTER
    ================================================== -->

    <section class="newsletter">


        <h2>
            Join our Newsletter
        </h2>


        <p>

            Get the latest restaurant offers,
            exclusive deals, and delicious updates
            straight to your inbox.

        </p>


        <form>

            <input type="email"
                   placeholder="Enter your email"
                   required>

            <button type="submit">
                Subscribe
            </button>

        </form>

    </section>


</main>



<!-- =====================================================
     FOOTER
===================================================== -->

<footer class="footer">


    <div class="footer-content">


        <!-- BRAND -->

        <div class="footer-brand">


            <div class="footer-logo">

                <div class="logo-icon">

                    <i class="fas fa-utensils"></i>

                </div>

                <span>
                    GourmetGo
                </span>

            </div>


            <p>

                The best food delivery service for
                delicious meals from your favorite
                restaurants.

            </p>


            <div class="social-icons">

                <a href="#">
                    <i class="fab fa-facebook-f"></i>
                </a>

                <a href="#">
                    <i class="fab fa-instagram"></i>
                </a>

                <a href="#">
                    <i class="fab fa-twitter"></i>
                </a>

                <a href="#">
                    <i class="fab fa-linkedin-in"></i>
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
                Help & Support
            </h3>

            <a href="#">
                FAQ
            </a>

            <a href="#">
                Shipping & Delivery
            </a>

            <a href="#">
                Refund Policy
            </a>

            <a href="#">
                Terms & Conditions
            </a>

        </div>



        <!-- DOWNLOAD -->

        <div class="footer-column">

            <h3>
                Download App
            </h3>


            <a href="#"
               class="store-button">

                <i class="fab fa-apple"></i>

                App Store

            </a>


            <a href="#"
               class="store-button">

                <i class="fab fa-google-play"></i>

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