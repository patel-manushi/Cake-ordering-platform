<?php
$title = "House Of Cakes";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?> - Contact Us</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="script.js" defer></script> <!-- Linking JavaScript -->
</head>
<style>
    body {
    font-family: Arial, sans-serif;
    background-color: #f9f5eb; 
    margin: 0;
    padding: 0;
    text-align: center;
}
.container {
max-width: 600px;
margin: 50px auto;
background-color: #f8e8dc;
padding: 40px; /* Increased padding for height */
border-radius: 10px;
box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
min-height: 600px; /* Set a minimum height */

}
.container p {
margin-top: 10px;
margin-bottom: 15px; /* Adds space between email, phone, and address */
}


.contact-info p {
margin-bottom: 10px; /* Adds spacing between each line */
}

textarea {
height: 150px; /* Increase the height of the textarea */
}

input, textarea {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 5px;
}
button {
background-color: #ff6f61;
color: white;
padding: 10px 15px;
border: none;
border-radius: 5px;
cursor: pointer;
display: block;
margin-bottom: 20px; /* Adds space below the button */
}

button:hover {
background-color: #e65a50;
}
.success {
    color: green;
}

.error {
    color: red;
}
/* ✅ Tablet */@media(max-width:1024px){.navbar h1{font-size:32px}.navbar nav ul li a{font-size:18px}.container{width:90%;padding:25px}.footer-container{flex-direction:column;text-align:center}}
/* ✅ Mobile */@media(max-width:768px){.navbar h1{font-size:26px}.navbar nav ul li{display:block;margin:10px 0}.navbar nav ul li a{font-size:16px}.container{width:95%;padding:20px}.footer-container{flex-direction:column;gap:10px}.social-icons a{font-size:22px}}

</style>
<body>

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

<div class="container">
    <h2>Contact Us</h2>
    <p>Have a question or special request? Reach out to us!</p>

    <?php if (isset($success)) echo "<p class='success'>$success</p>"; ?>
    <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>

    <form action="https://api.web3forms.com/submit" method="post" id="contact-form">
        <input type="hidden" name="access_key" value="0d57e3ff-6cf3-4af6-90b0-5e75a6d79333">
        <input type="text" name="name" id="name" placeholder="Your Name">
        <input type="email" name="email" id="email" placeholder="Your Email">
        <textarea name="message" id="message" placeholder="Your Message"></textarea>
        <button type="submit">Send Message</button>
    </form>
   

    <div class="contact-info">
   
        <p><strong>Email:</strong>houseofcakes@gmail.com</p>
        <p><strong>Phone:</strong> +91 9876543210</p>
        <p><strong>Address:</strong> 123, Bakery Street, New Delhi, India</p>
    </div>
</div>
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
