<?php
// Inclure la connexion à eXistDB
require 'ExistDBConnection.php'; 

// Créer une instance de la classe ExistDBConnection
$existClient = new ExistDBConnection('http://localhost:8080/exist/rest', 'admin', 'admin'); // Modifiez l'URL et les identifiants si nécessaire

// Chemin du fichier XML dans eXistDB
$xmlFilePath = '/db/evenement/evenement.xml';
$xquery = "
let \$doc := doc('$xmlFilePath')
let \$today := current-date()
for \$evenement in \$doc//Evenement
let \$daysDifference := abs(xs:date(\$evenement/dateDebut/text()) - \$today)
order by \$daysDifference
return 
  <evenement>
    <idEvenement>{\$evenement/idEvenement/text()}</idEvenement>
    <titre>{\$evenement/titre/text()}</titre>
    <image>{\$evenement/image/text()}</image>
    <description>{\$evenement/description/text()}</description>
    <dateDebut>{\$evenement/dateDebut/text()}</dateDebut>
    <dateFin>{\$evenement/dateFin/text()}</dateFin>
    <lieu>{\$evenement/lieu/text()}</lieu>
    <nombreParticipantsMax>{\$evenement/nombreParticipantsMax/text()}</nombreParticipantsMax>
    <status>{\$evenement/status/text()}</status>
    <organisateur>
      <nomOrganisateur>{\$evenement/organisateur/nomOrganisateur/text()}</nomOrganisateur>
      <emailOrganisateur>{\$evenement/organisateur/emailOrganisateur/text()}</emailOrganisateur>
    </organisateur>
  </evenement> 
return if position() = 1 then \$evenement else ()
";

?>
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
    <link rel="stylesheet" href="css/visiteur.css" />
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&#038;display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" charset="utf-8"></script>
    
  </head>
  <body>
    <!-- Start Header -->
    <header>
      <div class="container  ">
        <a href="#" class="logo">
          <img decoding="async" src="images/ORGANISINI.png" alt="Logo" />
        </a>
        <nav>
          <div class="menu-btn"></div>
          
          <ul class="menu">
            <div class="close-btn">
              
            </div>
            <li class="menu-item"><a class="active" href="visiteur.php">HOME</a></li>
            <li class="menu-item"><a  href="events.php">EVENTS</a></li>
            <li><a href="AboutUs.php">ABOUT US</a></li>
            <li><a href="#">SIGN IN</a></li>
            <li><a href="loginvisiteur.php">LOGIN</a></li>
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
    
    <div class="landing ">
      
      <div class="background-slideshow"></div>
  


    
    <style>
        .background-slideshow::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-image: url(images/restaurant-hall-with-tables-decorated-with-tall-vases-with-roses.jpg); /* First image */
    background-size: cover;
    background-position: center;
    animation: slideshow 12s infinite; /* Adjust duration as needed */
  }
  
  
      </style>


?>
      
      <div class="overlay"></div>
      <div class="text">
        <div class="content">
            <div class="timer">
                <div class="boxtime">
                    <div class="number" id="days">00</div>
                    <div class="label">DAYS</div>
                  </div>
                  <div class="boxtime">
                    <div class="number" id="hours">00</div>
                    <div class="label">HOURS</div>
                  </div>
                  <div class="boxtime">
                    <div class="number" id="minutes">00</div>
                    <div class="label">MINUTES</div>
                  </div>
                  <div class="boxtime">
                    <div class="number" id="seconds">00</div>
                    <div class="label">SECONDS</div>
                  </div>
              </div>
        </div>
      </div>
      <div class="up">
        <h2>UPCOMING SOON</h2>
      </div>
      <div class="up">
        
        <h1>
          wedding<span class="h1__span-1">  EVENT </span>
        </h1>
      </div>
      <div class="up">
        <h3>31 Nouvembre 2024</h3>
      </div>
      <div class="up">
        <button class="button">DETAILS</button>
      </div>
    </div>
    
    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="main.js"></script>
    <script>
        // Date de fin de l'offre
        const countDownDate = new Date("2024-11-31T23:59:59").getTime();
      
        // Mettre à jour le compte à rebours chaque seconde
        const x = setInterval(function() {
          const now = new Date().getTime();
          const distance = countDownDate - now;
      
          // Calculer le temps restant
          const days = Math.floor(distance / (1000 * 60 * 60 * 24));
          const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
          const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
          const seconds = Math.floor((distance % (1000 * 60)) / 1000);
      
          // Afficher le résultat dans les éléments correspondants
          document.getElementById("days").innerHTML = days;
          document.getElementById("hours").innerHTML = hours;
          document.getElementById("minutes").innerHTML = minutes;
          document.getElementById("seconds").innerHTML = seconds;
      
          // Si le compte à rebours est terminé, afficher un message
          if (distance < 0) {
            clearInterval(x);
            document.getElementById("countdown").innerHTML = "L'evennement est terminée !";
          }
        }, 1000);
      </script>

