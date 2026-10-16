<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Profile - GourmetGo</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
*{box-sizing:border-box;font-family:Poppins,sans-serif}body{margin:0;background:#f7f7f7}.box{max-width:700px;margin:70px auto;background:#fff;padding:40px;border-radius:24px;box-shadow:0 10px 30px #0001}
h1{margin-top:0}.row{padding:16px;border-bottom:1px solid #eee}.label{color:#888;font-size:13px}.value{font-weight:600;margin-top:4px}.btn{display:inline-block;margin-top:20px;background:#ff6b00;color:#fff;padding:11px 18px;border-radius:10px;text-decoration:none}
</style></head>
<body>

</body></html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>GourmetGo Profile</title>

    <!-- Google Font -->
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <!-- Your CSS -->
    <link rel="stylesheet" href="{{ asset('css/Pr.css') }}">
</head>

<body>

<div class="container">

    <!-- =========================
         SIDEBAR
    ========================== -->
    <aside class="sidebar">

        <div class="logo">
            <i class="fa-solid fa-utensils"></i>
            <h2>Gourmet<span>Go</span></h2>
        </div>

        <p class="menu-title">MAIN MENU</p>

        <ul>
            <li>
                <a href="#">
                    <i class="fa-solid fa-house"></i>
                    Dashboard
                </a>
            </li>

            <li class="active">
                <a href="#">
                    <i class="fa-solid fa-user"></i>
                    My Profile
                </a>
            </li>

            <li>
                <a href="#">
                    <i class="fa-solid fa-box"></i>
                    My Orders
                </a>
            </li>

            <li>
                <a href="#">
                    <i class="fa-solid fa-heart"></i>
                    Saved Addresses
                </a>
            </li>

            <li>
                <a href="#">
                    <i class="fa-solid fa-credit-card"></i>
                    Payment Methods
                </a>
            </li>
        </ul>

        <p class="menu-title">SYSTEM</p>

        <ul>
            <li>
                <a href="#">
                    <i class="fa-solid fa-gear"></i>
                    Settings
                </a>
            </li>

            <li>
                <a href="#">
                    <i class="fa-solid fa-circle-question"></i>
                    Help & Support
                </a>
            </li>
        </ul>

        <div class="logout">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" style="background:none;border:0;color:inherit;font:inherit;cursor:pointer;width:100%;text-align:left;padding:0;">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    Logout
                </button>
            </form>
        </div>

    </aside>


    <!-- =========================
         MAIN CONTENT
    ========================== -->
    <main class="main-content">

        <!-- Top Navbar -->
        <header class="topbar">

            <div class="search">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input
                    type="text"
                    placeholder="Search for food or restaurants..."
                >
            </div>

            <div class="top-icons">

                <i class="fa-regular fa-bell"></i>
                <i class="fa-regular fa-heart"></i>

                <div class="profile-small">

                    <img
                        src="{{ auth()->user()->profile_image ? asset('storage/' . auth()->user()->profile_image) : asset('profile.png') }}"
                        alt="Profile"
                    >

                    <div>
                        <h4 id="topProfileName">
                            {{ auth()->user()->name }}
                        </h4>

                        <span>Gold Member</span>
                    </div>

                </div>

            </div>

        </header>


        <!-- =========================
             PROFILE CARD
        ========================== -->
        @if(session('success'))
            <div class="toast" style="display:flex;position:relative;margin-bottom:20px;">
                <i class="fa-solid fa-circle-check"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif
        @if($errors->any())
            <div class="toast" style="display:flex;position:relative;margin-bottom:20px;background:#fff0f0;color:#dc3545;">
                <i class="fa-solid fa-circle-exclamation"></i>
                <span>{{ $errors->first() }}</span>
            </div>
        @endif

        <section class="profile-card">

            <div class="profile-left">

                <img
                    id="mainProfileImage"
                    src="{{ auth()->user()->profile_image ? asset('storage/' . auth()->user()->profile_image) : asset('profile.png') }}"
                    alt="Profile"
                >

                <div>

                    <h2 id="profileName">
                        {{ auth()->user()->name }}
                    </h2>

                    <p id="profileEmail">
                        {{ auth()->user()->email }}
                    </p>

                    <p id="profilePhone">
                        {{ auth()->user()->phone ?? 'Not added' }}
                    </p>
                    <p><strong>Account:</strong> {{ ucfirst(auth()->user()->role) }}</p>

                    <div class="avatars">

                        <img src="{{ auth()->user()->profile_image ? asset('storage/' . auth()->user()->profile_image) : asset('profile.png') }}" alt="">
                        <img src="{{ auth()->user()->profile_image ? asset('storage/' . auth()->user()->profile_image) : asset('profile.png') }}" alt="">
                        <img src="{{ auth()->user()->profile_image ? asset('storage/' . auth()->user()->profile_image) : asset('profile.png') }}" alt="">

                        <span>Viewed by 5 friends</span>

                    </div>

                </div>

            </div>


            <!-- EDIT PROFILE BUTTON -->
            <button
                type="button"
                class="edit-btn"
                id="openEditProfile"
            >
                <i class="fa-solid fa-pen"></i>
                Edit Profile
            </button>

        </section>


        <!-- =========================
             STATISTICS
        ========================== -->
        <section class="stats">

            <div class="stat-card">
                <i class="fa-solid fa-bag-shopping"></i>
                <h3>128</h3>
                <p>Total Orders</p>
            </div>

            <div class="stat-card">
                <i class="fa-solid fa-heart"></i>
                <h3>14</h3>
                <p>Favorites</p>
            </div>

            <div class="stat-card">
                <i class="fa-solid fa-star"></i>
                <h3>2,450</h3>
                <p>Reward Points</p>
            </div>

            <div class="stat-card">
                <i class="fa-solid fa-wallet"></i>
                <h3>$154.20</h3>
                <p>Wallet</p>
            </div>

        </section>


        <!-- =========================
             INFORMATION SECTION
        ========================== -->
        <section class="info-grid">

            <!-- Personal Information -->
            <div class="card">

                <div class="card-header">
                    <h3>Personal Information</h3>
                </div>

                <div class="info-list">

                    <div class="info-item">
                        <label>Full Name</label>
                        <span id="infoName">{{ auth()->user()->name }}</span>
                    </div>

                    <div class="info-item">
                        <label>Date of Birth</label>
                        <span id="infoDob">{{ auth()->user()->date_of_birth ? \Illuminate\Support\Carbon::parse(auth()->user()->date_of_birth)->format('d/m/Y') : 'Not added' }}</span>
                    </div>

                    <div class="info-item">
                        <label>Gender</label>
                        <span id="infoGender">{{ auth()->user()->gender ?? "Not added" }}</span>
                    </div>

                    <div class="info-item">
                        <label>Email</label>
                        <span id="infoEmail">
                            {{ auth()->user()->email }}
                        </span>
                    </div>

                    <div class="info-item">
                        <label>Phone</label>
                        <span id="infoPhone">
                            {{ auth()->user()->phone ?? 'Not added' }}
                        </span>
                    </div>

                    <div class="info-item">
                        <label>Address</label>
                        <span id="infoAddress">
                            {{ auth()->user()->address ?? 'Not added' }}
                        </span>
                    </div>

                </div>

            </div>


            <!-- Recent Orders -->
            <div class="card">

                <div class="card-header">
                    <h3>Recent Orders</h3>
                    <a href="#">View All</a>
                </div>

                <div class="table-wrapper">

                    <table class="orders-table">

                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Restaurant</th>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>

                            <tr>
                                <td>#ORD-7842</td>
                                <td>🍔 Burger King</td>
                                <td>Oct 24, 2025</td>
                                <td>$12.50</td>

                                <td>
                                    <span class="status delivered">
                                        Delivered
                                    </span>
                                </td>
                            </tr>

                            <tr>
                                <td>#ORD-7815</td>
                                <td>🍕 Pizza Hut</td>
                                <td>Oct 23, 2025</td>
                                <td>$44.00</td>

                                <td>
                                    <span class="status preparing">
                                        Preparing
                                    </span>
                                </td>
                            </tr>

                            <tr>
                                <td>#ORD-7788</td>
                                <td>🌶 Spice Route</td>
                                <td>Oct 21, 2025</td>
                                <td>$28.90</td>

                                <td>
                                    <span class="status cancelled">
                                        Cancelled
                                    </span>
                                </td>
                            </tr>

                        </tbody>

                    </table>

                </div>

            </div>

        </section>


        <!-- =========================
             BOTTOM GRID
        ========================== -->
        <section class="bottom-grid">

            <!-- Loyalty Rewards -->
            <div class="card">

                <div class="card-header">

                    <h3>Loyalty Rewards</h3>

                    <i class="fa-solid fa-crown"></i>

                </div>

                <div class="reward-box">

                    <span class="badge">
                        NEXT LEVEL PLATINUM
                    </span>

                    <p>
                        Earn more reward points to unlock premium benefits.
                    </p>

                    <button>
                        View Rewards Store
                    </button>

                </div>

            </div>


            <!-- Saved Addresses -->
            <div class="card">

                <div class="card-header">

                    <h3>Saved Addresses</h3>

                    <i class="fa-solid fa-location-dot"></i>

                </div>

                <div class="address-box">

                    <div class="address">

                        <i class="fa-solid fa-house"></i>

                        <div>
                            <h4>Home</h4>
                            <p>
                                Rajkot
                            </p>
                        </div>

                    </div>

                    <div class="address">

                        <i class="fa-solid fa-building"></i>

                        <div>
                            <h4>Office</h4>
                            <p>
                                Rajkot
                            </p>
                        </div>

                    </div>

                </div>

            </div>


            <!-- Payments -->
            <div class="card">

                <div class="card-header">

                    <h3>Payments</h3>

                    <i class="fa-solid fa-credit-card"></i>

                </div>

                <div class="payment-box">

                    <div class="payment-item">

                        <i class="fa-brands fa-cc-visa visa"></i>

                        <div>
                            <h4>Visa Ending 4242</h4>
                            <p>Default Payment Method</p>
                        </div>

                        <span class="active-dot"></span>

                    </div>

                    <div class="payment-item">

                        <i class="fa-brands fa-cc-mastercard master"></i>

                        <div>
                            <h4>MasterCard Ending 3095</h4>
                            <p>Backup Card</p>
                        </div>

                    </div>

                </div>

            </div>

        </section>


        <!-- =========================
             ACCOUNT SETTINGS
        ========================== -->
        <section class="settings-card">

            <div class="card">

                <div class="card-header">
                    <h3>Account Settings</h3>
                </div>

                <div class="setting-item">

                    <span>Two-Factor Authentication</span>

                    <label class="switch">
                        <input type="checkbox" checked>
                        <span class="slider"></span>
                    </label>

                </div>

                <div class="setting-item">

                    <span>Email Notifications</span>

                    <label class="switch">
                        <input type="checkbox" checked>
                        <span class="slider"></span>
                    </label>

                </div>

                <div class="setting-item">

                    <span>SMS Notifications</span>

                    <label class="switch">
                        <input type="checkbox">
                        <span class="slider"></span>
                    </label>

                </div>

                <div class="setting-item">

                    <span>Dark Mode</span>

                    <label class="switch">
                        <input type="checkbox">
                        <span class="slider"></span>
                    </label>

                </div>

            </div>

        </section>


        <!-- =========================
             ACTION BUTTONS
        ========================== -->
        <div class="profile-buttons">

            <button
                type="button"
                class="cancel-btn"
                id="cancelChanges"
            >
                Cancel Changes
            </button>

            <button
                type="button"
                class="save-btn"
                id="saveProfile"
            >
                Save Profile Changes
            </button>

        </div>

    </main>

</div>


<!-- =====================================================
     EDIT PROFILE MODAL
===================================================== -->

<div
    class="edit-modal"
    id="editModal"
>

    <div class="edit-modal-content">

        <!-- Modal Header -->
        <div class="edit-modal-header">

            <div>
                <h2>
                    <i class="fa-solid fa-user-pen"></i>
                    Edit Profile
                </h2>

                <p>
                    Update your personal information
                </p>
            </div>

            <button
                type="button"
                class="close-modal"
                id="closeEditProfile"
            >
                <i class="fa-solid fa-xmark"></i>
            </button>

        </div>


        <!-- Profile Image -->
        <div class="edit-profile-photo">

            <div class="photo-wrapper">

                <img
                    id="editProfileImage"
                    src="{{ auth()->user()->profile_image ? asset('storage/' . auth()->user()->profile_image) : asset('profile.png') }}"
                    alt="Profile"
                >

                <label
                    for="profileImageInput"
                    class="camera-button"
                >
                    <i class="fa-solid fa-camera"></i>
                </label>

                <input
                    type="file"
                    name="profile_image" id="profileImageInput"
                    accept="image/*"
                    hidden
                >

            </div>

            <h4>Profile Photo</h4>

            <p>
                JPG, PNG or WEBP. Maximum 2MB.
            </p>

        </div>


        <!-- Form -->
        <form id="editProfileForm" method="POST" action="{{ route('profile') }}" enctype="multipart/form-data">@csrf @method('PUT')

            <div class="edit-form-grid">

                <!-- Full Name -->
                <div class="form-group">

                    <label for="editName">
                        <i class="fa-solid fa-user"></i>
                        Full Name
                    </label>

                    <input
                        type="text"
                        name="name" id="editName"
                        value="{{ auth()->user()->name }}"
                        placeholder="Enter your full name"
                    >

                </div>


                <!-- Date of Birth -->
                <div class="form-group">

                    <label for="editDob">
                        <i class="fa-solid fa-calendar"></i>
                        Date of Birth
                    </label>

                    <input
                        type="date"
                        name="date_of_birth" id="editDob"
                        value="{{ auth()->user()->date_of_birth ? \Illuminate\Support\Carbon::parse(auth()->user()->date_of_birth)->format("Y-m-d") : "" }}"
                    >

                </div>


                <!-- Gender -->
                <div class="form-group">

                    <label for="editGender">
                        <i class="fa-solid fa-venus-mars"></i>
                        Gender
                    </label>

                    <select name="gender" id="editGender">

                        <option value="Male" {{ auth()->user()->gender === 'Male' ? 'selected' : '' }}>
                            Male
                        </option>

                        <option value="Female">
                            Female
                        </option>

                        <option value="Other">
                            Other
                        </option>

                    </select>

                </div>


                <!-- Email -->
                <div class="form-group">

                    <label for="editEmail">
                        <i class="fa-solid fa-envelope"></i>
                        Email Address
                    </label>

                    <input
                        type="email"
                        name="email" id="editEmail"
                        value="{{ auth()->user()->email }}"
                        placeholder="Enter email address"
                    >

                </div>


                <!-- Phone -->
                <div class="form-group">

                    <label for="editPhone">
                        <i class="fa-solid fa-phone"></i>
                        Phone Number
                    </label>

                    <input
                        type="tel"
                        name="phone" id="editPhone"
                        value="{{ auth()->user()->phone ?? 'Not added' }}"
                        placeholder="Enter phone number"
                    >

                </div>


                <!-- Country -->
                <div class="form-group">

                    <label for="editCountry">
                        <i class="fa-solid fa-earth-americas"></i>
                        Country
                    </label>

                    <select name="country" id="editCountry">

                        <option value="India" {{ (auth()->user()->country ?? 'India') === 'India' ? 'selected' : '' }}>
                            India
                        </option>

                        <option value="United States">
                            United States
                        </option>

                        <option value="United Kingdom">
                            United Kingdom
                        </option>

                        <option value="Canada">
                            Canada
                        </option>

                    </select>

                </div>


                <!-- Address -->
                <div class="form-group full-width">

                    <label for="editAddress">
                        <i class="fa-solid fa-location-dot"></i>
                        Address
                    </label>

                    <textarea
                        name="address" id="editAddress"
                        rows="3"
                        placeholder="Enter your address"
                    >{{ auth()->user()->address ?? 'Not added' }}</textarea>

                </div>


                <!-- City -->
                <div class="form-group">

                    <label for="editCity">
                        <i class="fa-solid fa-city"></i>
                        City
                    </label>

                    <input
                        type="text"
                        name="city" id="editCity"
                        value="{{ auth()->user()->city ?? "" }}"
                        placeholder="Enter city"
                    >

                </div>


                <!-- Pincode -->
                <div class="form-group">

                    <label for="editPincode">
                        <i class="fa-solid fa-map-pin"></i>
                        Pincode
                    </label>

                    <input
                        type="text"
                        name="pincode" id="editPincode"
                        value=""
                        placeholder="Enter pincode"
                    >

                </div>

            </div>


            <!-- Modal Footer -->
            <div class="edit-modal-footer">

                <button
                    type="button"
                    class="modal-cancel-btn"
                    id="modalCancel"
                >
                    Cancel
                </button>

                <button
                    type="submit"
                    class="modal-save-btn"
                >
                    <i class="fa-solid fa-check"></i>
                    Save Changes
                </button>

            </div>

        </form>

    </div>

</div>


<!-- Toast Message -->
<div
    class="toast"
    id="toast"
>
    <i class="fa-solid fa-circle-check"></i>
    <span>Profile updated successfully!</span>
</div>


<!-- JavaScript -->
<script src="{{ asset('js/Pr.js') }}"></script>

</body>
</html>