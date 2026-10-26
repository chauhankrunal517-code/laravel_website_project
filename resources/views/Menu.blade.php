<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>GourmetGo - Food Menu</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('css/menu.css') }}">

    <style>
        .food-card .food-image {
            width: 100%;
            height: 220px;
            overflow: hidden;
            border-radius: 14px 14px 0 0;
            background: #f5f5f5;
        }

        .food-card .food-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .food-card .food-content {
            padding: 16px;
        }

        .food-card .food-bottom {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
        }

        .food-card .price {
            font-weight: 700;
            color: #ff6b35;
        }

        .food-card .add-btn {
            border: none;
            border-radius: 9px;
            width: 40px;
            height: 40px;
            background: #ff6b35;
            color: white;
            cursor: pointer;
        }

        .food-card .add-btn:hover {
            background: #e85b27;
        }

        .food-card .add-btn:disabled {
            background: #999;
            cursor: not-allowed;
        }

        .empty-menu {
            grid-column: 1 / -1;
            text-align: center;
            padding: 30px;
        }
    </style>
</head>

<body>

<!-- HEADER -->
<header class="main-header">
    <div class="header-container">

        <a href="{{ route('home') }}" class="logo">
            <div class="logo-icon">
                <i class="fa-solid fa-utensils"></i>
            </div>
            <span>GourmetGo</span>
        </a>

        <nav class="main-nav">
            <a href="{{ route('home') }}">home</a>
            <a href="{{ url('Menu') }}" class="active">Menu</a>
            <a href="{{ url('Restaurants') }}">Restaurants</a>
            <a href="{{ url('Offers') }}">Offers</a>
        </nav>

        <div class="header-right">

            <div class="delivery-address">
                <i class="fa-solid fa-location-dot"></i>
                <span>Enter Delivery Address</span>
            </div>

            <a href="{{ route('cart.index') }}" class="cart-icon">
                <i class="fa-solid fa-cart-shopping"></i>
            </a>

            <a href="{{ url('login') }}" class="login-btn">Login</a>

            <a href="{{ url('profile') }}" class="signup">👤 Profile</a>

        </div>
    </div>
</header>

<!-- MENU PAGE -->
<section class="menu-section">
    <div class="menu-container">

        <!-- SIDEBAR -->
        <aside class="filter-sidebar">

            <h3>Filters</h3>
            <hr>

            <h4>Categories</h4>

            @foreach(['Burger', 'Pizza', 'Sushi', 'Dessert', 'Indian', 'Pasta', 'Drinks', 'Chinese', 'Italian'] as $category)
                <label class="check-item">
                    <input type="checkbox"
                           class="category-checkbox"
                           value="{{ strtolower($category) }}">
                    <span>{{ $category }}</span>
                </label>
            @endforeach

            <!-- PRICE FILTER -->
            <div class="price-box">
                <h3>Price Range</h3>

                <input type="range"
                       id="priceSlider"
                       min="440"
                       max="8800"
                       value="8800">

                <div class="price-values">
                    <span>₹440</span>
                    <span id="currentPrice">₹8,800</span>
                    <span>₹8,800+</span>
                </div>
            </div>

            <!-- CUSTOMER RATING -->
            <div class="filter-box">
                <h3>Customer Rating</h3>

                <p class="rating-text">
                    Ratings are not available for these menu items yet.
                </p>

                <h3 class="sub-title">Dietary Preference</h3>

                <div class="toggle-item">
                    <span>Vegetarian Only</span>
                    <label class="switch">
                        <input type="checkbox" id="vegetarianFilter">
                        <span class="slider"></span>
                    </label>
                </div>

            </div>
        </aside>

        <!-- MAIN MENU -->
        <main class="menu-main">

            @if(session('success'))
                <div role="alert"
                     style="padding:12px 16px;margin-bottom:18px;border-radius:10px;background:#eafaf0;color:#187443;">

                    {{ session('success') }}

                    <a href="{{ route('cart.index') }}"
                       style="margin-left:10px;font-weight:600;color:inherit;">
                        View Cart
                    </a>
                </div>
            @endif

            @if($errors->any())
                <div role="alert"
                     style="padding:12px 16px;margin-bottom:18px;border-radius:10px;background:#fff0f0;color:#b42318;">
                    {{ $errors->first() }}
                </div>
            @endif

            <!-- SEARCH -->
            <div class="search">
                <input type="text"
                       id="menuSearch"
                       placeholder="Search food...">

                <button type="button" id="menuSearchBtn">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    Search
                </button>
            </div>

            <!-- FOOD CARDS -->
            <div class="cards" id="foodCards">

                @forelse($foods as $food)

                    <div class="food-card"
                         data-category="{{ strtolower($food->category ?? '') }}"
                         data-price="{{ $food->price }}"
                         data-status="{{ strtolower($food->status ?? 'available') }}">

                        <!-- FOOD IMAGE -->
                        <div class="food-image">

                            @if(!empty($food->image) && file_exists(public_path('uploads/foods/' . basename($food->image))))

                                <img
                                    src="{{ asset('uploads/foods/' . basename($food->image)) }}"
                                    alt="{{ $food->name }}"
                                    loading="lazy">

                            @elseif(!empty($food->image) && file_exists(public_path($food->image)))

                                <img
                                    src="{{ asset($food->image) }}"
                                    alt="{{ $food->name }}"
                                    loading="lazy">

                            @else

                                <img
                                    src="{{ asset('burger.png') }}"
                                    alt="Food image unavailable"
                                    loading="lazy">

                            @endif

                        </div>

                        <!-- FOOD DETAILS -->
                        <div class="food-content">

                            <h3>{{ $food->name }}</h3>

                            <p>
                                {{ $food->description ?: $food->category }}
                            </p>

                            <div class="food-bottom">

                                <span class="price">
                                    ₹{{ number_format($food->price, 2) }}
                                </span>

                                @if(($food->status ?? 'Available') === 'Available')

                                    <form action="{{ route('cart.add') }}"
                                          method="POST"
                                          class="add-to-cart-form">

                                        @csrf

                                        <input type="hidden"
                                               name="food_id"
                                               value="{{ $food->id }}">

                                        <button type="submit"
                                                class="add-btn"
                                                aria-label="Add {{ $food->name }} to cart"
                                                title="Add to Cart">

                                            <i class="fa-solid fa-plus"></i>

                                        </button>

                                    </form>

                                @else

                                    <button type="button"
                                            class="add-btn"
                                            disabled
                                            title="Currently unavailable">
                                        <i class="fa-solid fa-ban"></i>
                                    </button>

                                @endif

                            </div>
                        </div>
                    </div>

                @empty

                    <div class="empty-menu">
                        <h3>No food items available yet.</h3>
                        <p>Please check back later.</p>
                    </div>

                @endforelse

                <div id="noSearchResults"
                     class="empty-menu"
                     style="display:none;">
                    <h3>No matching food found.</h3>
                    <p>Try another food name or category.</p>
                </div>

            </div>
        </main>
    </div>
