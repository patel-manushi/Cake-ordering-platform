<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$username = $_SESSION['user_name'];

// Handle individual item removal
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['remove_item'])) {
        $item_id = intval($_POST['item_id']);
        $conn->query("DELETE FROM cart WHERE id = $item_id AND user_id = $user_id");
    }

    // Handle clear cart
    if (isset($_POST['clear_cart'])) {
        $conn->query("DELETE FROM cart WHERE user_id = $user_id");
    }
}

// Fetch updated cart
$result = $conn->query("SELECT * FROM cart WHERE user_id = $user_id");

$grand_total = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Cake Cart</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f5eb;
            color: #4b3f29;
            margin: 0;
            padding: 0;
        }
        h1 {
            text-align: center;
            color: #7f5a3e;
            margin-top: 30px;
            font-size: 45px;
        }
        .cart-table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .cart-table th, .cart-table td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
        }
        .cart-table th {
            background-color: #7f5a3e;
            color: white;
        }
        .grand-total {
            font-weight: bold;
        }
        .back-link {
            text-align: center;
            margin-top: 20px;
        }
        .back-link a, .back-link button {
            background-color: #7f5a3e;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 6px;
            border: none;
            cursor: pointer;
        }
        .back-link a:hover, .back-link button:hover {
            background-color: #6a4e3b;
        }
        .empty-cart {
            text-align: center;
            font-size: 18px;
        }
        .remove-btn {
            background-color: #e74c3c;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
        }
        .remove-btn:hover {
            background-color: #c0392b;
        }
        
        .action-buttons {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
            width: 80%;
            margin: 30px auto;
        }

        .left-buttons, .right-buttons {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            font-weight: bold;
            border: none;
            border-radius: 6px;
            text-decoration: none;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        /* Individual Button Styles */
        .clear-btn {
            background-color: #e74c3c;
        }

        .clear-btn {
            background-color: #8B4513; /* SaddleBrown */
        }

        .clear-btn:hover {
            background-color: #6A2C1D; /* Darker SaddleBrown */
        }

        .continue-btn {
            background-color: #A0522D; /* Sienna */
        }

        .continue-btn:hover {
            background-color: #8B3E2F; /* Darker Sienna */
        }

        .checkout-btn {
            background-color: #D2691E; /* Chocolate */
        }

        .checkout-btn:hover {
            background-color: #C85A2A; /* Darker Chocolate */
        }

        .logout-btn {
            background-color: #9C6A42; /* Light Brown */
        }

        .logout-btn:hover {
            background-color: #7C4F29; /* Darker Light Brown */
        }
    </style>
</head>
<body>

<h1>🧁 <?php echo htmlspecialchars($username); ?>'s Cake Cart</h1>

<form method="POST">
    <table class="cart-table">
        <tr>
            <th>Image</th>
            <th>Cake Name</th>
            <th>Quantity</th>
            <th>Total Price (₹)</th>
            <th>Action</th>
        </tr>

        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $grand_total += $row['total_price'];
                $imagePath = "image1/" . htmlspecialchars($row['cake_image']);
                ?>
                <tr>
                    <td>
                        <?php if (file_exists($imagePath)) { ?>
                            <img src="<?php echo $imagePath; ?>" width="100" height="100" alt="Cake Image">
                        <?php } else { ?>
                            <span style="color:red;">Image not found</span>
                        <?php } ?>
                    </td>
                    <td><?php echo htmlspecialchars($row['cake_name']); ?></td>
                    <td><?php echo $row['quantity']; ?></td>
                    <td>₹<?php echo number_format($row['total_price'], 2); ?></td>
                    <td>
                        <button type="submit" name="remove_item" value="1" class="remove-btn" onclick="document.getElementById('item_id_<?php echo $row['id']; ?>').value='<?php echo $row['id']; ?>'; return confirm('Remove this item?');">
                            🗑 Remove
                        </button>
                        <input type="hidden" name="item_id" id="item_id_<?php echo $row['id']; ?>">
                    </td>
                </tr>
                <?php
            }
        } else {
            echo "<tr class='empty-cart'><td colspan='5'>Your cart is empty. 🛒</td></tr>";
            ?>
            <tr class='empty-cart'>
                <td colspan="5" class="empty-cart">
                    <a href="cakes.php" class="btn continue-btn">🛍️ Continue Shopping</a>
                </td>
            </tr>
            <?php
        }
        ?>

        <?php if ($grand_total > 0) { ?>
            <tr class="grand-total">
                <td colspan="4">Grand Total</td>
                <td>₹<?php echo number_format($grand_total, 2); ?></td>
            </tr>
        <?php } ?>
    </table>
<?php if ($grand_total > 0) { ?>
    <div class="action-buttons">
        <div class="left-buttons">
            <form method="POST" onsubmit="return confirm('Clear your entire cart?');">
                <button type="submit" name="clear_cart" class="btn clear-btn">🧹 Clear Cart</button>
            </form>
            <a href="cakes.php" class="btn continue-btn">🛍️ Continue Shopping</a>
        </div>
        <div class="right-buttons">
            <a href="checkout.php" class="btn checkout-btn">✅ Checkout</a>
            <a href="logout.php" class="btn logout-btn">🔒 Logout</a>
        </div>
    </div>
<?php } ?>

</body>
</html>
