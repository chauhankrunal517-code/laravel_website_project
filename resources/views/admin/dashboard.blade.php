<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Food Delivery Admin Panel</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"/>

    <link rel="stylesheet" href="{{ asset ('css/Ap.css')}}">
</head>

<body>

<div class="container">

<aside class="sidebar">

    <div class="logo">
        <i class="fa-solid fa-utensils"></i>
        <h2>Foodie<span>Admin</span></h2>
    </div>

    <ul class="menu">
        <li><a href="#"><i class="fa-solid fa-house"></i> Dashboard</a></li>
        <li><a href="#"><i class="fa-solid fa-bag-shopping"></i> Orders</a></li>
        <li class="active"><a href="#"><i class="fa-solid fa-burger"></i> Menu</a></li>
        <li><a href="#"><i class="fa-solid fa-layer-group"></i> Categories</a></li>
        <li><a href="#"><i class="fa-solid fa-users"></i> Customers</a></li>
        <li><a href="#"><i class="fa-solid fa-motorcycle"></i> Delivery</a></li>
        <li><a href="#"><i class="fa-solid fa-chart-line"></i> Reports</a></li>
        <li><a href="#"><i class="fa-solid fa-gear"></i> Settings</a></li>
    </ul>

    <!-- Logout: Only this section is changed -->
    <div class="logout">
        <form action="{{ route('logout') }}" method="POST">
            @csrf

            <button type="submit"
                    style="background: none; border: none; color: inherit; font: inherit; cursor: pointer;">
                <i class="fa-solid fa-right-from-bracket"></i>
                Logout
            </button>
        </form>
    </div>

</aside>

<main class="main">

<header class="topbar">
    <h2>FOOD DELIVERY ADMIN</h2>

    <div class="search">
        <i class="fa-solid fa-magnifying-glass"></i>
        <input type="text" placeholder="Search menu, orders...">
    </div>

    <div class="profile">
        <i class="fa-regular fa-bell"></i>
        <img src="{{ asset('profile.png') }}">
    </div>
</header>

<div class="page-header">
    <div>
        <h1>Menu Management</h1>
        <p>Manage your restaurant menu items.</p>
    </div>

    <button id="addFoodBtn" class="add-btn">
        <i class="fa-solid fa-plus"></i>
        Add Food
    </button>
</div>

<div class="cards">

    <div class="card">
        <i class="fa-solid fa-cart-shopping"></i>
        <h3>120</h3>
        <p>Total Orders</p>
    </div>

    <div class="card">
        <i class="fa-solid fa-burger"></i>
        <h3>58</h3>
        <p>Food Items</p>
    </div>

    <div class="card">
        <i class="fa-solid fa-users"></i>
        <h3>892</h3>
        <p>Customers</p>
    </div>

    <div class="card">
        <i class="fa-solid fa-sack-dollar"></i>
        <h3>$12,450</h3>
        <p>Total Revenue</p>
    </div>

</div>

<div class="table-box">

    <div class="table-header">
        <h3>Food Items</h3>

        <select>
            <option>All Categories</option>
            <option>Pizza</option>
            <option>Burger</option>
            <option>Dessert</option>
        </select>
    </div>

    <table>
        <thead>
            <tr>
                <th>Food</th>
                <th>Category</th>
                <th>Price</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>🍔 Burger</td>
                <td>Fast Food</td>
                <td>$9.99</td>
                <td><span class="available">Available</span></td>
                <td>
                    <button class="edit"><i class="fa-solid fa-pen"></i></button>
                    <button class="delete"><i class="fa-solid fa-trash"></i></button>
                </td>
            </tr>

            <tr>
                <td>🍕 Pizza</td>
                <td>Italian</td>
                <td>$12.50</td>
                <td><span class="available">Available</span></td>
                <td>
                    <button class="edit"><i class="fa-solid fa-pen"></i></button>
                    <button class="delete"><i class="fa-solid fa-trash"></i></button>
                </td>
            </tr>

            <tr>
                <td>🍜 Noodles</td>
                <td>Chinese</td>
                <td>$8.25</td>
                <td><span class="unavailable">Unavailable</span></td>
                <td>
                    <button class="edit"><i class="fa-solid fa-pen"></i></button>
                    <button class="delete"><i class="fa-solid fa-trash"></i></button>
                </td>
            </tr>

            <tr>
                <td>🍰 Cake</td>
                <td>Dessert</td>
                <td>$6.00</td>
                <td><span class="available">Available</span></td>
                <td>
                    <button class="edit"><i class="fa-solid fa-pen"></i></button>
                    <button class="delete"><i class="fa-solid fa-trash"></i></button>
                </td>
            </tr>
        </tbody>
    </table>

</div>

<div class="pagination">
    <button><i class="fa-solid fa-angle-left"></i></button>
    <button class="active">1</button>
    <button>2</button>
    <button><i class="fa-solid fa-angle-right"></i></button>
</div>

</main>
</div>

<script src="{{ asset('js/script.js') }}"></script>

<div class="modal-overlay" id="foodModal">

    <div class="modal">

        <div class="modal-header">
            <h2>Add New Food Item</h2>

            <button class="close-btn" id="closeModal">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <form>

            <div class="row">

                <div class="input-group">
                    <label>Food Name</label>
                    <input type="text" placeholder="Enter food name">
                </div>

                <div class="input-group">
                    <label>Category</label>

                    <select>
                        <option>Select Category</option>
                        <option>Pizza</option>
                        <option>Burger</option>
                        <option>Pasta</option>
                        <option>Drinks</option>
                        <option>Dessert</option>
                    </select>
                </div>

            </div>

            <div class="row">

                <div class="input-group">
                    <label>Price ($)</label>
                    <input type="number" placeholder="0.00">
                </div>

                <div class="input-group">
                    <label>Availability</label>

                    <div class="radio-group">
                        <label>
                            <input type="radio" name="status" checked>
                            Available
                        </label>

                        <label>
                            <input type="radio" name="status">
                            Unavailable
                        </label>
                    </div>
                </div>

            </div>

            <div class="input-group">
                <label>Description</label>
                <textarea rows="5" placeholder="Describe the food ingredients, taste, etc."></textarea>
            </div>

            <div class="input-group">
                <label>Food Image</label>

                <div class="upload-box">
                    <i class="fa-solid fa-cloud-arrow-up"></i>
                    <h4>Click to upload or drag and drop</h4>
                    <p>SVG, PNG, JPG (MAX 800×400)</p>
                    <input type="file">
                </div>
            </div>

            <div class="button-group">
                <button type="submit" class="save-btn">
                    Save Food Item
                </button>

                <button type="button" class="cancel-btn" id="cancelBtn">
                    Cancel
                </button>
            </div>

        </form>

    </div>
</div>

<script>
const addFoodBtn = document.getElementById("addFoodBtn");
const modal = document.getElementById("foodModal");
const closeModal = document.getElementById("closeModal");
const cancelBtn = document.getElementById("cancelBtn");

addFoodBtn.onclick = function() {
    modal.classList.add("show");
};

closeModal.onclick = function() {
    modal.classList.remove("show");
};

cancelBtn.onclick = function() {
    modal.classList.remove("show");
};

window.onclick = function(e) {
    if (e.target == modal) {
        modal.classList.remove("show");
    }
};
</script>

</body>
</html>
