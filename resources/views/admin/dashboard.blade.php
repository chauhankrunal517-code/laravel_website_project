<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Delivery Admin Panel</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/Ap.css') }}">

    <style>
        /* Food image upload */
        .upload-box {
            width: 100%;
            min-height: 180px;
            box-sizing: border-box;
            border: 2px dashed #dedede;
            border-radius: 14px;
            background: #fafafa;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            cursor: pointer;
            padding: 22px;
            transition: 0.3s;
            position: relative;
        }

        .upload-box:hover {
            border-color: #FF6B35;
            background: #fff8f4;
        }

        .upload-content {
            width: 100%;
        }

        .upload-icon {
            width: 60px;
            height: 60px;
            background: #fff;
            color: #FF6B35;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 12px;
            font-size: 25px;
            box-shadow: 0 5px 18px rgba(0, 0, 0, 0.08);
        }

        .upload-box h4 {
            font-size: 16px;
            font-weight: 700;
            color: #2D3436;
            margin: 0 0 8px;
        }

        .upload-box p {
            color: #888;
            font-size: 12px;
            margin: 0;
        }

        #imagePreview {
            display: none;
            max-width: 100%;
            max-height: 220px;
            object-fit: contain;
            border-radius: 10px;
        }

        .upload-error {
            display: block;
            color: #dc3545;
            margin-top: 7px;
            font-size: 13px;
        }

        .food-image {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 8px;
            vertical-align: middle;
            margin-right: 8px;
        }

        .modal-overlay.show {
            display: flex;
        }

        @media (max-width: 550px) {
            .upload-box {
                min-height: 150px;
                padding: 15px;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <aside class="sidebar">

        <div class="logo">
            <i class="fa-solid fa-utensils"></i>
            <h2>Foodie<span>Admin</span></h2>
        </div>

        <ul class="menu">
            <li>
                <a href="{{ route('admin.dashboard') }}">
                    <i class="fa-solid fa-house"></i> Dashboard
                </a>
            </li>

            <li>
                <a href="#"><i class="fa-solid fa-bag-shopping"></i> Orders</a>
            </li>

            <li class="active">
                <a href="{{ route('admin.food.index') }}">
                    <i class="fa-solid fa-burger"></i> Menu
                </a>
            </li>

            <li><a href="#"><i class="fa-solid fa-layer-group"></i> Categories</a></li>
            <li><a href="#"><i class="fa-solid fa-users"></i> Customers</a></li>
            <li><a href="#"><i class="fa-solid fa-motorcycle"></i> Delivery</a></li>
            <li><a href="#"><i class="fa-solid fa-chart-line"></i> Reports</a></li>
            <li><a href="#"><i class="fa-solid fa-gear"></i> Settings</a></li>
        </ul>

        <div class="logout">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                    style="background:none;border:none;color:inherit;font:inherit;cursor:pointer;">
                    <i class="fa-solid fa-right-from-bracket"></i> Logout
                </button>
            </form>
        </div>

    </aside>

    <main class="main">

        <header class="topbar">
            <h2>FOOD DELIVERY ADMIN</h2>

            <div class="search">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" id="searchFood" placeholder="Search menu items...">
            </div>

            <div class="profile">
                <i class="fa-regular fa-bell"></i>
                <img src="{{ asset('profile.png') }}" alt="Admin Profile">
            </div>
        </header>

        <div class="page-header">
            <div>
                <h1>Menu Management</h1>
                <p>Manage your restaurant menu items.</p>
            </div>

            <button type="button" id="addFoodBtn" class="add-btn">
                <i class="fa-solid fa-plus"></i> Add Food
            </button>
        </div>

        @if(session('success'))
            <div style="background:#d4edda;color:#155724;padding:12px;margin:15px 0;border-radius:8px;">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div style="background:#f8d7da;color:#721c24;padding:12px;margin:15px 0;border-radius:8px;">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <div class="cards">

            <div class="card">
                <i class="fa-solid fa-cart-shopping"></i>
                <h3>120</h3>
                <p>Total Orders</p>
            </div>

            <div class="card">
                <i class="fa-solid fa-burger"></i>
                <h3>{{ $foods->count() }}</h3>
                <p>Food Items</p>
            </div>

            <div class="card">
                <i class="fa-solid fa-users"></i>
                <h3>892</h3>
                <p>Customers</p>
            </div>

            <div class="card">
                <i class="fa-solid fa-sack-dollar"></i>
                <h3>₹145</h3>
                <p>Total Revenue</p>
            </div>

        </div>

        <div class="table-box">

            <div class="table-header">
                <h3>Food Items</h3>

                <select id="categoryFilter">
                    <option value="">All Categories</option>

                    @foreach(['Pizza', 'Burger', 'Pasta', 'Drinks', 'Dessert', 'Fast Food', 'Chinese', 'Italian'] as $category)
                        <option value="{{ $category }}">{{ $category }}</option>
                    @endforeach
                </select>
            </div>

            <table id="foodTable">
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
                    @forelse($foods as $food)
                        <tr>
                            <td>
                                @if($food->image && file_exists(public_path('uploads/foods/' . $food->image)))
                                    <img
                                        src="{{ asset('uploads/foods/' . $food->image) }}"
                                        alt="{{ $food->name }}"
                                        class="food-image">
                                @else
                                    <img
                                        src="{{ asset('profile.png') }}"
                                        alt="No food image"
                                        class="food-image">
                                @endif

                                {{ $food->name }}
                            </td>

                            <td>{{ $food->category }}</td>

                            <td>₹{{ number_format($food->price, 2) }}</td>

                            <td>
                                @if($food->status === 'Available')
                                    <span class="available">Available</span>
                                @else
                                    <span class="unavailable">Unavailable</span>
                                @endif
                            </td>

                            <td>
                                <form
                                    action="{{ route('admin.food.destroy', $food->id) }}"
                                    method="POST"
                                    style="display:inline;"
                                    onsubmit="return confirm('Delete this food item?');">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="delete" title="Delete food item">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align:center;padding:20px;">
                                No food items added yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>

        <div class="pagination">
            <span>Total items: {{ $foods->count() }}</span>
        </div>

    </main>
</div>

<!-- Add Food Modal -->
<div class="modal-overlay" id="foodModal">

    <div class="modal">

        <div class="modal-header">
            <h2>Add New Food Item</h2>

            <button type="button" class="close-btn" id="closeModal">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <form id="foodForm"
              action="{{ route('admin.food.store') }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf

            <div class="row">

                <div class="input-group">
                    <label for="foodName">Food Name</label>
                    <input
                        type="text"
                        id="foodName"
                        name="name"
                        placeholder="Enter food name"
                        value="{{ old('name') }}"
                        required>
                </div>

                <div class="input-group">
                    <label for="foodCategory">Category</label>

                    <select id="foodCategory" name="category" required>
                        <option value="">Select Category</option>

                        @foreach(['Pizza', 'Burger', 'Pasta', 'Drinks', 'Dessert', 'Fast Food', 'Chinese', 'Italian'] as $category)
                            <option value="{{ $category }}"
                                {{ old('category') == $category ? 'selected' : '' }}>
                                {{ $category }}
                            </option>
                        @endforeach
                    </select>
                </div>

            </div>

            <div class="row">

                <div class="input-group">
                    <label for="foodPrice">Price (₹)</label>
                    <input
                        type="number"
                        id="foodPrice"
                        name="price"
                        placeholder="Enter price in rupees"
                        value="{{ old('price') }}"
                        min="0.01"
                        step="0.01"
                        required>
                </div>

                <div class="input-group">
                    <label>Availability</label>

                    <div class="radio-group">
                        <label>
                            <input
                                type="radio"
                                name="status"
                                value="Available"
                                {{ old('status', 'Available') == 'Available' ? 'checked' : '' }}
                                required>
                            Available
                        </label>

                        <label>
                            <input
                                type="radio"
                                name="status"
                                value="Unavailable"
                                {{ old('status') == 'Unavailable' ? 'checked' : '' }}>
                            Unavailable
                        </label>
                    </div>
                </div>

            </div>

            <div class="input-group">
                <label for="foodDescription">Description</label>

                <textarea
                    id="foodDescription"
                    name="description"
                    rows="5"
                    placeholder="Describe the food ingredients, taste, etc.">{{ old('description') }}</textarea>
            </div>

            <!-- Food Image Upload -->
            <div class="input-group">
                <label for="foodImage">Food Image</label>

                <label for="foodImage" class="upload-box">

                    <input
                        type="file"
                        id="foodImage"
                        name="image"
                        accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                        hidden>

                    <div id="uploadContent" class="upload-content">
                        <div class="upload-icon">
                            <i class="fa-solid fa-cloud-arrow-up"></i>
                        </div>

                        <h4>Choose a food image</h4>
                        <p>JPG, JPEG, PNG, WEBP (Maximum 8 MB)</p>
                    </div>

                    <img id="imagePreview" src="" alt="Food image preview">
                </label>

                <small id="imageError" class="upload-error" style="display:none;"></small>

                @error('image')
                    <small class="upload-error">{{ $message }}</small>
                @enderror
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

<script src="{{ asset('js/script.js') }}"></script>

<script>
    const addFoodBtn = document.getElementById("addFoodBtn");
    const modal = document.getElementById("foodModal");
    const closeModalBtn = document.getElementById("closeModal");
    const cancelBtn = document.getElementById("cancelBtn");

    const foodImage = document.getElementById("foodImage");
    const imagePreview = document.getElementById("imagePreview");
    const uploadContent = document.getElementById("uploadContent");
    const imageError = document.getElementById("imageError");

    function openFoodModal() {
        modal.classList.add("show");
    }

    function closeFoodModal() {
        modal.classList.remove("show");
    }

    addFoodBtn.addEventListener("click", openFoodModal);
    closeModalBtn.addEventListener("click", closeFoodModal);
    cancelBtn.addEventListener("click", closeFoodModal);

    window.addEventListener("click", function(event) {
        if (event.target === modal) {
            closeFoodModal();
        }
    });

    // Preview and validate the selected image
    foodImage.addEventListener("change", function(event) {
        const file = event.target.files[0];

        imageError.style.display = "none";
        imageError.textContent = "";

        if (!file) {
            imagePreview.style.display = "none";
            imagePreview.src = "";
            uploadContent.style.display = "block";
            return;
        }

        const allowedTypes = [
            "image/jpeg",
            "image/png",
            "image/webp"
        ];

        if (!allowedTypes.includes(file.type)) {
            showImageError("Please select a JPG, JPEG, PNG, or WEBP image.");
            return;
        }

        if (file.size > 8 * 1024 * 1024) {
            showImageError("Image size must not exceed 8 MB.");
            return;
        }

        imagePreview.src = URL.createObjectURL(file);
        imagePreview.style.display = "block";
        uploadContent.style.display = "none";
    });

    function showImageError(message) {
        foodImage.value = "";
        imagePreview.src = "";
        imagePreview.style.display = "none";
        uploadContent.style.display = "block";
        imageError.textContent = message;
        imageError.style.display = "block";
    }

    // Search and category filter
    const searchFood = document.getElementById("searchFood");
    const categoryFilter = document.getElementById("categoryFilter");

    function filterFoodItems() {
        const searchText = searchFood.value.toLowerCase().trim();
        const category = categoryFilter.value.toLowerCase();
        const rows = document.querySelectorAll("#foodTable tbody tr");

        rows.forEach(function(row) {
            const cells = row.querySelectorAll("td");

            if (cells.length < 5) {
                row.style.display = "";
                return;
            }

            const text = row.innerText.toLowerCase();
            const rowCategory = cells[1].innerText.trim().toLowerCase();

            const matchesSearch = text.includes(searchText);
            const matchesCategory = category === "" || rowCategory === category;

            row.style.display = matchesSearch && matchesCategory ? "" : "none";
        });
    }

    searchFood.addEventListener("input", filterFoodItems);
    categoryFilter.addEventListener("change", filterFoodItems);

    // Validate image again before submitting
    document.getElementById("foodForm").addEventListener("submit", function(event) {
        const file = foodImage.files[0];

        if (!file) {
            return; // Image is optional in this form
        }

        const allowedTypes = [
            "image/jpeg",
            "image/png",
            "image/webp"
        ];

        if (!allowedTypes.includes(file.type) || file.size > 8 * 1024 * 1024) {
            event.preventDefault();

            if (!allowedTypes.includes(file.type)) {
                showImageError("Please select a JPG, JPEG, PNG, or WEBP image.");
            } else {
                showImageError("Image size must not exceed 8 MB.");
            }
        }
    });

    // Reopen the modal after Laravel validation errors
    @if($errors->any())
        openFoodModal();
    @endif
</script>

</body>
</html>
