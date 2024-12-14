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
            padding: 20px;
        }
        .form-container {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .form-container h2 {
            margin-bottom: 20px;
            text-align: center;
        }
        label {
            font-size: 14px;
            margin-top: 10px;
            display: block;
        }
        input[type="text"],
        input[type="number"],
        input[type="file"],
        select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<div class="form-container">
    <h2>Add New Product</h2>
    <form action="addproduct-handler.php" method="POST" enctype="multipart/form-data">
        <label for="productName">Product Name</label>
        <input type="text" id="productName" name="productName" required>

        <label for="price">Price</label>
        <input type="number" id="price" name="price" required>

        <label for="rate">Rating (1-5)</label>
        <input type="number" id="rate" name="rate" min="1" max="5" required>

        <label for="image">Product Image</label>
        <input type="file" id="image" name="image" accept="image/*" required>

        <button type="submit">Add Product</button>
    </form>
</div>

<script>
    // Redirect to the category page
    function redirectToCategory(category) {
        const params = new URLSearchParams({
            category: category
        });
        window.location.href = `products.php?${params.toString()}`;
    }
</script>
</body>
</html>
