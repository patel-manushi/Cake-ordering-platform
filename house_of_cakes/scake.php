<?php
session_start(); // Start the session to manage user login session
$title = "House Of Cakes"; // Page title
?>

<?php
// Database connection
$conn = new mysqli("localhost", "root", "", "cake_website");

// Add to cart functionality
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_to_cart'])) {

    // Check if user logged in, otherwise redirect to login
    if (!isset($_SESSION['user_id'])) {
        echo "<script>alert('Please login to add to cart.'); window.location.href='login.php';</script>";
        exit();
    }

    // Fetch form data
    $user_id = $_SESSION['user_id'];
    $name = $_POST['cake_name'];
    $price = $_POST['price'];
    $qty = $_POST['quantity'];
    $total = $price * $qty; // Calculate total price

    // Insert selected cake into cart table
    $conn->query("INSERT INTO cart (user_id, cake_name, quantity, total_price) VALUES ('$user_id', '$name', $qty, $total)");

    // Success message popup
    echo "<script>alert('Successfully added $name to your cart!');</script>";
}

// Fetch Special Cakes from database
$pcake_result = $conn->query("SELECT * FROM scake");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pastries - House Of Cakes</title>
    <link rel="stylesheet" href="bcake.css"> <!-- Link CSS file -->
</head>

<body>

    <h1>Special Cakes</h1> <!-- Page heading -->

    <div class="container">
        <?php while ($pcake = $pcake_result->fetch_assoc()) { ?> <!-- Loop: Display each cake -->

        <div class="cake-box"> <!-- Cake container box -->

            <!-- Display cake image -->
            <img src="image1/<?php echo $pcake['image']; ?>" class="cake-img"><br>

            <!-- Display cake name -->
            <b><?php echo $pcake['name']; ?></b><br>

            <!-- Display price -->
            1 kg Price: ₹<?php echo $pcake['price']; ?><br>

            <!-- Add to cart form -->
            <form method="POST" onsubmit="return validateForm(<?php echo $pcake['id']; ?>)">

                <!-- Hidden input fields for storing data -->
                <input type="hidden" name="cake_name" value="<?php echo $pcake['name']; ?>">
                <input type="hidden" name="price" value="<?php echo $pcake['price']; ?>">
                <input type="hidden" name="add_to_cart" value="1">

                <!-- Dropdown to select quantity -->
                Quantity:
                <select name="quantity" id="quantity_<?php echo $pcake['id']; ?>" onchange="updateTotal(<?php echo $pcake['id']; ?>, <?php echo $pcake['price']; ?>)">
                    <?php for ($i = 1; $i <= 5; $i++) echo "<option value='$i'>$i</option>"; ?>
                </select><br>

                <!-- Dynamic total price display -->
                Total: ₹<span id="total_<?php echo $pcake['id']; ?>"><?php echo $pcake['price']; ?></span><br><br>

                <button type="submit">Add to Cart</button> <!-- Submit button -->
            </form>

        </div>

        <?php } ?> <!-- End while loop -->
    </div>

    <!-- Link to Cart page -->
    <div class="cart-box">
        <a href="cart.php">🛒 View Cart</a>
    </div>

    <script>
        // Update total price based on selected quantity
        function updateTotal(id, price) {
            var quantity = document.getElementById('quantity_' + id).value;
            var total = price * quantity;
            document.getElementById('total_' + id).innerText = total;
        }

        // Validate if quantity selected properly
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
