<?php
session_start(); // Start session to access user login information

// Check if user is logged in, if not redirect to login page
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login page
    exit(); // Stop further execution
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Order Success</title> <!-- Page title -->
</head>
<body>

    <!-- Success message content -->
    <h1>Order Placed Successfully!</h1>
    <p>Your order has been successfully placed. Thank you for shopping with us!</p>

    <!-- Link to return to homepage -->
    <a href="index.php">Go back to Home</a>

</body>
</html>
