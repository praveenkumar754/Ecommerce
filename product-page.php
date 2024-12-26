<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <link rel="stylesheet" href="style.css">
    <style>

        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            color: #333;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Product Details */
        .product-details {
            text-align: center;
        }

        .product-details img {
            width: 100%;
            max-width: 300px;
            height: auto;
            margin-bottom: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .product-details h2 {
            font-size: 2rem;
            margin-bottom: 10px;
            color: #007bff;
        }

        .product-details p {
            font-size: 1.2rem;
            margin: 10px 0;
            color: #555;
        }

        .product-details button {
            margin: 10px;
            padding: 10px 20px;
            font-size: 1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.2s ease-in-out, transform 0.2s ease-in-out;
        }

        /* Button Styles */
        .product-details button:hover {
            transform: scale(1.05);
        }

        .product-details button:nth-child(4) {
            background-color: #28a745;
            color: white;
        }

        .product-details button:nth-child(4):hover {
            background-color: #218838;
        }

        .product-details button:nth-child(5) {
            background-color: #dc3545;
            color: white;
        }

        .product-details button:nth-child(5):hover {
            background-color: #c82333;
        }

        /* Category Buttons */
        .category-buttons {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin: 20px 0;
        }

        .category-buttons button {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            font-size: 1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .category-buttons button:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        .category-buttons button:focus {
            outline: none;
            box-shadow: 0 0 5px 2px rgba(0, 123, 255, 0.5);
        }

        /* Related Products Section */
        .product-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
            gap: 20px;
        }

        .product-card {
            width: 200px;
            padding: 10px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }

        .product-card img {
            width: 100%;
            max-width: 150px;
            height: auto;
            border-radius: 5px;
        }

        .product-card h4 {
            font-size: 1.1rem;
            margin: 10px 0;
        }

        .product-card p {
            font-size: 1rem;
            margin: 5px 0;
        }
        /* Base styles for buttons */
        .category-buttons {
    display: flex;
    gap: 10px; /* Spacing between buttons */
    flex-wrap: wrap; /* Allow wrapping for responsiveness */
    justify-content: center; /* Center-align buttons */
}

.category-buttons button {
    padding: 12px 20px; /* Button size */
    font-size: 16px;
    border: 1px solid #333;
    background-color: #007BFF;
    color: white;
    cursor: pointer;
    border-radius: 4px;
    transition: background-color 0.3s ease;
    flex: 1; /* Make all buttons take equal space */
    max-width: 200px; /* Prevent buttons from becoming too wide */
}

.category-buttons button:hover {
    background-color: #0056b3;
}
h3{
    text-align:center;
    font-size:25px;
}

        /* Responsive Design */
        @media (max-width: 768px) {
            .product-details img {
                width: 80%;
            }

            .product-details h2 {
                font-size: 1.5rem;
            }

            .product-details p {
                font-size: 1rem;
            }

            .product-details button {
                padding: 8px 15px;
                font-size: 0.9rem;
            }
        }
        @media (max-width: 768px) {
    .category-buttons {
        flex-direction: row; /* Stack buttons vertically */
        gap: 15px; /* Increase spacing between buttons */
    }

    .category-buttons button {
        font-size: 14px; /* Slightly reduce font size */
        padding: 10px 15px; /* Adjust padding for smaller screens */
        max-width: 25%; /* Let buttons expand fully in column layout */
    }
}

    </style>
</head>
<body>

<?php include 'navbar.php'; ?>

<div class="container">
    <?php
        // Parse the query parameters
        $productName = $_GET['name'] ?? 'Unknown Product';
        $productPrice = $_GET['price'] ?? 'Price Not Available';
        $productImage = $_GET['image'] ?? 'default-image.jpg';
        $productRating = $_GET['rating'] ?? 'No Rating';
        $productCategory = $_GET['category'] ?? 'Unknown Category'; // Get category from URL

        // Display the product details
        echo "
            <div class='product-details'>
                <img src='$productImage' alt='$productName'>
                <h2>$productName</h2>
                <p>Price: $productPrice</p>
                <p>Rating: $productRating</p>
                <p>Category: $productCategory</p>
                <button onclick='addToCart()'>Add to Cart</button>
                <button onclick='goBack()'>Go Back</button>
                <button onclick='buyNow()'>Buy Now</button> <!-- Added Buy Now Button -->
            </div>
        ";
    ?>
</div>

<!-- Category Buttons -->
<div class="category-buttons">
    <button onclick="filterCategory('Belts')">Belts</button>
    <button onclick="filterCategory('Watches')">Watches</button>
    <button onclick="filterCategory('Mobiles')">Mobiles</button>
    <button onclick="filterCategory('Shoes')">Shoes</button>
    <button onclick="filterCategory('All')">All</button> <!-- Show all categories -->
</div>

<!-- Related Products Section -->
<div class="related-products">
    <h3>Related Products</h3>
    <div class="product-grid" id="product-grid">
        <?php
            // Define related products with categories
            $relatedProducts = [
                // belts
                ['name' => 'Leather Belt', 'price' => 'Rs.450', 'image' => 'images/belt1.avif', 'rating' => '⭐⭐⭐⭐☆', 'category' => 'Belts'],
                ['name' => 'Sport Belt', 'price' => 'Rs.500', 'image' => 'images/belt2.avif', 'rating' => '⭐⭐⭐⭐⭐', 'category' => 'Belts'],
                ['name' => 'Leather Belt', 'price' => 'Rs.420', 'image' => 'images/belt3.jpeg', 'rating' => '⭐⭐⭐⭐☆', 'category' => 'Belts'],
                ['name' => 'Sport Belt', 'price' => 'Rs.200', 'image' => 'images/belt4.jpeg', 'rating' => '⭐⭐⭐⭐⭐', 'category' => 'Belts'],
                ['name' => 'formal Belt', 'price' => 'Rs.300', 'image' => 'images/belt5.jpeg', 'rating' => '⭐⭐⭐⭐☆', 'category' => 'Belts'],
               
                // watches
                ['name' => 'Classic Watch', 'price' => 'Rs.1200', 'image' => 'images/watch image1.avif', 'rating' => '⭐⭐⭐⭐⭐', 'category' => 'Watches'],
                ['name' => 'Digital Watch', 'price' => 'Rs.1500', 'image' => 'images/watch 2.avif', 'rating' => '⭐⭐⭐⭐☆', 'category' => 'Watches'],
                ['name' => 'Classic Watch', 'price' => 'Rs.1200', 'image' => 'images/watch3.jpeg', 'rating' => '⭐⭐⭐⭐⭐', 'category' => 'Watches'],
                ['name' => 'Digital Watch', 'price' => 'Rs.1500', 'image' => 'images/watch4.jpeg', 'rating' => '⭐⭐⭐⭐☆', 'category' => 'Watches'],
                ['name' => 'Classic Watch', 'price' => 'Rs.1200', 'image' => 'images/watch5.jpeg', 'rating' => '⭐⭐⭐⭐⭐', 'category' => 'Watches'],
             
                // mobiles
                ['name' => 'Vivo V25', 'price' => 'Rs.20000', 'image' => 'images/mobile1.jpeg', 'rating' => '⭐⭐⭐⭐☆', 'category' => 'Mobiles'],
                ['name' => 'Samsung Galaxy', 'price' => 'Rs.25000', 'image' => 'images/mobile2.jpeg', 'rating' => '⭐⭐⭐⭐⭐', 'category' => 'Mobiles'],
                ['name' => 'Apple S10', 'price' => 'Rs.80000', 'image' => 'images/mobile3.jpeg', 'rating' => '⭐⭐⭐⭐☆', 'category' => 'Mobiles'],
                ['name' => 'Apple 12', 'price' => 'Rs.125000', 'image' => 'images/mobile4.jpeg', 'rating' => '⭐⭐⭐⭐⭐', 'category' => 'Mobiles'],
                ['name' => 'Apple 14 pro', 'price' => 'Rs.120000', 'image' => 'images/mobile5.jpeg', 'rating' => '⭐⭐⭐⭐☆', 'category' => 'Mobiles'],
               
                // shoes
                ['name' => 'Running Shoes', 'price' => 'Rs.3000', 'image' => 'images/shoes1.avif', 'rating' => '⭐⭐⭐⭐☆', 'category' => 'Shoes'],
                ['name' => 'Casual Shoes', 'price' => 'Rs.2500', 'image' => 'images/shoe2.jpeg', 'rating' => '⭐⭐⭐⭐⭐', 'category' => 'Shoes'],
                ['name' => 'Running Shoes', 'price' => 'Rs.3500', 'image' => 'images/shoe3.jpeg', 'rating' => '⭐⭐⭐⭐☆', 'category' => 'Shoes'],
                ['name' => 'Casual Shoes', 'price' => 'Rs.2200', 'image' => 'images/shoe4.jpeg', 'rating' => '⭐⭐⭐⭐⭐', 'category' => 'Shoes'],
                ['name' => 'Running Shoes', 'price' => 'Rs.3600', 'image' => 'images/shoe5.jpeg', 'rating' => '⭐⭐⭐⭐☆', 'category' => 'Shoes']
            ];
            

            // Display related products
            foreach ($relatedProducts as $product) {
                echo "
                    <div class='product-card' data-category='{$product['category']}' onclick='redirectToProductPage(\"{$product['name']}\", \"{$product['price']}\", \"{$product['image']}\", \"{$product['rating']}\", \"{$product['category']}\")'>
                        <img src='{$product['image']}' alt='{$product['name']}'>
                        <div class='product-info'>
                            <h4>{$product['name']}</h4>
                            <p>Price: {$product['price']}</p>
                            <p>Rating: {$product['rating']}</p>
                        </div>
                    </div>
                ";
            }
        ?>
    </div>
</div>
<?php include 'footer.php'; 
?>
<script>
    // Get product details from PHP
    const product = {
        name: "<?php echo $productName; ?>",
        price: "<?php echo $productPrice; ?>",
        image: "<?php echo $productImage; ?>",
        category: "<?php echo $productCategory; ?>"
    };

    // Function to add the product to the cart
    function addToCart() {
        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        cart.push(product);
        localStorage.setItem('cart', JSON.stringify(cart));
        alert(`${product.name} has been added to your cart!`);
    }

    // Function to go back to the previous page
    function goBack() {
        window.history.back();
    }

    // Function to redirect to the product page
    function redirectToProductPage(name, price, image, rating, category) {
        const params = new URLSearchParams({
            name: name,
            price: price,
            image: image,
            rating: rating,
            category: category
        });
        window.location.href = `product-page.php?${params.toString()}`;
    }

    // Function to filter the products based on category
    function filterCategory(category) {
        const productCards = document.querySelectorAll('.product-card');
        productCards.forEach(card => {
            const productCategory = card.getAttribute('data-category');
            if (category === 'All' || productCategory === category) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    }

    // Function to handle Buy Now
    function buyNow() {
        const params = new URLSearchParams({
            name: product.name,
            price: product.price,
            image: product.image,
            category: product.category
        });
        window.location.href = `order-page.php?${params.toString()}`;
    }

    // Initial call to display all products
    filterCategory('All');
</script>

</body>
</html>
