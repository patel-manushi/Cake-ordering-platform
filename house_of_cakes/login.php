<?php
session_start(); // Start session for storing user login data
include 'db.php'; // Database connection file include

$message = ""; // Variable to display success/error messages

// ✅ LOGIN HANDLING
if (isset($_POST['login'])) {

    // Get user input & trim extra spaces
    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    // Prepare login query to check if email exists
    $stmt = $conn->prepare("SELECT id, name, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    // If email record found
    if ($stmt->num_rows == 1) {

        // Get stored user details
        $stmt->bind_result($id, $name, $hashed);
        $stmt->fetch();

        // Verify entered password with hashed password in DB
        if (password_verify($password, $hashed)) {

            // Save login details inside session
            $_SESSION["user_id"] = $id;
            $_SESSION["user_name"] = $name;

            // Redirect to cart page after successful login
            header("Location: cart.php");
            exit();
        } else {
            // Wrong password message
            $message = "❌ Invalid password.";
        }
    } else {
        // Email does not exist message
        $message = "❌ Email not registered.";
    }
}

// ✅ REGISTRATION HANDLING
if (isset($_POST['register'])) {

    // Fetch and clean input data
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);

    // Encrypt password for secure storing
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    // Check whether email already exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    // If email found, show message
    if ($stmt->num_rows > 0) {
        $message = "❌ Email already registered.";
    } else {

        // Insert new user into DB
        $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $password);

        // Check if registration was successful
        if ($stmt->execute()) {
            $message = "✅ Registration successful. You can now login.";
        } else {
            // Display error message if query fails
            $message = "❌ Error: " . $stmt->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Page Meta Tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login / Register</title>

    <script>
        // Function to switch between Login & Register forms
        function showForm(type) {
            document.getElementById('login-form').classList.remove('active');
            document.getElementById('register-form').classList.remove('active');
            document.getElementById(type + '-form').classList.add('active');
        }
    </script>

    <!-- Internal CSS Styling -->
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f9f5eb;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background-color: #f8e8dc;
            padding: 40px 30px;
            border-radius: 15px;
            border: 2px solid #6f4f1f;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
        }
        h2 {
            text-align: center;
            color: #6f4f1f;
            margin-bottom: 25px;
        }
        form {
            display: none;
            flex-direction: column;
        }
        form.active {
            display: flex;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #6f4f1f;
            border-radius: 8px;
            background-color: #f9f5eb;
            font-size: 15px;
        }
        button {
            background-color: #6f4f1f;
            color: white;
            padding: 12px;
            margin-top: 10px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #4b3f2f;
        }
        .switch {
            text-align: center;
            margin-top: 15px;
            font-size: 14px;
        }
        .switch a {
            color: #6f4f1f;
            cursor: pointer;
            font-weight: bold;
            text-decoration: none;
        }
        .switch a:hover {
            text-decoration: underline;
            color: #4b3f2f;
        }
        .message {
            background-color: #fff3cd;
            color: #856404;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 15px;
            border: 1px solid #ffeeba;
            font-size: 14px;
            text-align: center;
        }
        /* Responsive Styling */
        @media(max-width:1024px){
            .container{max-width:350px;padding:30px}
        }
        @media(max-width:768px){
            body{padding:0 10px;height:auto}
            .container{width:100%;margin:40px 0}
        }
    </style>
</head>

<body>

<div class="container">
    <!-- Main Heading -->
    <h2 id="form-title">Login / Register</h2>

    <!-- Show Success or Error Messages -->
    <?php if (!empty($message)): ?>
        <div class="message"><?= $message ?></div>
    <?php endif; ?>

    <!-- ✅ Login Form (Visible by default) -->
    <form method="post" id="login-form" class="active">
        <input type="email" name="email" placeholder="Email" required> <!-- Email field -->
        <input type="password" name="password" placeholder="Password" required> <!-- Password field -->
        <button type="submit" name="login">Login</button> <!-- Login Button -->
        <div class="switch">Don't have an account? <a onclick="showForm('register')">Register</a></div> <!-- Switch to Register -->
    </form>

    <!-- ✅ Register Form (Hidden initially) -->
    <form method="post" id="register-form">
        <input type="text" name="name" placeholder="Full Name" required> <!-- Name input -->
        <input type="email" name="email" placeholder="Email" required> <!-- Email input -->
        <input type="password" name="password" placeholder="Password" required> <!-- Password input -->
        <button type="submit" name="register">Register</button> <!-- Register Button -->
        <div class="switch">Already have an account? <a onclick="showForm('login')">Login</a></div> <!-- Switch to Login -->
    </form>

</div>

</body>
</html>
