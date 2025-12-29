<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$username = $_SESSION['user_name'];

// Fetch cart items
$cartResult = $conn->query("SELECT * FROM cart WHERE user_id = $user_id");
$grand_total = 0;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
    <link rel="stylesheet" href="checkout.css">
</head>
<body>

<h1>Checkout</h1>

<form action="place_order.php" method="POST">
    <h2>Delivery Details</h2>

    <label>First Name:</label>
    <input type="text" name="first_name" required>

    <label>Last Name:</label>
    <input type="text" name="last_name" required>

    <label>Street Address:</label>
    <textarea name="address" rows="2" required></textarea>

    <label>Apartment, suite, etc. (optional):</label>
    <input type="text" name="apartment">

    <label>City:</label>
    <input type="text" name="city" required>

    <label>State:</label>
    <input type="text" name="state" required>

    <label>Pincode:</label>
    <input type="text" name="pincode" required>

    <label>Phone Number:</label>
    <input type="text" name="phone" required>

    <label>Email Address:</label>
    <input type="email" name="email" required>

    <h2 style="margin-top: 30px;">Your Order</h2>

    <table>
        <tr>
            <th>Image</th>
            <th>Cake Name</th>
            <th>Quantity</th>
            <th>Total Price (₹)</th>
        </tr>

        <?php
        if ($cartResult->num_rows > 0) {
            while ($row = $cartResult->fetch_assoc()) {
                $imagePath = "image1/" . htmlspecialchars($row['cake_image']);
                $grand_total += $row['total_price'];
                ?>
                
                <tr>
                    <td><img src="<?= $imagePath ?>" alt="Cake"></td>
                    <td><?= htmlspecialchars($row['cake_name']) ?></td>
                    <td><?= $row['quantity'] ?></td>
                    <td>₹<?= number_format($row['total_price'], 2) ?></td>
                </tr>

                <?php
            }
            ?>
            <tr class="total-row">
                <td colspan="3">Grand Total</td>
                <td>₹<?= number_format($grand_total, 2) ?></td>
            </tr>
            <?php
        } else {
            echo "<tr><td colspan='4'>Your cart is empty.</td></tr>";
        }
        ?>
    </table>

    <div class="submit-btn">
        <input type="submit" value="Place Order">
    </div>
</form>

</body>
</html>
