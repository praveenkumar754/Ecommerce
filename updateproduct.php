<?php include 'navbar.php'; ?>
<?php
// Connect to the database
$conn = new mysqli("localhost", "root", "", "ecommerce");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch product details for the given ID
$product_id = $_GET['product_id'];
$productResult = $conn->query("SELECT * FROM productbysadmin WHERE product_id = '$product_id'");
$product = $productResult->fetch_assoc();

// Handle update form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $productName = $_POST['product_name'];
    $price = $_POST['price'];
    $rating = $_POST['rating'];
    $category = $_POST['category'];

    // Update the product in the database
    $stmt = $conn->prepare("UPDATE productbysadmin SET product_name = ?, price = ?, rating = ?, category = ? WHERE product_id = ?");
    $stmt->bind_param("sdssi", $productName, $price, $rating, $category, $product_id);

    if ($stmt->execute()) {
        echo "<script>alert('Product updated successfully!'); window.location.href='addproduct.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #e8efff;
        }
        .form-container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 90%;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
            color: #555;
        }
        input, select, button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }
        button {
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <form action="" method="POST">
            <h2>Update Product</h2>
            <label for="product_name">Product Name</label>
            <input type="text" id="product_name" name="product_name" value="<?= htmlspecialchars($product['product_name']) ?>" required>

            <label for="price">Price</label>
            <input type="number" id="price" step="0.01" name="price" value="<?= htmlspecialchars($product['price']) ?>" required>

            <label for="rating">Rating (1-5)</label>
            <input type="number" id="rating" name="rating" min="1" max="5" value="<?= htmlspecialchars($product['rating']) ?>" required>

            <label for="category">Category</label>
            <select id="category" name="category" required>
                <option value="Electronics" <?= $product['category'] === 'Electronics' ? 'selected' : '' ?>>Electronics</option>
                <option value="Clothing" <?= $product['category'] === 'Clothing' ? 'selected' : '' ?>>Clothing</option>
                <option value="Home" <?= $product['category'] === 'Home' ? 'selected' : '' ?>>Home</option>
                <option value="Books" <?= $product['category'] === 'Books' ? 'selected' : '' ?>>Books</option>
            </select>

            <button type="submit">Update Product</button>
        </form>
    </div>
</body>
</html>
