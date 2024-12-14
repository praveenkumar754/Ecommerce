<?php
include 'db.php'; // Database connection
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login if not logged in
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Capture form data
    $user_id = $_SESSION['user_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $customer_name = $_POST['customer_name'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    // Insert order into the database
    $sql = "INSERT INTO orders (user_id, product_name, product_price, customer_name, phone, address) 
            VALUES ('$user_id', '$product_name', '$product_price', '$customer_name', '$phone', '$address')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Order placed successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Form</title>
    <style>
        /* Styles for the order form */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .order-form {
            background-color: #fff;
            margin: 50px auto;
            padding: 30px;
            width: 50%;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .order-form input, .order-form button {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        button {
            background-color: #007BFF;
            color: white;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        h2 {
            text-align: center;
        }
    </style>
</head>
<body>

    <!-- Order Form -->
    <div class="order-form">
        <h2>Order Details</h2>
        <form method="POST" action="">
            <input type="text" name="product_name" placeholder="Product Name" required>
            <input type="text" name="product_price" placeholder="Product Price" required>
            <input type="text" name="customer_name" placeholder="Your Name" required>
            <input type="text" name="phone" placeholder="Your Phone Number" required>
            <input type="text" name="address" placeholder="Your Address" required>
            <button type="submit">Place Order</button>
        </form>
    </div>

</body>
</html>
