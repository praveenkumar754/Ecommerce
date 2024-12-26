<?php
session_start(); // Start session

// Check if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page
    header("Location: login.php");
    exit;
}
// Connect to the database
$conn = new mysqli("localhost", "root", "", "ecommerce");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if product_id is provided
if (isset($_GET['product_id'])) {
    $productId = $_GET['product_id'];

    // Delete product from database
    $stmt = $conn->prepare("DELETE FROM productbyadmin WHERE product_id = ?");
    $stmt->bind_param("i", $productId);

    if ($stmt->execute()) {
        echo "Product deleted successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Product ID is missing or invalid.";
    exit;
}

$conn->close();

// Redirect to prevent resubmission on page refresh
header("Location: addproduct.php");
exit;
?>
