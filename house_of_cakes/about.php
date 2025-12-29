<?php
  $title = "House Of Cakes";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="about.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>

<!-- Header -->
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

<section class="our-story">
    <div class="container">
      <div class="image">
        <img src="image1/cup1.png" alt="Cake and Cupcake">
      </div>
      <div class="text">
        <h2>Our Story</h2>
        <p>Our journey began with one humble shop in the heart of Mumbai. With a passion for baking and spreading smiles, House of Cakes has grown into a beloved name for delightful cakes, pastries, and more.</p>
        <p>Founded by cake enthusiasts, we’ve spent years perfecting recipes, building relationships, and bringing sweetness to countless celebrations. Today, our family-owned business is known for quality, creativity, and warmth.</p>
      </div>
    </div>
</section>

<section class="mission-vision">
  <h2>Our Mission, Values & Vision</h2>
  <div class="mvv-grid">
    <div class="box">
      <div class="icon">🎯</div>
      <h3>Mission</h3>
      <p>To spread joy through our freshly baked cakes and treats, made with love and the finest ingredients.</p>
    </div>
    <div class="box">
      <div class="icon">👁️</div>
      <h3>Vision</h3>
      <p>To be the go-to cake shop across India, known for quality, innovation, and heartfelt service.</p>
    </div>
    <div class="box">
      <div class="icon">💖</div>
      <h3>Values</h3>
      <ul>
        <li>Quality Ingredients</li>
        <li>Customer Delight</li>
        <li>Creativity & Innovation</li>
        <li>Community Involvement</li>
        <li>Passion for Baking</li>
      </ul>
    </div>
  </div>
</section>

<section class="our-story">
    <div class="container">
      <div class="image">
        <img src="image1/s1.png" alt="Cake and Cupcake">
      </div>
      <div class="text">
        <h2>Our Secret</h2>
        <p>Monginis only uses the finest ingredients in its products, ensuring the goods that we send out into the market are of the utmost quality. Monginis believes in order to give the Real taste of any product, real ingredients should be used & not cheaper substitutes. Our production includes a highly-customized, automated system but does not forego the importance of the human touch.</p>
      </div>
    </div>
</section>

<section class="promises">
    <h2 class="our-promises-title">Our Promises</h2>
    <div class="promise-container">
        <div class="promise">
            <i class="fas fa-seedling"></i>
            <h3>Fresh Ingredients</h3>
            <p>Only the best and freshest ingredients go into our cakes.</p>
        </div>
        <div class="promise">
            <i class="fas fa-birthday-cake"></i>
            <h3>Handmade with Love</h3>
            <p>Each cake is handcrafted with passion and care.</p>
        </div>
        <div class="promise">
            <i class="fas fa-shipping-fast"></i>
            <h3>Fast Delivery</h3>
            <p>On-time doorstep delivery for your special moments.</p>
        </div>
        <div class="promise">
            <i class="fas fa-smile"></i>
            <h3>100% Satisfaction</h3>
            <p>We promise to bring a smile with every bite.</p>
        </div>
    </div>
</section>

<!-- Footer -->
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

</body>
</html>
