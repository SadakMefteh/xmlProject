<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Steros | LABO</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/normalize.css" />
    <link rel="stylesheet" href="css/all.min.css" />
    <link rel="stylesheet" href="css/contactus.css" />
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" charset="utf-8"></script>
</head>
<body>
    <!-- Start Header -->
    <header>
        <div class="container">
            <a href="visiteur.php" class="logo">
                <img decoding="async" src="images/ORGANISINI.png" alt="Logo" />
            </a>
            <nav>
                <div class="menu-btn"></div>
                <ul class="menu">
                    <div class="close-btn"></div>
                    <li class="menu-item"><a  href="visiteur.php">HOME</a></li>
                    <li class="menu-item">
                        <a href="events.php">EVENTS</a>
                    </li>
                    <li><a href="AboutUs.php">ABOUT US</a></li>
                    <li><a href="#">SIGN IN</a></li>
                    <li><a href="#">LOGIN</a></li>
                    <li><a class="active" href="contactus.php">CONTACT US</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <!-- End Header -->
    <div class="contact">
      <div class="container">
        <div class="main-heading">
          <h2>Contact Us</h2>
          <p>
          Your opinion is a part of our success
          </p>
        </div>
        <div class="content">
          <form action="">
            <input class="main-input" type="text" name="name" placeholder="Your Name" />
            <input class="main-input" type="email" name="mail" placeholder="Your Email" />
            <textarea class="main-input" name="message" placeholder="Your Message"></textarea>
            <input type="submit" value="Send Message" />
          </form>
          <div class="info">
            <h4>Call Us</h4>
            <span class="phone">+216 56.644.929</span>
            <span class="phone">+216 23.456.789</span>
            <h4>Our Address</h4>
            <address>Organisini<br />Sfax, City center<br />3327<br />TUNISIA</address>
          </div>
        </div>
      </div>
    </div>