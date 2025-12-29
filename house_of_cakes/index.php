<?php
// Set the page title for dynamic usage in header
$title = "House Of Cakes";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Basic page settings -->
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Display title from PHP variable -->
  <title><?php echo $title; ?></title>

  <!-- External CSS file for styling -->
  <link rel="stylesheet" href="style.css">

  <!-- External JS file for cart (if used on this page) -->
  <script src="cart.js"></script>

  <!-- Font Awesome for icons -->
  <link rel="stylesheet"
   href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body>
  <!-- Header + Navigation Menu -->
  <header>
    <div class="navbar">
      <h1><?php echo $title; ?></h1>
      <nav>
        <ul>
          <!-- Navigation links -->
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

  <main>

    <!-- Hero Section - Top Banner -->
    <section class="hero">
      <div>
        <div class="cake-icon">🍰</div>
        <h1>Welcome to the House Of Cakes</h1>
        <p class="tagline">Unwrap Happiness, One Slice at a Time</p>
        <p class="intro-text">
          Dive into a world of delicious indulgence where every cake tells a story and every flavor sparks joy. We bake with love, creativity, and a touch of magic.
        </p>
        <a href="cakes.php" class="cta-button">Start Your Sweet Journey</a>
      </div>
    </section>

    <!-- Featured Cakes Section -->
    <section class="featured-cakes">
      <h2>Featured Cakes</h2>
      <div class="cakes-container">
        <!-- Featured cake card -->
        <div class="cake-item">
          <img src="image1/cf.jpeg" alt="Cake 1">
          <h3>Chocolate Fudge Cake</h3>
          <p>Rich, decadent, and irresistible</p>
        </div>
        <div class="cake-item">
          <img src="image1/vc.jpg" alt="Cake 2">
          <h3>Vanilla Bean Delight</h3>
          <p>Light, fluffy, and perfectly sweet</p>
        </div>
        <div class="cake-item">
          <img src="image1/rv.jpeg" alt="Cake 3">
          <h3>Red Velvet Fantasy</h3>
          <p>Bold, beautiful, and unforgettable</p>
        </div>
      </div>
    </section>

    <!-- Testimonials / Customer Feedback -->
    <section class="testimonials">
      <h2>What Our Customers Say</h2>
      <div class="testimonial-container">
        <div class="testimonial-item">
          <p>"The best cake I’ve ever tasted. Perfect for my wedding!"</p>
          <p class="customer-name">Sarah K.</p>
        </div>
        <div class="testimonial-item">
          <p>"Delicious and stunning! Made my birthday unforgettable!"</p>
          <p class="customer-name">John D.</p>
        </div>
        <div class="testimonial-item">
          <p>"Every cake from House of Cakes is a masterpiece! Highly recommend!"</p>
          <p class="customer-name">Emily T.</p>
        </div>
      </div>
    </section>

    <!-- Why Choose Us Section -->
    <section class="why-us-section">
      <div>
        <div class="icon">🎂</div>
        <h2>Why Choose House of Cakes?</h2>
        <p class="tagline">Crafted with Love, Served with Delight</p>
        <p class="intro-text">
          From handpicked ingredients to artistic designs, every cake we create is a labor of love.
        </p>
        <a href="about.php" class="cta-button">Learn More About Us</a>
      </div>
    </section>

    <!-- Flavor Trail - Horizontal scroll -->
    <section class="flavor-trail">
      <h2>Explore Our Flavors</h2>
      <div class="trail-scroll">
        <div class="flavor">Chocolate 🍫</div>
        <div class="flavor">Strawberry 🍓</div>
        <div class="flavor">Blueberry 🫐</div>
        <div class="flavor">Pineapple 🍍</div>
        <div class="flavor">Mango 🥭</div>
      </div>
    </section>

    <!-- Fun Facts section -->
    <section class="sweet-facts">
      <h2>Sweet Bites of Knowledge 🧁</h2>
      <div class="fact-scroll">
        <div class="fact">🍓 Our strawberry glaze is made fresh every morning!</div>
        <div class="fact">🍰 Over 200 unique cake flavors experimented since 2018!</div>
        <div class="fact">🎉 Delivered cakes for more than 10,000 celebrations!</div>
        <div class="fact">👨‍🍳 Our bakers are certified culinary artists.</div>
        <div class="fact">💡 We design personalized cakes based on your story!</div>
      </div>
    </section>

    <!-- Cake Personality Quiz -->
    <section class="cake-quiz">
      <h2>🧁 Which Cake Are You?</h2>
      <p>Take this fun little quiz and discover your cake spirit!</p>

      <div class="quiz">
        <!-- Quiz options -->
        <label>Pick your ideal weekend vibe:</label><br>
        <select id="weekend">
          <option value="relax">Relaxing at home with a book</option>
          <option value="party">Partying with friends</option>
          <option value="explore">Exploring new places</option>
        </select><br><br>

        <label>What’s your go-to mood?</label><br>
        <select id="mood">
          <option value="sweet">Sweet & caring</option>
          <option value="bold">Bold & energetic</option>
          <option value="calm">Chill & peaceful</option>
        </select><br><br>

        <button onclick="revealCake()">Reveal My Cake</button>
        <p id="cakeResultQuiz"></p>
      </div>
    </section>

  </main>
</body>

<!-- Footer section -->
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

      <!-- Social Media Icons -->
      <div class="social-icons">
        <a href="https://www.facebook.com" target="_blank"><i class="fab fa-facebook"></i></a>
        <a href="https://www.instagram.com/cruffinindia/#" target="_blank"><i class="fab fa-instagram"></i></a>
        <a href="https://www.youtube.com/@CruffinPremium" target="_blank"><i class="fab fa-youtube"></i></a>
      </div>
    </div>
  </div>
</footer>

<!-- Quiz calculation script -->
<script>
  function revealCake() {
    const weekend = document.getElementById("weekend").value;
    const mood = document.getElementById("mood").value;

    let result = "";

    if (weekend === "relax" && mood === "sweet") {
      result = "You’re a Classic Vanilla Bean! 🍨 Calm, sweet, and timeless.";
    } else if (weekend === "party" && mood === "bold") {
      result = "You’re a Choco Lava Bomb! 🍫 Full of energy and bursting with flavor.";
    } else if (weekend === "explore" && mood === "calm") {
      result = "You’re a Matcha Mousse! 🍵 Unique, chill, and totally zen.";
    } else {
      result = "You’re a Rainbow Confetti Cake! 🌈 Full of surprises and joy!";
    }

    document.getElementById("cakeResultQuiz").innerText = result;
  }
</script>

</html>
