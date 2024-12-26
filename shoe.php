<?php
// Connect to the database
$conn = new mysqli("localhost", "root", "", "ecommerce");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// If form is submitted, insert the product
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Collect form data
    $productName = $_POST['product_name'];
    $price = $_POST['price'];
    $rating = $_POST['rating'];
    $category = strtolower(trim($_POST['category'])); // Convert category to lowercase
    $fileName = $category . ".php"; // Generate file name based on category

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
        $stmt = $conn->prepare("INSERT INTO productbyadmin (product_name, price, rating, image_path) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sdss", $productName, $price, $rating, $targetFile);

        if ($stmt->execute()) {
            // Create or append the product to the category file
            $productCard = '
            <div class="product-card">
                <img src="' . htmlspecialchars($targetFile) . '" alt="Product Image">
                <div class="product-name">' . htmlspecialchars($productName) . '</div>
                <div class="product-price">$' . number_format($price, 2) . '</div>
                <div class="rating">Rating: ' . htmlspecialchars($rating) . ' ⭐</div>
            </div>
            ';

            // Create file if it doesn't exist
            if (!file_exists($fileName)) {
                $fileContent = '
                <?php
                echo "<h2>' . ucfirst($category) . ' Products</h2>";
                ?>
                <style>
                    .product-card {
                        background: #f9f9f9;
                        border: 1px solid #ddd;
                        padding: 15px;
                        margin: 10px;
                        text-align: center;
                        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
                    }
                    .product-card img {
                        max-width: 100%;
                        height: 150px;
                        object-fit: cover;
                    }
                </style>
                ';
                file_put_contents($fileName, $fileContent);
            }

            // Append product card to the category file
            file_put_contents($fileName, $productCard, FILE_APPEND);

            // Redirect to prevent resubmission on refresh
            header("Location: addproduct.php");
            exit;
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Failed to upload the image.";
    }
}

// Fetch products to display below the form
$result = $conn->query("SELECT * FROM productbyadmin");

$conn->close();
?>
