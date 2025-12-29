<?php
// Start the session to track logged-in user information
session_start();

$title = "House Of Cakes"; // Page title variable
?>

<?php
// Database connection (localhost)
$conn = new mysqli("localhost", "root", "", "cake_website");


// ✅ Add to Cart functionality starts here
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_to_cart'])) {
    
    // If user not logged in, show alert and redirect to login page
    if (!isset($_SESSION['user_id'])) {
        echo "<script>alert('Please login to add to cart.'); window.location.href='login.php';</script>";
        exit();
    }

    // Get user and cake details from form
    $user_id = $_SESSION['user_id'];
    $name = $_POST['cake_name'];
    $price = $_POST['price'];
    $qty = $_POST['quantity'];
    $total = $price * $qty; // calculate total price

    // Insert added cake into cart table
    $conn->query("INSERT INTO cart (user_id, cake_name, quantity, total_price) VALUES ('$user_id', '$name', $qty, $total)");

    // Show success message
    echo "<script>alert('Successfully added $name to your cart!');</script>";
}
// ✅ Add to Cart code ends here



// ✅ Fetch cake list from database (lcake table)
$pcake_result = $conn->query("SELECT * FROM lcake");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pastries - House Of Cakes</title>
</head>
<body>

    <!-- Page Heading -->
    <h1>Love Cakes</h1>

    <!-- Linked external CSS file -->
    <link rel="stylesheet" href="bcake.css">

    <!-- Display all cakes -->
    <div class="container">
        <?php while ($pcake = $pcake_result->fetch_assoc()) { ?>
            <div class="cake-box">
                
                <!-- Cake image -->
                <img src="image1/<?php echo $pcake['image']; ?>" class="cake-img"><br>

                <!-- Cake name -->
                <b><?php echo $pcake['name']; ?></b><br>

                <!-- Cake price -->
                1 kg Price: ₹<?php echo $pcake['price']; ?><br>

                <!-- Add to cart form -->
                <form method="POST" onsubmit="return validateForm(<?php echo $pcake['id']; ?>)">
                    <input type="hidden" name="cake_name" value="<?php echo $pcake['name']; ?>">
                    <input type="hidden" name="price" value="<?php echo $pcake['price']; ?>">
                    <input type="hidden" name="add_to_cart" value="1">

                    <!-- Select quantity -->
                    Quantity:
                    <select name="quantity" id="quantity_<?php echo $pcake['id']; ?>" onchange="updateTotal(<?php echo $pcake['id']; ?>, <?php echo $pcake['price']; ?>)">
                        <?php for ($i = 1; $i <= 5; $i++) echo "<option value='$i'>$i</option>"; ?>
                    </select><br>

                    <!-- Total price display -->
                    Total: ₹<span id="total_<?php echo $pcake['id']; ?>"><?php echo $pcake['price']; ?></span><br><br>

                    <!-- Submit Button -->
                    <button type="submit">Add to Cart</button>
                </form>
            </div>
        <?php } ?>
    </div>

    <!-- Cart Button -->
    <div class="cart-box">
        <a href="cart.php">🛒 View Cart</a>
    </div>

    <!-- JavaScript for updating total price -->
    <script>
        function updateTotal(id, price) {
            var quantity = document.getElementById('quantity_' + id).value;
            var total = price * quantity;
            document.getElementById('total_' + id).innerText = total;
        }

        // Quantity validation before adding to cart
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
