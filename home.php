

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce Website</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- Navbar -->
<?php include 'navbar.php'; 
?>

<!-- Main Section -->
<div class="main-container">
    <div class="overlay"></div>
    <div class="welcome-text">
        <h1>Welcome to Offers Zone</h1>
        <p>Explore the best deals and discounts just for you!</p>
    </div>
</div>

<!-- Products Section -->
<div class="container">
    <div class="product-card">
        <img src="bag1.avif" alt="Product 1">
        <div class="product-info">
            <div class="product-name">Product 1</div>
            <div class="product-price">$19.99</div>
            <div class="rating">⭐⭐⭐⭐☆</div>
            <button class="buy-button" onclick="showOrderForm('Product 1', '$19.99')">Buy Now</button>
        </div>
    </div>
    <div class="product-card">
        <img src="shirt .jpg" alt="Product 2">
        <div class="product-info">
            <div class="product-name">Product 2</div>
            <div class="product-price">$29.99</div>
            <div class="rating">⭐⭐⭐⭐⭐</div>
            <button class="buy-button" onclick="showOrderForm('Product 1', '$29.99')">Buy Now</button>
        </div>
        
    </div>
    <div class="product-card">
        <img src="images/partial-view-woman-with-string-bag_197531-19700.avif" alt="Product 3">
        <div class="product-info">
            <div class="product-name">Product 3</div>
            <div class="product-price">$15.99</div>
            <div class="rating">⭐⭐⭐⭐☆</div>
            <button class="buy-button" onclick="showOrderForm('Product 1', '$15.99')">Buy Now</button>
        </div>
    </div>


    <div class="product-card">
        <img src="shoes1.avif" alt="Product 3">
        <div class="product-info">
            <div class="product-name">Product 3</div>
            <div class="product-price">$15.99</div>
            <div class="rating">⭐⭐⭐⭐⭐</div>
            <button class="buy-button" onclick="showOrderForm('Product 1', '$15.99')">Buy Now</button>
        </div>
    </div>

    <div class="product-card">
        <img src="images/belt1.avif" alt="Product 3">
        <div class="product-info">
            <div class="product-name">Product 3</div>
            <div class="product-price">$12.99</div>
            <div class="rating">⭐⭐⭐⭐⭐</div>
            <button class="buy-button" onclick="showOrderForm('Product 1', '$12.99')">Buy Now</button>
        </div>
    </div>
</div>

<!-- Order Form Modal -->
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

<!-- Footer -->
<footer class="footer">
    <div class="footer-container">
        <!-- Brand Description -->
        <div class="footer-logo-description">
            <h3>Your Brand</h3>
            <p>Your Brand is your go-to place for amazing products! Discover our exclusive deals and stay connected.</p>
        </div>

        <!-- Useful Links -->
        <div class="footer-links">
            <h3 class="footer-title">Useful Links</h3>
            <a href="#" class="footer-link">Home</a>
            <a href="#" class="footer-link">Shop</a>
            <a href="#" class="footer-link">About Us</a>
            <a href="#" class="footer-link">Contact</a>
        </div>

        <!-- Contact Information -->
        <div class="footer-contact">
            <h3 class="footer-title">Contact Us</h3>
            <p>Email: support@yourbrand.com</p>
            <p>Phone: +1 (123) 456-7890</p>
            <p>Address: 1234 Your Street, Your City, Your Country</p>
        </div>

        <!-- Social Media Links -->
        <div class="footer-social">
            <h3 class="footer-title">Follow Us</h3>
            <a href="#" class="social-link">Facebook</a>
            <a href="#" class="social-link">Twitter</a>
            <a href="#" class="social-link">Instagram</a>
            <a href="#" class="social-link">LinkedIn</a>
        </div>

        <!-- Newsletter Subscription -->
        <div class="footer-newsletter">
            <h3 class="footer-title">Subscribe to our Newsletter</h3>
            <form class="newsletter-form">
                <input type="email" placeholder="Enter your email" class="newsletter-input" required>
                <button type="submit" class="newsletter-button">Subscribe</button>
            </form>
        </div>
    </div>
</footer>

<script>
    function showOrderForm(productName, productPrice) {
        document.getElementById('product-name').value = productName;
        document.getElementById('product-price').value = productPrice;
        document.getElementById('order-form').style.display = 'flex';
    }

    function closeOrderForm() {
        document.getElementById('order-form').style.display = 'none';
    }

    function toggleMenu() {
        const navbar = document.querySelector('.navbar');
        navbar.classList.toggle('active');
    }
</script>

</body>
</html>