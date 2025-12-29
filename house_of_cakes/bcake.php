<?php
session_start();
$title = "House Of Cakes";
?>

<?php
$conn = new mysqli("localhost", "root", "", "cake_website");

// Add to cart functionality
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_to_cart'])) {
    if (!isset($_SESSION['user_id'])) {
        echo "<script>alert('Please login to add to cart.'); window.location.href='login.php';</script>";
        exit();
    }

    $user_id = $_SESSION['user_id'];
    $name = $_POST['cake_name'];
    $price = $_POST['price'];
    $qty = $_POST['quantity'];
    $total = $price * $qty;

    $conn->query("INSERT INTO cart (user_id, cake_name, quantity, total_price) 
                  VALUES ('$user_id', '$name', $qty, $total)");

    echo "<script>alert('Successfully added $name to your cart!');</script>";
}

// Fetch pastries
$pcake_result = $conn->query("SELECT * FROM bcake");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Birthday Cakes - House Of Cakes</title>
    <link rel="stylesheet" href="bcake.css">
</head>
<body>
    
    <h1>Birthday Cakes</h1>

    <div class="container">
        <?php while ($pcake = $pcake_result->fetch_assoc()) { ?>
            <div class="cake-box">
                <img src="image1/<?php echo $pcake['image']; ?>" class="cake-img"><br>
                <b><?php echo $pcake['name']; ?></b><br>
                1 kg Price: ₹<?php echo $pcake['price']; ?><br>
                <form method="POST" onsubmit="return validateForm(<?php echo $pcake['id']; ?>)">
                    <input type="hidden" name="cake_name" value="<?php echo $pcake['name']; ?>">
                    <input type="hidden" name="price" value="<?php echo $pcake['price']; ?>">
                    <input type="hidden" name="add_to_cart" value="1">
                    Quantity:
                    <select name="quantity" id="quantity_<?php echo $pcake['id']; ?>" onchange="updateTotal(<?php echo $pcake['id']; ?>, <?php echo $pcake['price']; ?>)">
                        <?php for ($i = 1; $i <= 5; $i++) echo "<option value='$i'>$i</option>"; ?>
                    </select><br>
                    Total: ₹<span id="total_<?php echo $pcake['id']; ?>"><?php echo $pcake['price']; ?></span><br><br>
                    <button type="submit">Add to Cart</button>
                </form>
            </div>
        <?php } ?>
    </div>

    <div class="cart-box">
        <a href="cart.php">🛒 View Cart</a>
    </div>

    <script>
        function updateTotal(id, price) {
            var quantity = document.getElementById('quantity_' + id).value;
            var total = price * quantity;
            document.getElementById('total_' + id).innerText = total;
        }

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
