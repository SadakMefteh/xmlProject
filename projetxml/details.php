<link href="dist/css/bootstrap.min.css" rel="stylesheet">
<?php
// Inclure la connexion à eXistDB
require 'ExistDBConnection.php'; 

// Créer une instance de la classe ExistDBConnection
$existClient = new ExistDBConnection('http://localhost:8080/exist/rest', 'admin', 'admin'); // Modifiez l'URL et les identifiants si nécessaire

// Chemin du fichier XML dans eXistDB
$xmlFilePath = '/db/evenement/evenement.xml';

// Sanitize the input
$eventId = htmlspecialchars($_REQUEST['idevent']);

// Créer la requête XQuery pour récupérer les événements
$xquery = "
let \$doc := doc('$xmlFilePath')
for \$evenement in \$doc//Evenement
where \$evenement/idEvenement = '$eventId'
return 
  <evenement>
    <idEvenement>{\$evenement/idEvenement/text()}</idEvenement>
    <cotisation>{\$evenement/cotisation/text()}</cotisation>
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
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Steros | LABO</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="css/normalize.css" />
    <link rel="stylesheet" href="css/all.min.css" />
    <link rel="stylesheet" href="css/details.css" />
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
    <!-- End Header -->

    <?php
    foreach ($xml->evenement as $evenement) {
        echo "
        <div class='event-details'>
            <div class='container'>
                <img src='{$evenement->image}' alt='Image de l'événement' />
                <div class='info'>
                    <div class='time'>
                        <div class='unit'>
                            <span><div class='number' id='days'>00</div></span>
                            <span>Days</span>
                        </div>
                        <div class='unit'>
                            <span><div class='number' id='hours'>00</div></span>
                            <span>Hours</span>
                        </div>
                        <div class='unit'>
                            <span><div class='number' id='minutes'>00</div></span>
                            <span>Minutes</span>
                        </div>
                        <div class='unit'>
                            <span><div class='number' id='seconds'>00</div></span>
                            <span>Seconds</span>
                        </div>
                    </div>
                    <h2 class='title'>{$evenement->titre}</h2>
                    <p class='description'>
                        {$evenement->description} Du {$evenement->dateDebut} au {$evenement->dateFin} à {$evenement->lieu} organisé par {$evenement->organisateur->nomOrganisateur} ({$evenement->organisateur->emailOrganisateur})
                    </p>
                </div>
                <div class='subscribe'>
                    <p>Statut : {$evenement->status}</p>
                    <form >
                        <h2>{$evenement->cotisation} dt</h2>
                        
                        <a href='logininscri.php?idevent=$eventId'><button type='button' class='btn btn-primary'>Subscribe</button></a>
                    </form>
                </div>
            </div>
        </div>
        ";
    }
    ?>

    <script>
        // Date de début de l'événement
        const countDownDate = new Date("<?php echo $evenement->dateDebut; ?>").getTime();
      
        // Mettre à jour le compte à rebours chaque seconde
        const x = setInterval(function() {
          const now = new Date().getTime();
          const distance = countDownDate - now; // Temps écoulé depuis le début de l'événement
      
          // Calculer le temps écoulé
          const days = Math.floor(distance / (1000 * 60 * 60 * 24));
          const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
          const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
          const seconds = Math.floor((distance % (1000 * 60)) / 1000);
      
          // Afficher le résultat dans les éléments correspondants
          document.getElementById("days").innerHTML = days;
          document.getElementById("hours").innerHTML = hours;
          document.getElementById("minutes").innerHTML = minutes;
          document.getElementById("seconds").innerHTML = seconds;
      
          // Si l'événement est terminé, afficher un message
          if (distance < 0) {
            clearInterval(x);
            document.getElementById("countdown").innerHTML = "L'événement est terminé !";
          }
        }, 1000);
    </script>
</body>
</html>