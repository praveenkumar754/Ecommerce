<?php
// Connect to the database
$conn = new mysqli("localhost", "root", "", "ecommerce");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch products for the Shoes category
$result = $conn->query("SELECT * FROM productbyadmin WHERE category = 'Shoes'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shoes</title>
    <style>
        /* Styling similar to addproduct.php */
    </style>
</head>
<body>
    <h2>Shoes Category</h2>
    <div class="container">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '
                <div class="product-card">
                    <img src="' . htmlspecialchars($row["image_path"]) . '" alt="Product Image">
                    <div class="product-name">' . htmlspecialchars($row["product_name"]) . '</div>
                    <div class="product-price">$' . number_format($row["price"], 2) . '</div>
                    <div class="rating">Rating: ' . htmlspecialchars($row["rating"]) . ' ⭐</div>
                </div>
                ';
            }
        } else {
            echo "<p>No products available in this category.</p>";
        }
        ?>
    </div>
</body>
</html>
<?php $conn->close(); ?>