</section>

<!-- NEWSLETTER -->
<section class="newsletter">
    <div class="newsletter-container">

        <div>
            <h2>Join our Newsletter</h2>
            <p>Get delicious offers and food updates directly in your inbox.</p>
        </div>

        <form class="newsletter-form"
              action="#"
              method="GET"
              onsubmit="return false;">

            <input type="email"
                   placeholder="Enter your email"
                   required>

            <button type="submit">Subscribe</button>
        </form>

    </div>
</section>

<!-- FOOTER -->
<footer>
    <p>© 2026 GourmetGo. All Rights Reserved.</p>
</footer>

<script>
    // Price slider
    const priceSlider = document.getElementById("priceSlider");
    const currentPrice = document.getElementById("currentPrice");

    priceSlider.addEventListener("input", function () {
        currentPrice.textContent =
            "₹" + Number(this.value).toLocaleString("en-IN");

        filterMenuCards();
    });

    // Search
    const menuSearch = document.getElementById("menuSearch");
    const menuSearchBtn = document.getElementById("menuSearchBtn");

    // Category filters
    const categoryCheckboxes =
        document.querySelectorAll(".category-checkbox");

    // Vegetarian filter
    const vegetarianFilter = document.getElementById("vegetarianFilter");

    function filterMenuCards() {
        const searchText = menuSearch.value.toLowerCase().trim();
        const selectedCategories = Array.from(categoryCheckboxes)
            .filter(checkbox => checkbox.checked)
            .map(checkbox => checkbox.value);

        const maxPrice = Number(priceSlider.value);
        const cards = document.querySelectorAll(".food-card");

        let visibleCount = 0;

        cards.forEach(function (card) {
            const nameAndDescription = card.innerText.toLowerCase();
            const category = card.dataset.category || "";
            const price = Number(card.dataset.price || 0);
            const status = card.dataset.status || "available";

            const matchesSearch =
                nameAndDescription.includes(searchText);

            const matchesCategory =
                selectedCategories.length === 0 ||
                selectedCategories.some(selected =>
                    category.includes(selected)
                );

            const matchesPrice = price <= maxPrice;

            // Vegetarian filtering needs a vegetarian field in the database.
            // This filter is intentionally not inferred from the food name.
            const matchesVegetarian = !vegetarianFilter.checked;

            const visible =
                matchesSearch &&
                matchesCategory &&
                matchesPrice &&
                matchesVegetarian &&
                status === "available";

            card.style.display = visible ? "" : "none";

            if (visible) {
                visibleCount++;
            }
        });

        const noResults = document.getElementById("noSearchResults");
        noResults.style.display =
            cards.length > 0 && visibleCount === 0 ? "block" : "none";
    }

    menuSearch.addEventListener("input", filterMenuCards);
    menuSearchBtn.addEventListener("click", filterMenuCards);

    categoryCheckboxes.forEach(function (checkbox) {
        checkbox.addEventListener("change", filterMenuCards);
    });

    vegetarianFilter.addEventListener("change", filterMenuCards);
</script>

</body>
</html>
