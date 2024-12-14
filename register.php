<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Insert user details into the database
    $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
    if ($conn->query($sql) === TRUE) {
        header("Location: login.php"); // Redirect to login page after registration
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: #f0f4f8;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        form {
            background: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
            box-sizing: border-box;
        }
        input:focus {
            outline: none;
            border-color: #0099ff;
        }
        button {
            background-color: #0099ff;
            color: white;
            border: none;
            padding: 14px;
            width: 100%;
            font-size: 16px;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #007acc;
        }
        .form-footer {
            text-align: center;
            margin-top: 15px;
            font-size: 14px;
        }
        .form-footer a {
            color: #007BFF;
            text-decoration: none;
        }
        .form-footer a:hover {
            text-decoration: underline;
        }
        /* Media query for responsiveness */
        @media (max-width: 480px) {
            form {
                padding: 20px;
                max-width: 90%;
            }
            input, button {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>
    <form id="register-form" method="POST" action="">
        <h2>Register</h2>
        <input type="text" name="name" id="name" placeholder="Full Name" required>
        <input type="email" name="email" id="email" placeholder="Email Address" required>
        <input type="password" name="password" id="password" placeholder="Password" required>
        <button type="submit">Register</button>
        <div class="form-footer">
            <p>Already have an account? <a href="login.php">Login here</a></p>
        </div>
    </form>

    <script>
        // JavaScript for client-side validation
        document.getElementById('register-form').addEventListener('submit', function(event) {
            const name = document.getElementById('name').value.trim();
            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value.trim();

            if (!name || !email || !password) {
                event.preventDefault(); // Prevent form submission
                alert('Please fill out all fields in the registration form.');
            }
        });
    </script>
</body>
</html>
