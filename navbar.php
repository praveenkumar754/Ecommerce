<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Font Awesome CDN for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<style>
    /* Basic Styling for Navbar and Menu */
    .navbar {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        background-color: #333;
    }

    .navbar li {
        padding: 10px;
    }

    .navbar a {
        color: white;
        text-decoration: none;
    }

    .navbar a:hover {
        text-decoration: underline;
    }

    /* Search Bar Styling */
    .search-bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        width: 250px;
        border: 1px solid #ddd;
        border-radius: 4px;
        padding: 5px;
        background-color: #fff;
    }

    .search-bar input {
        width: 80%;
        padding: 8px;
        font-size: 16px;
        border: none;
        outline: none;
        border-radius: 4px;
    }

    .search-bar input::placeholder {
        color: #aaa;
    }

    .search-bar button {
        background-color: #007BFF;
        color: white;
        border: none;
        padding: 8px 12px;
        cursor: pointer;
        border-radius: 4px;
        transition: background-color 0.3s ease;
    }

    .search-bar button i {
        font-size: 18px;
    }

    .search-bar button:hover {
        background-color: #0056b3;
    }

    /* Styling for Dropdown Menu */
    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: black;
        color: black;
        min-width: 160px;
        box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
        z-index: 1;
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }

    .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

    .dropdown-content a:hover {
        background-color: black;
    }

    /* Styling for Logout Button */
    .logout {
        color: white;
        text-decoration: none;
        padding: 10px;
        background-color: #ff4c4c;
        border-radius: 4px;
    }

    .logout:hover {
        background-color: #e74c3c;
    }

    /* Mobile View Adjustments */
    @media (max-width: 768px) {
        /* Stack navbar items vertically */
        .navbar {
            flex-direction: column;
            display: none; /* Hide the navbar initially */
        }

        .navbar.active {
            display: flex; /* Show navbar when active */
        }

        .menu-toggle {
            display: block;
            font-size: 20px;
            color: white;
            background-color: #333;
            border: none;
            padding: 10px;
            cursor: pointer;
        }

        /* Make the search bar take full width */
        .search-bar {
            display:none;
        }

        .dropdown-content {
            min-width: 100%; /* Make the dropdown full width */
        }

        /* Change font size and order of navbar items */
        .navbar li {
            font-size: 14px; /* Decrease font size on mobile */
            padding: 12px;
        }

        .navbar a {
            font-size: 14px; /* Smaller text on mobile */
        }

        /* Reorder navbar items for mobile view */
        .navbar li:nth-child(1) {
            order: 1; /* Home */
        }

        .navbar li:nth-child(2) {
            order: 2; /* Category */
        }

        .navbar li:nth-child(3) {
            order: 4; /* Logout */
        }

        .navbar li:nth-child(4) {
            order: 3; /* Add Cart */
        }

        .dropdown {
            order: 5; /* Update dropdown comes last on mobile */
        }
    }
</style>
<body>
    <!-- navbar.php -->
    <nav>
        <!-- Menu Toggle Button (Hamburger Menu) -->
        <button class="menu-toggle" onclick="toggleMenu()">☰ Menu</button>
        
        <!-- Navbar Links -->
        <ul class="navbar">
            <li><a href="home.php"><i class="fas fa-home"></i> Home</a></li>
            <li><a href="products.php"><i class="fas fa-box"></i> Category</a></li>
            <li><a href="addcart.php"><i class="fas fa-info-circle"></i> Add Cart</a></li>
            <li><a href="offerszone.php"><i class="fas fa-envelope"></i> Offers Zone</a></li>
            
            <!-- Dropdown for Update Options -->
            <li class="dropdown">
                <a href="javascript:void(0)"> 
                    <i class="fas fa-edit"></i> Update
                </a>
                <div class="dropdown-content">
                   
                    <a href="addproduct.php">Add New </a>
                    <a href="updateproduct.php">Update Product</a>
                    <a href="deleteproduct.php">Delete Product</a>
                </div>
            </li>
        </ul>

        <!-- Search Bar -->
        <div class="search-bar">
            <input type="text" placeholder="Search..." id="search-input">
            <button><i class="fas fa-search"></i></button>
        </div>
        <a href="logout.php" class="logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </nav>

    <script>
        // JavaScript for menu toggle
        function toggleMenu() {
            const navbar = document.querySelector('.navbar');
            navbar.classList.toggle('active');
        }
    </script>
</body>
</html>
