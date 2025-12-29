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

    $conn->query("INSERT INTO cart (user_id, cake_name, quantity, total_price) VALUES ('$user_id', '$name', $qty, $total)");

    echo "<script>alert('Successfully added $name to your cart!');</script>";
}

$cake_result = $conn->query("SELECT * FROM cakes");
$category_result = $conn->query("SELECT * FROM cake_categories");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cake Shop</title>
    <link rel="stylesheet" href="cakes.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<header>
    <div class="navbar">
        <h1><?php echo $title; ?></h1>
        <nav>
            <ul>
                <li><a href="index.php">HOME</a></li>
                <li><a href="about.php">ABOUT US</a></li>
                <li><a href="cakes.php">CAKES</a></li>
                <li><a href="choclates.php">CHOCLATES</a></li>
                <li><a href="contact.php">CONTACT US</a></li>
                <li><a href="cart.php">🛒CART</a></li>
            </ul>
        </nav>
    </div>
</header>

<body>
<h2 style="text-align: center; color: #7f5a3e;">Cake Categories</h2>

<div class="categories">
    <?php while ($category = $category_result->fetch_assoc()) { ?>
        <div class="category-box">
            <a href="<?php echo htmlspecialchars($category['link']); ?>">
                <img src="image1/<?php echo htmlspecialchars($category['image_url']); ?>" 
                     class="category-img" 
                     alt="<?php echo htmlspecialchars($category['name']); ?>">
                <div class="category-name"><?php echo htmlspecialchars($category['name']); ?></div>
            </a>
        </div>
    <?php } ?>
</div>

<div class="container">
    <?php while ($cake = $cake_result->fetch_assoc()) { ?>
        <div class="cake-box">
            <img src="image1/<?php echo $cake['image']; ?>" class="cake-img"><br>
            <b><?php echo $cake['name']; ?></b><br>
            1 Kg Price: ₹<?php echo $cake['price']; ?><br>
            <form method="POST" onsubmit="return validateForm(<?php echo $cake['id']; ?>)">
                <input type="hidden" name="cake_name" value="<?php echo $cake['name']; ?>">
                <input type="hidden" name="price" value="<?php echo $cake['price']; ?>">
                <input type="hidden" name="add_to_cart" value="1">
                Quantity:
                <select name="quantity" id="quantity_<?php echo $cake['id']; ?>" 
                        onchange="updateTotal(<?php echo $cake['id']; ?>, <?php echo $cake['price']; ?>)">
                    <?php for ($i = 1; $i <= 5; $i++) echo "<option value='$i'>$i</option>"; ?>
                </select><br>
                Total: ₹<span id="total_<?php echo $cake['id']; ?>"><?php echo $cake['price']; ?></span><br><br>
                <button type="submit">Add to Cart</button>
            </form>
        </div>
    <?php } ?>
</div>

<div class="cart-box">
    <a href="login.php">🛒 View Cart</a>
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
