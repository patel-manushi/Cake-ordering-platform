<?php
session_start();
$title = "House Of Cakes";

// Database Connection
$conn = new mysqli("localhost", "root", "", "cake_website");

// Add to cart functionality
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_to_cart'])) {

    if (!isset($_SESSION['user_id'])) {
        echo "<script>alert('Please login first!'); window.location.href='login.php';</script>";
        exit();
    }

    $user_id = $_SESSION['user_id'];
    $name = mysqli_real_escape_string($conn, $_POST['cake_name']);
    $price = intval($_POST['price']);
    $qty = intval($_POST['quantity']);
    $total = $price * $qty;

    $conn->query("INSERT INTO cart (user_id, cake_name, quantity, total_price)
                  VALUES ('$user_id', '$name', '$qty', '$total')");

    echo "<script>alert('$name added successfully!');</script>";
}

// Fetch chocolate items
$pcake_result = $conn->query("SELECT * FROM chocolate");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Chocolates | House Of Cakes</title>
    <link rel="stylesheet" href="choclates.css">  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>


<body>

<header>
    <div class="navbar">
        <h1><?php echo $title; ?></h1>
        <nav>
            <ul>
                <li><a href="index.php">HOME</a></li>
                <li><a href="about.php">ABOUT US</a></li>
                <li><a href="cakes.php">CAKES</a></li>
                <li><a class="active" href="chocolates.php">CHOCOLATES</a></li>
                <li><a href="contact.php">CONTACT</a></li>
                <li><a href="cart.php">🛒 CART</a></li>
            </ul>
        </nav>
    </div>
</header>

<h1>Chocolates</h1>

<div class="container">
    <?php while ($pcake = $pcake_result->fetch_assoc()) { ?>
    <div class="cake-box">
        <img src="image1/<?php echo $pcake['image']; ?>" class="cake-img">

        <b><?php echo $pcake['name']; ?></b><br>

        <p>500g Price: ₹<?php echo $pcake['price']; ?></p>

        <form method="POST" 
              onsubmit="return validateForm(<?php echo $pcake['id']; ?>)">
            <input type="hidden" name="cake_name" value="<?php echo $pcake['name']; ?>">
            <input type="hidden" name="price" value="<?php echo $pcake['price']; ?>">
            <input type="hidden" name="add_to_cart" value="1">

            <label>Quantity:</label>
            <select name="quantity" id="quantity_<?php echo $pcake['id']; ?>"
                onchange="updateTotal(<?php echo $pcake['id']; ?>, <?php echo $pcake['price']; ?>)">
                <?php for ($i = 1; $i <= 5; $i++) { ?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php } ?>
            </select><br><br>

            Total: ₹<span id="total_<?php echo $pcake['id']; ?>">
                <?php echo $pcake['price']; ?>
            </span><br><br>

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
    var q = document.getElementById("quantity_" + id).value;
    document.getElementById("total_" + id).innerHTML = price * q;
}
function validateForm(id) {
    var q = document.getElementById("quantity_" + id).value;
    if (q < 1) {
        alert("Please select quantity!");
        return false;
    }
    return true;
}
</script>
</body>
<footer>
  <div class="footer-container">
    <div class="footer-left">
      <h3>Contact Us</h3>
      <p><i class="fas fa-map-marker-alt"></i> 123, Bakery Street, New Delhi, India</p>
      <p><i class="fas fa-phone"></i> Call: +91 9876543210</p>
      <p><i class="fab fa-whatsapp"></i> WhatsApp: +91 9876543210</p>
      <p><i class="fas fa-clock"></i> Open 24/7</p>
    </div>
    <div class="footer-right">
      <h2>House Of Cakes</h2>
      <div class="social-icons">
        <a href="https://www.facebook.com" target="_blank"><i class="fab fa-facebook"></i></a>
        <a href="https://www.instagram.com/cruffinindia/#" target="_blank"><i class="fab fa-instagram"></i></a>
        <a href="https://www.youtube.com/@CruffinPremium" target="_blank"><i class="fab fa-youtube"></i></a>
      </div>
    </div>
  </div>
</footer>
</html>
