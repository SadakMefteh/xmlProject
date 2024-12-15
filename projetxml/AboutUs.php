<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Steros | LABO</title>
    <!-- Render All Elements Normally -->
    <link rel="stylesheet" href="css/normalize.css" />
    <!-- Font Awesome Library -->
    <link rel="stylesheet" href="css/all.min.css" />
    <!-- Main CSS File -->
    <link rel="stylesheet" href="css/aboutus.css" />
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&#038;display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" charset="utf-8"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" >
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
    
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
                    <li><a class="active" href="AboutUs.php">ABOUT US</a></li>
                    <li><a href="#">SIGN IN</a></li>
                    <li><a href="#">LOGIN</a></li>
                    <li><a href="contactus.php">CONTACT US</a></li>
                </ul>
            </nav>
        </div>
    </header>
    
    <script type="text/JavaScript">
      window.addEventListener("scroll",function(){
        var header =document.querySelector("header");
        header.classList.toggle("sticky", window.scrollY > 0);
      });
    </script>
    <script type="text/JavaScript">
      $(document).ready(function(){
        $(".active").click(function(){
          $(this).next(".sub-menu").slideToggle();
        });
      });

      
      var menu = document.querySelector(".menu");
      var menuBtn = document.querySelector(".menu-btn");
      var closeBtn = document.querySelector(".close-btn");

      menuBtn.addEventListener("click", () => {
        menu.classList.add("active");
      });

      closeBtn.addEventListener("click", () => {
        menu.classList.remove("active");
      });

    </script>
    <!-- End Header -->
    <!-- Start Landing -->
    <div class="landing " >
      <div class="overlay"></div>
      <div class="text">
        <div class="content">
          <h2>ABOUT US </h2>
        <h1>
        why would<br /><span class="h1__span-1">you</span>
          <span class="h1__span-2">choose us</span>
        </h1>
        <p>
        we turn your ideas into unforgettable events. With a proven track record of successful projects and trusted partnerships, we deliver excellence, creativity, and attention to detail. Choose us for stress-free planning and exceptional results that make your event truly memorable.
        </p>
        </div>
      </div>
      <div class="header-img">
        <img src="images/aboutus-removebg-preview.png" alt="">
      </div>
    </div>
    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="main.js"></script>
    <!-- End Landing -->
     <!-- Start Stats -->
    <div class="stats" id="stats">
        <h2>Our Awesome Stats</h2>
        <div class="container">
          <div class="box">
            <i class="far fa-user fa-2x fa-fw"></i>
            <span class="number">72</span>
            <span class="text">organizers</span>
          </div>
          <div class="box">
            <i class="fa-solid fa-calendar-days" style="font-size:30px;"></i>
            <span class="number">100</span>
            <span class="text">Events</span>
          </div>
          <div class="box">
            <i class="fas fa-globe-asia fa-2x fa-fw "></i>
            <span class="number">4500</span>
            <span class="text">Participants</span>
          </div>
          <div class="box">
            <i class="fa-solid fa-briefcase" style="font-size:30px;"></i>
            <span class="number">200</span>
            <span class="text">Experts</span>
          </div>
        </div>
      </div>
      <!-- End Stats -->
      <div class="partners">

    
<h2 class="text-center font-weight-bold">Our Partners</h2>
<section class="customer-logos slider">
    <div class="slide"><img src="images/Adone-logotype.png" alt="logo"></div>
    <div class="slide"><img src="images/a0b5f511-69be-4ebf-a173-cdf40966ef44-w_780.png" alt="logo"></div>
    <div class="slide"><img src="images/Mars-inc.png" alt="logo"></div>
    <div class="slide"><img src="images/Nickel_RVB_FondBlanc_Couleur-eps.png" alt="logo"></div>
    <div class="slide"><img src="images/Sysco-logo-300x115.png" alt="logo"></div>
    <div class="slide"><img src="images/Payfit_logo_blue.png" alt="logo"></div>
    <div class="slide"><img src="images/Roland_Berger_Logo_2024.png" alt="logo"></div>
    <div class="slide"><img src="images/logo-lucca-RVB-1220x420-11.png" alt="logo"></div>
</section>
</div>
<p class="copy text-center font-weight-bold">All Rights Reserved &copy; ORGANISINI</p>


<script>

$(document).ready(function(){
$('.customer-logos').slick({
    slidesToShow: 6,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 1500,
    arrows: false,
    dots: false,
    pauseOnHover:false,
    responsive: [{
        breakpoint: 768,
        setting: {
            slidesToShow:4
        }
    }, {
        breakpoint: 520,
        setting: {
            slidesToShow: 3
        }
    }]
});
});

</script>
