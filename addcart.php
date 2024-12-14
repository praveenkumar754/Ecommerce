<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart Page</title>
    <link rel="stylesheet" href="./style.css">
    <style>
        .cart-container {
            padding: 20px;
        }
        .cart-item {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 8px;
        }
        .cart-item img {
            height: 100px;
            width: 100px;
            object-fit: cover;
            margin-right: 20px;
        }
        .cart-item .details {
            flex-grow: 1;
        }
        .cart-item .details .product-name {
            font-size: 1.25rem;
            font-weight: bold;
        }
        .cart-item .details .product-price {
            color: #007bff;
            margin-top: 5px;
        }
        .cart-item .remove-btn {
            background: #dc3545;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 8px 12px;
            cursor: pointer;
        }
        .cart-item .remove-btn:hover {
            background: #b52d3a;
        }
    </style>
</head>
<body>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include 'navbar.php'; ?>

    <div class="cart-container">
        <h2>Your Cart</h2>
        <div id="cart-items"></div>
    </div>

    <script>
        // Load cart items from localStorage
        const cartItems = JSON.parse(localStorage.getItem('cart')) || [];

        // Function to display cart items
        function displayCartItems() {
            const cartContainer = document.getElementById('cart-items');
            cartContainer.innerHTML = '';

            if (cartItems.length === 0) {
                cartContainer.innerHTML = '<p>Your cart is empty.</p>';
                return;
            }

            cartItems.forEach((item, index) => {
                const cartItem = document.createElement('div');
                cartItem.classList.add('cart-item');

                cartItem.innerHTML = `
                    <img src="${item.image}" alt="${item.name}">
                    <div class="details">
                        <div class="product-name">${item.name}</div>
                        <div class="product-price">${item.price}</div>
                    </div>
                    <button class="remove-btn" onclick="removeItem(${index})">Remove</button>
                `;

                cartContainer.appendChild(cartItem);
            });
        }

        // Function to remove item from cart
        function removeItem(index) {
            cartItems.splice(index, 1);
            localStorage.setItem('cart', JSON.stringify(cartItems));
            displayCartItems();
        }

        // Display cart items on page load
        displayCartItems();
    </script>
</body>
</html>