<div class="categories" id="categories">
    <h2 class="main-title">Categories</h2>
    <div class="container">
    <div class="box">
        <img src="images/séminaire-à-Paris.jpg" alt="">
        <h3>Séminaire</h3>
        <div class="info">
          <a href="eventsseminaires.php">Events</a>
        </div>
      </div>
      <div class="box">
        <img src="images/organisation_voyage_recompense.jpg" alt="">
        <h3>Voyage de récompense</h3>
        <div class="info">
          <a href="recomponse.php">Events</a>
        </div>
      </div>
      <div class="box">
        <img src="images/evenement_d_entreprise_avec_des_participants_en_interieur_a7cc82c307.png" alt="">
        <h3>Soirée d'entreprise</h3>
        <div class="info">
          <a href="entreprise.php">Events</a>
        </div>
      </div>
      <div class="box">
        <img src="images/1 - Convention Village implid © Ingrid Moya.jpg" alt="">
        <h3>Convention</h3>
        <div class="info">
          <a href="convention.php">Events</a>
        </div>
      </div>
      <div class="box">
        <img src="images/Evenement-Mercedes-scaled.jpg" alt="">
        <h3>Lancements de produit </h3>
        <div class="info">
          <a href="produit.php">Events</a>
        </div>
      </div>
      <div class="box">
        <img src="images/8e78883a24da719e3e8a9080e99b898d.jpg" alt="">
        <h3>Autre</h3>
        <div class="info">
          <a href="autre.php">Events</a>
        </div>
      </div>
    </div>
  </div>

      <!-- Start Testimonials -->
      <div class="testimonials" id="testimonials">
        <h2 class="main-title">Testimonials</h2>
        <div class="container">
          <div class="box">
            <img decoding="async" src="images/medalii.png" alt="" />
            <h3>Mohamed Ali Gouiaa</h3>
            <span class="title">Participant</span>
            <div class="rate">
              <i class="filled fas fa-star"></i>
              <i class="filled fas fa-star"></i>
              <i class="filled fas fa-star"></i>
              <i class="filled fas fa-star"></i>
              <i class="far fa-star"></i>
            </div>
            <p>
                Ambiance incroyable, programmation variée, et une équipe d'accueil très sympa. Le site était bien aménagé avec des stands de nourriture exceptionnels. Une expérience mémorable !
            </p>
          </div>
          <div class="box">
            <img decoding="async" src="images/sadak.jpg" alt="" />
            <h3>Sadak Mefeteh</h3>
            <span class="title">Participant</span>
            <div class="rate">
              <i class="filled fas fa-star"></i>
              <i class="filled fas fa-star"></i>
              <i class="filled fas fa-star"></i>
              <i class="filled fas fa-star"></i>
              <i class="far fa-star"></i>
            </div>
            <p>
                Une organisation impeccable et des conférenciers de très haut niveau. Les sujets abordés étaient très pertinents pour mon domaine. J'ai hâte de participer à la prochaine édition !
            </p>
          </div>
          <div class="box">
            <img decoding="async" src="images/anis.png" alt="" />
            <h3>Anis Jedidi</h3>
            <span class="title">Organisateur</span>
            <div class="rate">
              <i class="filled fas fa-star"></i>
              <i class="filled fas fa-star"></i>
              <i class="filled fas fa-star"></i>
              <i class="filled fas fa-star"></i>
              <i class="far fa-star"></i>
            </div>
            <p>
                La plateforme m'a permis de gérer mon événement de manière très efficace. J'ai pu créer une page dédiée et suivre les inscriptions en temps réel . Un outil indispensable pour tout organisateur d'événements.
            </p>
          </div>
          <div class="box">
            <img decoding="async" src="images/faiza.jpg" alt="" />
            <h3>Faiza Ghozzi</h3>
            <span class="title">Organisatrice</span>
            <div class="rate">
              <i class="filled fas fa-star"></i>
              <i class="filled fas fa-star"></i>
              <i class="filled fas fa-star"></i>
              <i class="filled fas fa-star"></i>
              <i class="filled fas fa-star"></i>
            </div>
            <p>
                La gestion des paiements en ligne est fluide et sécurisée. J'ai pu recevoir les frais d'inscription directement sur mon compte bancaire, et le tableau de bord m'a permis de suivre facilement les transactions. Un gain de temps considérable !
            </p>
          </div>
          <div class="box">
            <img decoding="async" src="images/walid.jpg" alt="" />
            <h3>Walid Mahdi</h3>
            <span class="title">Organisateur</span>
            <div class="rate">
              <i class="filled fas fa-star"></i>
              <i class="filled fas fa-star"></i>
              <i class="filled fas fa-star"></i>
              <i class="far fa-star"></i>
              <i class="far fa-star"></i>
            </div>
            <p>
                L'interface est intuitive, et la création d'un événement est rapide. Cependant, j'aimerais avoir plus d'options de personnalisation pour les pages d'événements, comme ajouter des vidéos ou des intégrations tierces. Cela rendrait les pages encore plus attrayantes.
            </p>
          </div>
          <div class="box">
            <img decoding="async" src="images/ali.jpg" alt="" />
            <h3>Ali Wali</h3>
            <span class="title">Organisateur</span>
            <div class="rate">
              <i class="filled fas fa-star"></i>
              <i class="filled fas fa-star"></i>
              <i class="filled fas fa-star"></i>
              <i class="far fa-star"></i>
              <i class="far fa-star"></i>
            </div>
            <p>
                Les rapports détaillés sur la participation m'ont aidé à mieux comprendre mon audience. J'ai pu analyser quelles périodes étaient les plus efficaces pour les inscriptions et ajuster ma stratégie pour les prochains événements.
            </p>
          </div>
        </div>
      </div>
      <!-- End Testimonials -->
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
       <!-- Start Footer -->
    <div class="footer">
        <div class="container">
          <div class="box">
            <img src="images/ORGANISINI.png" alt="">
            <ul class="social">
              <li>
                <a href="#" class="facebook">
                  <i class="fab fa-facebook-f"></i>
                </a>
              </li>
              <li>
                <a href="#" class="twitter">
                  <i class="fab fa-twitter"></i>
                </a>
              </li>
              <li>
                <a href="#" class="youtube">
                  <i class="fab fa-youtube"></i>
                </a>
              </li>
            </ul>
            <p class="text">
                Established in 2013, Organisini has quickly risen to prominence as a leader in the field of event management. Its journey began with a successful collaboration to organize a series of high-profile conferences, setting the foundation for its reputation as a trusted partner for delivering exceptional events across various industries.
            </p>
          </div>
          <div class="box">
            <ul class="links">
              <li><a href="events.php">EVENTS</a></li>
              <li><a href="AboutUs.php">ABOUT US</a></li>
              <li><a href="#">SIGNIN</a></li>
              <li><a href="#">LOGIN</a></li>
              <li><a href="contactus.php">CONTACT US</a></li>
            </ul>
          </div>
          <div class="box">
            <div class="line">
              <i class="fas fa-map-marker-alt fa-fw"></i>
              <div class="info">Tunisia, Sfax ,Tunis Road KM 6</div>
            </div>
            <div class="line">
                <i class="fa-regular fa-envelope"></i>
              <div class="info">info@organisini.com</div>
            </div>
            <div class="line">
              <i class="fas fa-phone-volume fa-fw"></i>
              <div class="info">
                <span>+21656644929</span>
                <span>+21625789415</span>
              </div>
            </div>
          </div>
          <div class="box footer-gallery">
            <img decoding="async" src="imgs/gallery-01.png" alt="" />
            <img decoding="async" src="imgs/gallery-02.png" alt="" />
            <img decoding="async" src="imgs/gallery-03.jpg" alt="" />
            <img decoding="async" src="imgs/gallery-04.png" alt="" />
            <img decoding="async" src="imgs/gallery-05.jpg" alt="" />
            <img decoding="async" src="imgs/gallery-06.png" alt="" />
          </div>
        </div>
        <p class="copyright">Made With &lt;3 By Organisini</p>
      </div>
      <!-- End Footer -->
    </body>
  </html>