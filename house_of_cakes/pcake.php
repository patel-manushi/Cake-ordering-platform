<?php
session_start(); // Start session to check if user is logged in
$title = "House Of Cakes";
?>

<?php
// Database Connection
$conn = new mysqli("localhost", "root", "", "cake_website");

// Add to Cart Functionality
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_to_cart'])) {

    // If user is not logged in, redirect to login page
    if (!isset($_SESSION['user_id'])) {
        echo "<script>alert('Please login to add to cart.'); window.location.href='login.php';</script>";
        exit();
    }

    // Get data from form
    $user_id = $_SESSION['user_id'];
    $name = $_POST['cake_name'];
    $price = $_POST['price'];
    $qty = $_POST['quantity'];
    $total = $price * $qty; // Total price calculation

    // Insert selected item into cart table
    $conn->query("INSERT INTO cart (user_id, cake_name, quantity, total_price) VALUES ('$user_id', '$name', $qty, $total)");

    // Success popup message
    echo "<script>alert('Successfully added $name to your cart!');</script>";
}

// Fetch all pastries (photo cakes) from database
$pcake_result = $conn->query("SELECT * FROM pcakes");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pastries - House Of Cakes</title>
    <link rel="stylesheet" href="bcake.css"> <!-- External CSS link -->
</head>

<body>

    <h1>Photo Cakes</h1>

    <div class="container">
        <?php while ($pcake = $pcake_result->fetch_assoc()) { ?> <!-- Loop through photo cake records -->
            
            <div class="cake-box">
                <img src="image1/<?php echo $pcake['image']; ?>" class="cake-img"><br> <!-- Display cake image -->

                <b><?php echo $pcake['name']; ?></b><br> <!-- Display cake name -->
                1 kg Price: ₹<?php echo $pcake['price']; ?><br> <!-- Display base price -->

                <!-- Add to Cart Form -->
                <form method="POST" onsubmit="return validateForm(<?php echo $pcake['id']; ?>)">
                    
                    <!-- Hidden Inputs -->
                    <input type="hidden" name="cake_name" value="<?php echo $pcake['name']; ?>">
                    <input type="hidden" name="price" value="<?php echo $pcake['price']; ?>">
                    <input type="hidden" name="add_to_cart" value="1">

                    <!-- Quantity Selection -->
                    Quantity:
                    <select name="quantity" id="quantity_<?php echo $pcake['id']; ?>" onchange="updateTotal(<?php echo $pcake['id']; ?>, <?php echo $pcake['price']; ?>)">
                        <?php for ($i = 1; $i <= 5; $i++) { ?>
                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                        <?php } ?>
                    </select>
                    <br>

                    <!-- Dynamic Total Price -->
                    Total: ₹<span id="total_<?php echo $pcake['id']; ?>"><?php echo $pcake['price']; ?></span>
                    <br><br>

                    <!-- Submit Button -->
                    <button type="submit">Add to Cart</button>
                </form>
            </div>

        <?php } ?>
    </div>

    <!-- Cart Page Link -->
    <div class="cart-box">
        <a href="cart.php">🛒 View Cart</a>
    </div>

    <!-- JavaScript: Update Total Price based on Quantity -->
    <script>
        function updateTotal(id, price) {
            var quantity = document.getElementById('quantity_' + id).value;
            var total = price * quantity;
            document.getElementById('total_' + id).innerText = total;
        }

        // Form Validation: Ensure valid quantity selected
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
