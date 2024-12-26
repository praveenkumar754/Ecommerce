<?php
// Connect to the database
$conn = new mysqli("localhost", "root", "", "ecommerce");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// If form is submitted, insert the product
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['add_product'])) {
    // Collect form data
    $productName = $_POST['product_name'];
    $price = $_POST['price'];
    $rating = $_POST['rating'];
    $category = $_POST['category'];

    // Handle file upload
    $targetDir = "uploads/";
    $imageName = basename($_FILES["image"]["name"]);
    $targetFile = $targetDir . $imageName;

    // Ensure the "uploads" folder exists
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    // Move uploaded file to the target folder
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
        // Insert into database
        $stmt = $conn->prepare("INSERT INTO productbysadmin (product_name, price, rating, category, image_path) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sdsss", $productName, $price, $rating, $category, $targetFile);

        if ($stmt->execute()) {
            echo "<script>alert('Product added successfully!');</script>";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Failed to upload the image.";
    }
}

// Handle product deletion
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    // Delete product from the database
    $conn->query("DELETE FROM productbysadmin WHERE product_id = '$delete_id'");
    echo "<script>alert('Product deleted successfully!'); window.location.href='addproduct.php';</script>";
}

// Fetch categories
$categoriesResult = $conn->query("SELECT DISTINCT category FROM productbysadmin");
?>

<?php include 'navbar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        h2, h3, h4 {
            text-align: center;
            margin-top: 20px;
        }

        .home-link {
            display: block;
            text-align: center;
            margin: 10px 0;
            font-size: 16px;
        }

        form {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        form label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        form input, form select, form button {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        form button {
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        form button:hover {
            background-color: #0056b3;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            margin: 20px auto;
            max-width: 1200px;
        }

        .product-card {
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 280px;
            text-align: center;
            padding: 15px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .product-card img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            margin-bottom: 10px;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }

        .product-name {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .product-price {
            font-size: 16px;
            color: #28a745;
            margin-bottom: 10px;
        }

        .rating {
            font-size: 14px;
            color: #f39c12;
            margin-bottom: 10px;
        }

        .update-button, .delete-button {
            display: inline-block;
            padding: 10px 20px;
            margin: 5px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 14px;
            color: #fff;
            transition: background-color 0.3s ease;
        }

        .update-button {
            background-color: #007bff;
        }

        .delete-button {
            background-color: #dc3545;
        }

        .update-button:hover {
            background-color: #0056b3;
        }

        .delete-button:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <h2>Add New Product</h2>
    <a href="index.php" class="home-link">Go to Home Page</a>

    <form action="addproduct.php" method="POST" enctype="multipart/form-data">
        <label>Product Name</label>
        <input type="text" name="product_name" required>

        <label>Price</label>
        <input type="number" step="0.01" name="price" required>

        <label>Rating (1-5)</label>
        <input type="number" name="rating" min="1" max="5" required>

        <label>Category</label>
        <select name="category" required>
            <option value="Electronics">Electronics</option>
            <option value="Clothing">Clothing</option>
            <option value="Home">Home</option>
            <option value="Books">Books</option>
            <option value="shoe">Shoe</option>
        </select>

        <label>Upload Product Image</label>
        <input type="file" name="image" accept="image/*" required>

        <button type="submit" name="add_product">Add Product</button>
    </form>

    <h3>Products by Category</h3>

    <?php
    if ($categoriesResult->num_rows > 0) {
        while ($categoryRow = $categoriesResult->fetch_assoc()) {
            $category = $categoryRow['category'];

            echo "<h4>" . htmlspecialchars($category) . "</h4>";

            $productsResult = $conn->query("SELECT * FROM productbysadmin WHERE category = '$category'");

            echo "<div class='container'>";
            if ($productsResult->num_rows > 0) {
                while ($productRow = $productsResult->fetch_assoc()) {
                    echo '
                    <div class="product-card">
                        <img src="' . htmlspecialchars($productRow["image_path"]) . '" alt="Product Image">
                        <div class="product-name">' . htmlspecialchars($productRow["product_name"]) . '</div>
                        <div class="product-price">$' . number_format($productRow["price"], 2) . '</div>
                        <div class="rating">Rating: ' . htmlspecialchars($productRow["rating"]) . ' ⭐</div>
                        <a href="updateproduct.php?product_id=' . $productRow["product_id"] . '" class="update-button">Update</a>
                        <a href="addproduct.php?delete_id=' . $productRow["product_id"] . '" class="delete-button" onclick="return confirm(\'Are you sure you want to delete this product?\')">Delete</a>
                    </div>
                    ';
                }
            } else {
                echo "<p style='text-align: center;'>No products in this category.</p>";
            }
            echo "</div>";
        }
    } else {
        echo "<p style='text-align: center;'>No categories available.</p>";
    }

    $conn->close();
    ?>
</body>
</html>
