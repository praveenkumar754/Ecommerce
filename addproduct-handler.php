<?php
session_start(); // Start session

// Check if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to the login page
    header("Location: login.php");
    exit;
}
// Database connection
$conn = new mysqli("localhost", "root", "", "ecommerce");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productName = $_POST['productName'];
    $price = $_POST['price'];
    $rate = $_POST['rate'];
    $image = $_FILES['image'];

    // Validate and upload image
    

$targetDir = "uploads/";
if (!is_dir($targetDir)) {
    mkdir($targetDir, 0777, true); // Create the directory if it doesn't exist
}

$targetFile = $targetDir . basename($image['name']);
if (move_uploaded_file($image['tmp_name'], $targetFile)) {
    // File upload successful
    $stmt = $conn->prepare("INSERT INTO products (name, price, image, rate) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sdsi", $productName, $price, $targetFile, $rate);

    if ($stmt->execute()) {
        header("Location: products.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Failed to upload image. Please check directory permissions.";
}

}
$conn->close();
?>
