<?php
include 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_name'] = $row['name'];
            header("Location: home.php"); // Redirect to home page on successful login
            exit;
        } else {
            echo "<script>alert('Invalid password!');</script>";
        }
    } else {
        echo "<script>alert('No user found with that email!');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
            border-color: #007BFF;
        }
        button {
            background-color: #007BFF;
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
            background-color: #0056b3;
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
    <form id="login-form" method="POST" action="">
        <h2>Login</h2>
        <input type="email" name="email" id="email" placeholder="Email Address" required>
        <input type="password" name="password" id="password" placeholder="Password" required>
        <button type="submit">Login</button>
        <div class="form-footer">
            <p>Don't have an account? <a href="register.php">Register here</a></p>
        </div>
    </form>

    <script>
        // JavaScript for client-side validation
        document.getElementById('login-form').addEventListener('submit', function(event) {
            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value.trim();

            if (!email || !password) {
                event.preventDefault(); // Prevent form submission
                alert('Please fill out all fields in the login form.');
            }
        });
    </script>
</body>
</html>
