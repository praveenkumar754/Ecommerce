<?php
// Connect to the database
$conn = new mysqli("localhost", "root", "", "ecommerce");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<?php include 'navbar.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Product Display</title>
    <style>
        /* Styles for product listing */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fa;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            margin-top: 20px;
            color: #333;
        }

        .container {
            width: 80%;
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            padding: 20px;
        }

        .product-card {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .product-card img {
            max-width: 100%;
            max-height: 200px;
            object-fit: cover;
            border-radius: 8px;
        }

        .product-name {
            font-size: 18px;
            font-weight: bold;
            margin: 10px 0;
        }

        .product-price {
            font-size: 16px;
            color: #007BFF;
            margin: 5px 0;
        }

        .rating {
            font-size: 14px;
            margin: 5px 0;
        }

        .buy-button {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 14px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .buy-button:hover {
            background-color: #0056b3;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            }
        }
    </style>
</head>
<body>

<h2>Product Listing</h2>

<div class="container">
    <?php
    // Fetch products from the database (correct table name)
    $result = $conn->query("SELECT product_id, product_name, price, rating, image_path FROM productbyadmin");

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '
            <div class="product-card">
                <img src="' . htmlspecialchars($row["image_path"]) . '" alt="Product Image">
                <div class="product-name">' . htmlspecialchars($row["product_name"]) . '</div>
                <div class="product-price">$' . number_format($row["price"], 2) . '</div>
                <div class="rating">Rating: ' . htmlspecialchars($row["rating"]) . ' ⭐</div>
                <button class="buy-button" onclick="location.href=\'product-details.php?product_id=' . $row['product_id'] . '\'">Buy Now</button>
            </div>
            ';
        }
    } else {
        echo "<p>No products available. Please add some products.</p>";
    }

    $conn->close();
    ?>
</div>

</body>
</html>
