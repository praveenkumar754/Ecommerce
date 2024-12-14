
<?php include 'navbar.php'; ?>
<div class="container">

    <?php
        // Get the product details from URL parameters
        $productName = $_GET['name'] ?? 'Unknown Product';
        $productPrice = $_GET['price'] ?? 'Price Not Available';
        $productImage = $_GET['image'] ?? 'default-image.jpg';
        $productCategory = $_GET['category'] ?? 'Unknown Category';
    ?>

    <h2>Order Details</h2>
    <div class="order-details">
        <img src="<?php echo $productImage; ?>" alt="<?php echo $productName; ?>" width="150">
        <h3><?php echo $productName; ?></h3>
        <p>Price: <?php echo $productPrice; ?></p>
        <p>Category: <?php echo $productCategory; ?></p>

        <form action="submit-order.php" method="POST">
            <h4>Enter Your Details:</h4>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required><br><br>

            <label for="phone">Phone Number:</label>
            <input type="text" id="phone" name="phone" required><br><br>

            <label for="address">Address:</label>
            <textarea id="address" name="address" required></textarea><br><br>

            <input type="hidden" name="product_name" value="<?php echo $productName; ?>">
            <input type="hidden" name="product_price" value="<?php echo $productPrice; ?>">
            <input type="hidden" name="product_image" value="<?php echo $productImage; ?>">
            <input type="hidden" name="product_category" value="<?php echo $productCategory; ?>">

            <button type="submit">Submit Order</button>
        </form>
    </div>
</div>
<style>
    /* Container styling */
.container {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background-color: #f7f7f7;
}

/* Order details card styling */
.order-details {
    background-color: white;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 600px;
    text-align: center;
}

/* Product Image Styling */
.order-details img {
    max-width: 150px;
    margin-bottom: 20px;
}

/* Heading Styles */
.order-details h3 {
    font-size: 24px;
    font-weight: 600;
    margin-bottom: 10px;
}

/* Paragraph styling */
.order-details p {
    font-size: 16px;
    color: #333;
    margin-bottom: 10px;
}

/* Form styling */
.order-details form {
    margin-top: 20px;
    text-align: left;
}

/* Input field styling */
.order-details input[type="text"], 
.order-details textarea {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
}

/* Submit button styling */
.order-details button {
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    width: 100%;
    transition: background-color 0.3s;
}

.order-details button:hover {
    background-color: #45a049;
}

/* Add margins to the form labels */
.order-details label {
    font-weight: 500;
    display: block;
    margin-bottom: 5px;
}

</style>
</body>
</html>
