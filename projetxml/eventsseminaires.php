<?php
// Inclure la connexion à eXistDB
require 'ExistDBConnection.php'; 

// Créer une instance de la classe ExistDBConnection
$existClient = new ExistDBConnection('http://localhost:8080/exist/rest', 'admin', 'admin'); // Modifiez l'URL et les identifiants si nécessaire

// Chemin du fichier XML dans eXistDB
$xmlFilePath = '/db/evenement/evenement.xml';

// Créer la requête XQuery pour récupérer les événements
$xquery = "
let \$doc := doc('$xmlFilePath')
for \$evenement in \$doc//Evenement
where \$evenement/nomCategorie = 'seminaire'
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
  </evenement>";

// Exécuter la requête via eXistDB
$results = $existClient->executeQuery($xquery);

// Charger les résultats XML dans un objet SimpleXML
$xml = simplexml_load_string($results);

?>
<!DOCTYPE html>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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
    <link rel="stylesheet" href="css/seminaires.css" />
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&#038;display=swap" rel="stylesheet" />
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
                        <a class="active" href="events.php">EVENTS</a>
                    </li>
                    <li><a href="AboutUs.php">ABOUT US</a></li>
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
    
    <div class="landing ">
         
        
        <div class="background-slideshow"></div>
        <div class="overlay">
            
        </div>
        
        <div class="text">
          <div class="content">
              
          </div>
        </div>
        
        
      </div>
      
      <script src="https://unpkg.com/scrollreveal"></script>
      <script src="main.js"></script>
      
      </div>
      
    </div>
    <div class="categories" id="categories">
    <h2 class="main-title">Séminaires</h2>
    <div class="container">
    <?php

foreach ($xml->evenement as $evenement) {
    echo "
    <div class='box'>
        <img src='{$evenement->image}' alt='Image Séminaire' />
        <h3>{$evenement->titre}</h3>
        
        <div class='info'>
            <a href='details.php?idevent={$evenement->idEvenement}'>Détails</a>
            
        </div>
    </div>";
} // Fin du foreach

?>

        
    </div>
</div>

         
        </div>
      </div>
      </body>