<?php include 'navbar.php'; ?>
<?php
// Connect to the database
$conn = new mysqli("localhost", "root", "", "ecommerce");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all distinct categories from the database
$categoriesResult = $conn->query("SELECT DISTINCT category FROM productbyadmin");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products by Category</title>
    <style>
        /* Add your CSS styles here */
    </style>
</head>
<body>
    <h2>Products by Category</h2>
    <div class="container">
        <?php
        if ($categoriesResult->num_rows > 0) {
            while ($categoryRow = $categoriesResult->fetch_assoc()) {
                $category = $categoryRow['category'];

                echo "<div class='category-section'>";
                echo "<h3>" . htmlspecialchars($category) . "</h3>";

                $productsResult = $conn->query("SELECT * FROM productbyadmin WHERE category = '$category'");

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
                                <button class="buy-button" onclick="location.href=\'product_details.php?product_id=' . $row['product_id'] . '\'">Buy Now</button>
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

        $conn->close();
        ?>
    </div>
</body>
</html>
