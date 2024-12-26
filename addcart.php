<?php include 'navbar.php'; ?>
<?php
// Start the session


// Connect to the database
$conn = new mysqli("localhost", "root", "", "ecommerce");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize the cart if it doesn't exist
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Handle adding a product to the cart
if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    // Fetch product details from the database
    $result = $conn->query("SELECT * FROM productbysadmin WHERE product_id = '$product_id'");
    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();

        // Add the product to the cart session
        $_SESSION['cart'][$product_id] = [
            'product_name' => $product['product_name'],
            'price' => $product['price'],
            'rating' => $product['rating'],
            'image_path' => $product['image_path']
        ];
    }
}

// Handle removing a product from the cart
if (isset($_GET['remove_id'])) {
    $remove_id = $_GET['remove_id'];

    // Remove the product from the cart session
    unset($_SESSION['cart'][$remove_id]);
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
            color: #333;
        }

        h2 {
            text-align: center;
            color: #444;
        }

        .cart-container {
            margin: 20px auto;
            max-width: 800px;
        }

        .cart-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .cart-item img {
            max-width: 80px;
            height: 80px;
            object-fit: cover;
            margin-right: 20px;
            border-radius: 4px;
        }

        .cart-item-details {
            flex: 1;
        }

        .cart-item-details h3 {
            font-size: 18px;
            margin: 0;
            color: #333;
        }

        .cart-item-details .price {
            color: #007BFF;
            font-size: 16px;
            margin: 5px 0;
        }

        .cart-item-details .rating {
            font-size: 14px;
            color: #555;
        }

        .cart-item .remove-button {
            color: white;
            background-color: #FF0000;
            border: none;
            border-radius: 4px;
            padding: 10px 15px;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s;
            text-decoration: none;
        }

        .cart-item .remove-button:hover {
            background-color: #CC0000;
        }
    </style>
</head>
<body>
    <h2>Your Shopping Cart</h2>
    <div class="cart-container">
        <?php if (!empty($_SESSION['cart'])): ?>
            <?php foreach ($_SESSION['cart'] as $id => $product): ?>
                <div class="cart-item">
                    <img src="<?= htmlspecialchars($product['image_path']) ?>" alt="<?= htmlspecialchars($product['product_name']) ?>">
                    <div class="cart-item-details">
                        <h3><?= htmlspecialchars($product['product_name']) ?></h3>
                        <div class="price">$<?= number_format($product['price'], 2) ?></div>
                        <div class="rating">Rating: <?= htmlspecialchars($product['rating']) ?> ⭐</div>
                    </div>
                    <a href="addcart.php?remove_id=<?= $id ?>" class="remove-button">Remove</a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p style="text-align: center; color: #777;">Your cart is empty.</p>
        <?php endif; ?>
    </div>
</body>
</html>
