<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic E-Commerce</title>
    <link rel="stylesheet" href="./style.css">
    <style>
        /* General styling for product cards and order form */
        .product-card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .product-card:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }
        .product-card img {
            height: 200px;
            width: 100%;
            /* object-fit: cover; */
        }
        .product-card .p-4 {
            padding: 16px;
        }
        .product-card .product-name {
            font-weight: 600;
            font-size: 1.25rem;
        }
        .product-card .product-price {
            color: #007bff;
            font-weight: bold;
            margin-top: 8px;
        }
        .product-card .rating {
            color: #ffc107;
            margin-top: 8px;
        }
        .product-card button {
            margin-top: 8px;
            padding: 10px 16px;
            border: none;
            border-radius: 8px;
            background: #007bff;
            color: white;
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.3s ease;
        }
        .product-card button:hover {
            background: #0056b3;
        }
        .like-button {
            background: transparent;
            color: #ff4d4d;
            font-size: 1.5rem;
            border: none;
            cursor: pointer;
            margin-top: 8px;
            transition: transform 0.2s ease;
        }
        .like-button.liked {
            color: #ff0000;
            transform: scale(1.2);
        }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>

    <div class="container" id="product-container">
        <!-- Product cards will be generated dynamically -->
    </div>

    <div class="order-form" id="order-form">
        <div class="form-container">
            <h2>Order Form</h2>
            <form id="order-form-details" method="POST" action="process-order.php">
                <input type="text" id="product-name" name="product_name" placeholder="Product Name" readonly>
                <input type="text" id="product-price" name="product_price" placeholder="Product Price" readonly>
                <input type="text" name="customer_name" placeholder="Your Name" required>
                <input type="text" name="phone" placeholder="Your Phone Number" required>
                <input type="text" name="address" placeholder="Your Address" required>
                <button type="submit">Submit Order</button>
                <button type="button" onclick="closeOrderForm()">Cancel</button>
            </form>
        </div>
    </div>
    <?php include 'footer.php'; 
?>

    <script>
        // Example product data
        const products = [
            { name: "Sport shoe", price: "Rs.300", rating: "⭐⭐⭐⭐☆", image: "images/redshoes1.jpeg" },
            { name: "Sport shoe", price: "Rs.280", rating: "⭐⭐⭐⭐⭐", image: "images/blueshoe.jpeg" },
            { name: "Slipper", price: "RS.150", rating: "⭐⭐⭐⭐⭐", image: "images/th (8).jpeg" },
            { name: "Men Slipper", price: "Rs.460", rating: "⭐⭐⭐⭐☆", image: "images/th (9).jpeg" },
            { name: "Mobile:VIVO-V25", price: "$21,999", rating: "⭐⭐⭐⭐☆", image: "images/mobile1.jpeg" },
            { name: "Mobile:VIVO-V30", price: "Rs29,999", rating: "⭐⭐⭐⭐⭐", image: "images/mobile2.jpeg" },
            { name: "Product 3", price: "$39.99", rating: "⭐⭐⭐⭐⭐", image: "images/tab1.jpeg" },
            { name: "Product 4", price: "$19.99", rating: "⭐⭐⭐⭐☆", image: "images/tab2.jpeg" },
        ];

        // Function to generate product cards dynamically
        function generateProductCards() {
            const container = document.getElementById("product-container");

            products.forEach(product => {
                const productCard = document.createElement("div");
                productCard.classList.add("product-card");

                productCard.innerHTML = `
                    <img src="${product.image}" alt="${product.name}">
                    <div class="p-4">
                        <div class="product-name">${product.name}</div>
                        <div class="product-price">${product.price}</div>
                        <div class="rating">${product.rating}</div>
                        <button onclick="showOrderForm('${product.name}', '${product.price}')">Buy Now</button>
                        <button onclick="addToCart('${product.name}', '${product.price}', '${product.image}')">Add to Cart</button>
                        <button class="like-button" onclick="toggleLike(this)">&#x2764;</button>
                    </div>
                `;

                container.appendChild(productCard);
            });
        }

        // Function to show the order form
        function showOrderForm(productName, productPrice) {
            document.getElementById('product-name').value = productName;
            document.getElementById('product-price').value = productPrice;
            document.getElementById('order-form').style.display = 'flex';
        }

        // Function to close the order form
        function closeOrderForm() {
            document.getElementById('order-form').style.display = 'none';
        }

        // Function to add the product to the cart
        function addToCart(productName, productPrice, productImage) {
            // Get existing cart items from localStorage
            let cartItems = JSON.parse(localStorage.getItem('cart')) || [];

            // Add new item to the cart
            const newItem = { name: productName, price: productPrice, image: productImage };
            cartItems.push(newItem);

            // Save updated cart to localStorage
            localStorage.setItem('cart', JSON.stringify(cartItems));

            // Redirect to addcart.php
            window.location.href = 'addcart.php';
        }

        // Function to toggle the like button state
        function toggleLike(button) {
            button.classList.toggle('liked');
        }

        // Generate the product cards on page load
        generateProductCards();
    </script>
</body>
</html>
