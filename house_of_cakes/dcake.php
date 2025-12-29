<?php
// Start session to manage user login status
session_start();

// Page title for dynamic use
$title = "House Of Cakes";
?>

<?php
// Database connection (MySQLi)
$conn = new mysqli("localhost", "root", "", "cake_website");

// Add to cart functionality: runs only if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_to_cart'])) {

    // Check if user is logged in, otherwise redirect to login page
    if (!isset($_SESSION['user_id'])) {
        echo "<script>alert('Please login to add to cart.'); window.location.href='login.php';</script>";
        exit();
    }

    // Store submitted product details into variables
    $user_id = $_SESSION['user_id'];
    $name = $_POST['cake_name'];
    $price = $_POST['price'];
    $qty = $_POST['quantity'];
    $total = $price * $qty; // Total amount calculation

    // Insert product into cart table for logged-in user
    $conn->query("INSERT INTO cart (user_id, cake_name, quantity, total_price) VALUES ('$user_id', '$name', $qty, $total)");

    // Display success message
    echo "<script>alert('Successfully added $name to your cart!');</script>";
}

// Fetch Designer Cakes from database table
$pcake_result = $conn->query("SELECT * FROM dcake");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pastries - House Of Cakes</title> <!-- Page Title -->
</head>

<body>

    <h1>Designer Cakes</h1> <!-- Section Heading -->

    <!-- External CSS for styling -->
    <link rel="stylesheet" href="bcake.css">

    <!-- Cakes Display Section -->
    <div class="container">
        <?php while ($pcake = $pcake_result->fetch_assoc()) { ?>
            <div class="cake-box">
                <!-- Display cake image -->
                <img src="image1/<?php echo $pcake['image']; ?>" class="cake-img"><br>

                <!-- Cake name -->
                <b><?php echo $pcake['name']; ?></b><br>

                <!-- Price display -->
                1 kg Price: ₹<?php echo $pcake['price']; ?><br>

                <!-- Add to Cart Form -->
                <form method="POST" onsubmit="return validateForm(<?php echo $pcake['id']; ?>)">
                    <!-- Hidden inputs to store details -->
                    <input type="hidden" name="cake_name" value="<?php echo $pcake['name']; ?>">
                    <input type="hidden" name="price" value="<?php echo $pcake['price']; ?>">
                    <input type="hidden" name="add_to_cart" value="1">

                    <!-- Quantity selection -->
                    Quantity:
                    <select name="quantity" id="quantity_<?php echo $pcake['id']; ?>" 
                            onchange="updateTotal(<?php echo $pcake['id']; ?>, <?php echo $pcake['price']; ?>)">
                        <?php for ($i = 1; $i <= 5; $i++) echo "<option value='$i'>$i</option>"; ?>
                    </select><br>

                    <!-- Dynamic Total Price -->
                    Total: ₹<span id="total_<?php echo $pcake['id']; ?>"><?php echo $pcake['price']; ?></span><br><br>

                    <!-- Add to Cart button -->
                    <button type="submit">Add to Cart</button>
                </form>
            </div>
        <?php } ?>
    </div>

    <!-- View Cart Button -->
    <div class="cart-box">
        <a href="cart.php">🛒 View Cart</a>
    </div>

    <script>
        // Update total price when quantity changes
        function updateTotal(id, price) {
            var quantity = document.getElementById('quantity_' + id).value;
            var total = price * quantity;
             document.getElementById('total_' + id).innerText = total;
        }

        // Validate quantity before adding to cart
        function validateForm(id) {
            var quantity = document.getElementById('quantity_' + id).value;
            if (quantity < 1) {
                alert("Please select a valid quantity!");
                return false;
            }
            return true;
        }
    </script>

</body>
</html>
