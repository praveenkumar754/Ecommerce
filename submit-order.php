<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ecommerce";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data from the form
$name = $_POST['name'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$product_name = $_POST['product_name'];
$product_price = $_POST['product_price'];
$product_image = $_POST['product_image'];
$product_category = $_POST['product_category'];

// Prepare the SQL query to insert data into the orders table
$sql = "INSERT INTO orders (name, phone, address, product_name, product_price, product_image, product_category)
        VALUES ('$name', '$phone', '$address', '$product_name', '$product_price', '$product_image', '$product_category')";

// Check if the query was successful
if ($conn->query($sql) === TRUE) {
    echo "Order placed successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the connection
$conn->close();
?>
