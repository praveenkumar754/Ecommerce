<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic E-Commerce</title>
    <link rel="stylesheet" href="./style.css">
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
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center;
}

/* Product Card Styles */
.product-card {
    background-color: #fff;
    border: 1px solid #ddd;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    width: 250px;
    transition: transform 0.2s, box-shadow 0.2s;
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
}

.product-card img {
    width: 100%;
    height: 200px;
    object-fit: cover;
    border-bottom: 1px solid #ddd;
}

.product-info {
    padding: 15px;
    text-align: center;
}

.product-name {
    font-size: 1.2rem;
    font-weight: bold;
    margin-bottom: 10px;
}

.product-price {
    font-size: 1.1rem;
    color: #007bff;
    margin-bottom: 10px;
}

.rating {
    color: #f1c40f;
    margin-bottom: 15px;
}

.view-button {
    background-color: #007bff;
    color: white;
    border: none;
    padding: 10px 15px;
    border-radius: 5px;
    cursor: pointer;
    font-size: 1rem;
}

.view-button:hover {
    background-color: #0056b3;
}

/* Order Form Styles */
.order-form {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    align-items: center;
    justify-content: center;
    z-index: 1000;
}

.form-container {
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    width: 400px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
}

.form-container h2 {
    margin: 0 0 15px;
    text-align: center;
}

form {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

form input {
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 1rem;
}

form button {
    padding: 10px;
    border: none;
    border-radius: 5px;
    font-size: 1rem;
    cursor: pointer;
}

form button[type="submit"] {
    background-color: #28a745;
    color: white;
}

form button[type="submit"]:hover {
    background-color: #218838;
}

form button[type="button"] {
    background-color: #dc3545;
    color: white;
}

form button[type="button"]:hover {
    background-color: #c82333;
}

/* Responsive Design */
@media (max-width: 768px) {
    .product-card {
        width: 90%;
    }

    .form-container {
        width: 90%;
    }
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

<script>
    // Example product data
    const products = [
        { name: "Belts", price: "Rs.500", rating: "⭐⭐⭐⭐☆", image: "images/belt1.avif" },
        { name: "Sport shoe", price: "Rs.300", rating: "⭐⭐⭐⭐☆", image: "images/redshoes1.jpeg" },
        { name: "Mobile: VIVO-V25", price: "Rs.21,999", rating: "⭐⭐⭐⭐☆", image: "images/mobile1.jpeg" },
        { name: "IronBox", price: "Rs.500", rating: "⭐⭐⭐⭐☆", image: "images/ironbox.jpeg" },
        { name: "Tablet", price: "Rs.300", rating: "⭐⭐⭐⭐☆", image: "images/tab2.jpeg" },
        { name: "Slippers: VIVO-V25", price: "Rs.21,999", rating: "⭐⭐⭐⭐☆", image: "images/th (7).jpeg" },
        { name: "Watch", price: "Rs.500", rating: "⭐⭐⭐⭐☆", image: "images/watch 2.avif" },
        { name: "Bags", price: "Rs.300", rating: "⭐⭐⭐⭐☆", image: "images/th (5).jpeg" },
        { name: "Mobile: VIVO-V25", price: "Rs.21,999", rating: "⭐⭐⭐⭐☆", image: "images/mobile1.jpeg" },
    ];

    // Function to generate product cards dynamically
    function generateProductCards() {
        const container = document.getElementById("product-container");

        products.forEach((product, index) => {
            const productCard = document.createElement("div");
            productCard.classList.add("product-card");

            productCard.innerHTML = `
                <img src="${product.image}" alt="${product.name}">
                <div class="product-info">
                    <div class="product-name">${product.name}</div>
                    <div class="product-price">${product.price}</div>
                    <div class="rating">${product.rating}</div>
                    <button class="view-button" onclick="redirectToProductPage(${index})">View Products</button>
                </div>
            `;

            container.appendChild(productCard);
        });
    }

    // Function to redirect to product page with query parameters
    function redirectToProductPage(index) {
        const selectedProduct = products[index];
        const params = new URLSearchParams({
            name: selectedProduct.name,
            price: selectedProduct.price,
            image: selectedProduct.image,
            rating: selectedProduct.rating
        });
        window.location.href = `product-page.php?${params.toString()}`;
    }

    // Generate the product cards on page load
    generateProductCards();
</script>
