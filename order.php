<?php
session_start(); // Start session

// Check if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Connect to the database
$conn = new mysqli("localhost", "root", "", "ecommerce");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch product details
$product_id = isset($_GET['product_id']) ? intval($_GET['product_id']) : 0;
$productDetails = null;

if ($product_id > 0) {
    $stmt = $conn->prepare("SELECT product_name, price, rating, image_path FROM productbyadmin WHERE product_id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $productDetails = $result->fetch_assoc();
    }
    $stmt->close();
}

$conn->close();
?>

<?php include 'navbar.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order - Product Details</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fa;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        .order-details {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 40px auto;
        }

        .order-details img {
            max-width: 100%;
            max-height: 300px;
            object-fit: cover;
            border-radius: 8px;
        }

        .order-details h2 {
            margin-top: 20px;
        }

        .order-details p {
            margin: 10px 0;
            font-size: 18px;
        }

        input[type="number"] {
            width: 60px;
            padding: 5px;
            font-size: 16px;
            margin-left: 5px;
        }

        .place-order-button {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .place-order-button:hover {
            background-color: #0056b3;
        }

        .back-button {
            background-color: #6c757d;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 20px;
        }

        .back-button:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>

<h2>Product Details</h2>

<?php if ($productDetails): ?>
    <div class="order-details">
        <img src="<?php echo htmlspecialchars($productDetails['image_path']); ?>" alt="Product Image">
        <h2><?php echo htmlspecialchars($productDetails['product_name']); ?></h2>
        <p><strong>Price:</strong> $<?php echo number_format($productDetails['price'], 2); ?></p>
        <p><strong>Rating:</strong> <?php echo htmlspecialchars($productDetails['rating']); ?> ⭐</p>
        <p>
            <strong>Quantity:</strong>
            <input type="number" id="quantity" name="quantity" value="1" min="1">
        </p>
        <p><strong>Total:</strong> $<span id="total"><?php echo number_format($productDetails['price'], 2); ?></span></p>
        <button class="place-order-button" onclick="placeOrder()">Place Order</button>
        
        <!-- Back Button -->
        <button class="back-button" onclick="window.location.href='products.php'">Back to Category</button>
    </div>
<?php else: ?>
    <p>Product details not found. Please try again later.</p>
<?php endif; ?>

<script>
    // Retrieve price from PHP
    var price = <?php echo $productDetails ? $productDetails['price'] : 0; ?>;

    // Load persisted data on page load
    window.onload = function () {
        const savedQuantity = localStorage.getItem('quantity');
        const savedTotal = localStorage.getItem('total');
        
        if (savedQuantity) {
            document.getElementById('quantity').value = savedQuantity;
            document.getElementById('total').textContent = parseFloat(savedTotal).toFixed(2);
        }
    };

    // Update total and save to localStorage
    document.getElementById('quantity').addEventListener('input', function () {
        var quantity = this.value;
        var total = price * quantity;

        document.getElementById('total').textContent = total.toFixed(2);
        
        // Save to localStorage
        localStorage.setItem('quantity', quantity);
        localStorage.setItem('total', total);
    });

    // Function to handle placing the order
    function placeOrder() {
        alert("Order has been successfully registered!");
        localStorage.clear(); // Clear the stored data after order
        location.reload(); // Refresh the page
    }
</script>

</body>
</html>
