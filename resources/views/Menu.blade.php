<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>GourmetGo - Food Menu</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">
</head>

<body>

<!-- =====================================================
     HEADER
===================================================== -->

<header class="main-header">

    <div class="header-container">

        <!-- LOGO -->
        <a href="{{ route('home') }}" class="logo">

            <div class="logo-icon">
                <i class="fa-solid fa-utensils"></i>
            </div>

            <span>GourmetGo</span>

        </a>


        <!-- NAVIGATION -->
        <nav class="main-nav">

            <a href="{{ route('home') }}" class="active">
                home
            </a>

            <a href="{{ url('Menu') }}">
                Menu
            </a>

            <a href="{{ url('Restaurants') }}">
                Restaurants
            </a>

            <a href="{{ url('Offers') }}">
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
            <a href="#" class="cart-icon">

                <i class="fa-solid fa-cart-shopping"></i>

            </a>


            <!-- LOGIN -->
            <a href="{{ url('login') }}" class="login-btn">
                Login
            </a>


            <!-- SIGN UP -->
            <a href="{{ url('profile') }}" class="signup">
                👤 Profile
            </a>

        </div>

    </div>

</header>


<!-- =====================================================
     MENU PAGE
===================================================== -->

<section class="menu-section">

    <div class="menu-container">


        <!-- =================================================
             SIDEBAR
        ================================================== -->

        <aside class="filter-sidebar">

            <h3>Filters</h3>

            <hr>


            <!-- CATEGORIES -->

            <h4>Categories</h4>

            <label class="check-item">
                <input type="checkbox">
                <span>Burgers</span>
            </label>

            <label class="check-item">
                <input type="checkbox">
                <span>Pizza</span>
            </label>

            <label class="check-item">
                <input type="checkbox">
                <span>Sushi</span>
            </label>

            <label class="check-item">
                <input type="checkbox">
                <span>Desserts</span>
            </label>

            <label class="check-item">
                <input type="checkbox">
                <span>Indian</span>
            </label>


            <!-- PRICE -->

            <div class="price-box">

                <h3>Price Range</h3>

                <input
                    type="range"
                    id="priceSlider"
                    min="5"
                    max="100"
                    value="70">

                <div class="price-values">

                    <span>$5</span>

                    <span id="currentPrice">
                        $70
                    </span>

                    <span>
                        $100+
                    </span>

                </div>

            </div>


            <!-- CUSTOMER RATING -->

            <div class="filter-box">

                <h3>Customer Rating</h3>


                <label class="rating-item">

                    <div class="rating-left">

                        <input type="checkbox">

                        <span class="stars">
                            ★★★★★
                        </span>

                        <span class="rating-text">
                            4.5 & up
                        </span>

                    </div>

                </label>


                <label class="rating-item">

                    <div class="rating-left">

                        <input type="checkbox">

                        <span class="stars">
                            ★★★★☆
                        </span>

                        <span class="rating-text">
                            4.0 & up
                        </span>

                    </div>

                </label>


                <!-- DIETARY -->

                <h3 class="sub-title">
                    Dietary Preference
                </h3>


                <div class="toggle-item">

                    <span>
                        Vegetarian Only
                    </span>

                    <label class="switch">

                        <input type="checkbox">

                        <span class="slider"></span>

                    </label>

                </div>


                <div class="toggle-item">

                    <span>
                        Gluten Free
                    </span>

                    <label class="switch">

                        <input type="checkbox" checked>

                        <span class="slider"></span>

                    </label>

                </div>

            </div>

        </aside>



        <!-- =================================================
             MAIN MENU
        ================================================== -->

        <main class="menu-main">


            <!-- SEARCH -->

            <div class="search">

                <input
                    type="text"
                    placeholder="Search food...">

                <button>
                    <i class="fa-solid fa-magnifying-glass"></i>
                    Search
                </button>

            </div>


            <!-- FOOD CARDS -->

            <div class="cards">


                <!-- BURGER -->

                <div class="food-card">

                    <div class="food-image">

                        <img src="{{ asset('burger.png') }}"
                             alt="Classic Burger">

                    </div>

                    <div class="food-content">

                        <h3>
                            Classic Burger
                        </h3>

                        <p>
                            Delicious classic burger with fresh ingredients.
                        </p>

                        <div class="food-bottom">

                            <span class="price">
                                $14.99
                            </span>

                            <button class="add-btn">
                                <i class="fa-solid fa-plus"></i>
                            </button>

                        </div>

                    </div>

                </div>


                <!-- PIZZA -->

                <div class="food-card">

                    <div class="food-image">

                        <img src="{{ asset('pizza.png') }}"
                             alt="Pizza">

                    </div>

                    <div class="food-content">

                        <h3>
                            Pizza
                        </h3>

                        <p>
                            Freshly baked pizza with delicious toppings.
                        </p>

                        <div class="food-bottom">

                            <span class="price">
                                $18.50
                            </span>

                            <button class="add-btn">
                                <i class="fa-solid fa-plus"></i>
                            </button>

                        </div>

                    </div>

                </div>


                <!-- SANDWICH -->

                <div class="food-card">

                    <div class="food-image">

                        <img src="{{ asset('sandwich.png') }}"
                             alt="Sandwich">

                    </div>

                    <div class="food-content">

                        <h3>
                            Sandwich
                        </h3>

                        <p>
                            Fresh sandwich prepared with quality ingredients.
                        </p>

                        <div class="food-bottom">

                            <span class="price">
                                $22.00
                            </span>

                            <button class="add-btn">
                                <i class="fa-solid fa-plus"></i>
                            </button>

                        </div>

                    </div>

                </div>


                <!-- CAKE -->

                <div class="food-card">

                    <div class="food-image">

                        <img src="{{ asset('Cake.png') }}"
                             alt="Chocolate Cake">

                    </div>

                    <div class="food-content">

                        <h3>
                            Chocolate Cake
                        </h3>

                        <p>
                            Soft and delicious chocolate cake.
                        </p>

                        <div class="food-bottom">

                            <span class="price">
                                $8.99
                            </span>

                            <button class="add-btn">
                                <i class="fa-solid fa-plus"></i>
                            </button>

                        </div>

                    </div>

                </div>


                <!-- VADA PAV -->

                <div class="food-card">

                    <div class="food-image">

                        <img src="{{ asset('Vada.png') }}"
                             alt="Vada Pav">

                    </div>

                    <div class="food-content">

                        <h3>
                            Vada Pav
                        </h3>

                        <p>
                            Popular Indian street food with spicy chutney.
                        </p>

                        <div class="food-bottom">

                            <span class="price">
                                $8.99
                            </span>

                            <button class="add-btn">
                                <i class="fa-solid fa-plus"></i>
                            </button>

                        </div>

                    </div>

                </div>


                <!-- DABELI -->

                <div class="food-card">

                    <div class="food-image">

                        <img src="{{ asset('Dabeli.png') }}"
                             alt="Dabeli">

                    </div>

                    <div class="food-content">

                        <h3>
                            Dabeli
                        </h3>

                        <p>
                            Delicious Gujarati-style spicy dabeli.
                        </p>

                        <div class="food-bottom">

                            <span class="price">
                                $8.99
                            </span>

                            <button class="add-btn">
                                <i class="fa-solid fa-plus"></i>
                            </button>

                        </div>

                    </div>

                </div>

            </div>

        </main>

    </div>

</section>



<!-- =====================================================
     NEWSLETTER
===================================================== -->

<section class="newsletter">

    <div class="newsletter-container">

        <div>

            <h2>
                Join our Newsletter
            </h2>

            <p>
                Get delicious offers and food updates directly in your inbox.
            </p>

        </div>


        <form class="newsletter-form">

            <input
                type="email"
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

    <p>
        © 2026 GourmetGo. All Rights Reserved.
    </p>

</footer>



<!-- =====================================================
     JAVASCRIPT
===================================================== -->

<script>

    const priceSlider =
        document.getElementById("priceSlider");

    const currentPrice =
        document.getElementById("currentPrice");


    priceSlider.addEventListener("input", function () {

        currentPrice.textContent =
            "$" + this.value;

    });

</script>


</body>
</html>