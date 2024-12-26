<?php include 'navbar.php'; ?>
<?php
// Connect to the database
$conn = new mysqli("localhost", "root", "", "ecommerce");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all distinct categories from the database
$categoriesResult = $conn->query("SELECT DISTINCT category FROM productbysadmin");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products by Category</title>
    <style>
        /* General styling */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
            color: #333;
        }

        h2, h3 {
            text-align: center;
            color: #444;
        }

        .container {
            margin: 20px auto;
            max-width: 1200px;
        }

        .category-section {
            margin-bottom: 40px;
        }

        .product-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }

        .product-card {
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .product-card img {
            max-width: 100%;
            height: 150px;
            object-fit: cover;
            margin-bottom: 10px;
        }

        .product-card h3 {
            font-size: 18px;
            color: #333;
            margin: 10px 0;
        }

        .product-card .price {
            color: #007BFF;
            font-size: 16px;
            margin: 5px 0;
        }

        .product-card .rating {
            color: #555;
            margin-bottom: 10px;
        }

        .product-card .action-buttons a {
            display: inline-block;
            margin: 5px 5px 0 0;
            padding: 8px 12px;
            font-size: 14px;
            color: white;
            background-color: #007BFF;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .product-card .action-buttons a:hover {
            background-color: #0056b3;
        }

        .no-products {
            text-align: center;
            color: #777;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <h2>Products by Category</h2>
    <div class="container">
        <?php
        if ($categoriesResult->num_rows > 0) {
            // Loop through each category
            while ($categoryRow = $categoriesResult->fetch_assoc()) {
                $category = $categoryRow['category'];

                echo "<div class='category-section'>";
                echo "<h3>" . htmlspecialchars($category) . "</h3>";

                // Fetch products for the current category
                $productsResult = $conn->query("SELECT * FROM productbysadmin WHERE category = '$category'");

                if ($productsResult->num_rows > 0) {
                    echo "<div class='product-list'>";
                    while ($row = $productsResult->fetch_assoc()) {
                        echo '
                        <div class="product-card">
                            <img src="' . htmlspecialchars($row["image_path"]) . '" alt="' . htmlspecialchars($row["product_name"]) . '">
                            <h3>' . htmlspecialchars($row["product_name"]) . '</h3>
                            <div class="price">$' . number_format($row["price"], 2) . '</div>
                            <div class="rating">Rating: ' . htmlspecialchars($row["rating"]) . ' ⭐</div>
                            <div class="action-buttons">
                                
                                <a href="addcart.php?product_id=' . $row["product_id"] . '" class="addcart-button">Add to Cart</a>
                            </div>
                        </div>
                        ';
                    }
                    echo "</div>";
                } else {
                    echo "<p class='no-products'>No products available in this category.</p>";
                }
                echo "</div>";
            }
        } else {
            echo "<p>No categories found.</p>";
        }

        // Close the database connection
        $conn->close();
        ?>
    </div>
</body>
</html>
