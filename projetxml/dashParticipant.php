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
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Participant</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="dashParticipant.css">
    
</head>
<body>
    <div class="container my-5">
        <!-- Barre supérieure -->
        <div class="d-flex justify-content-between align-items-center py-3">
            <div class="d-flex align-items-center">
                <span class="text-uppercase" style="font-size: 1.5rem; font-weight: bold; color: #4a4a4a;">BIENVENUE</span>
                <span class="text-uppercase" style="font-size: 1.5rem; font-weight: bold; color: #3b5998; margin-left: 5px;">PARTICIPANT !</span>
            </div>
            <a href="homePage.html" class="btn btn-danger ms-3" style="padding: 10px 20px; font-size: 0.9rem; font-weight: bold;">
                <i class="fas fa-sign-out-alt"></i> Déconnexion
            </a>
        </div>

        <!-- Section Mes Événements -->
        <section id="mes-events" class="mt-5">
            <h2 class="text-uppercase" style="font-size: 1.5rem; font-weight: bold; color: #3b5998;">Mes Derniers Événements</h2>
            <div class="row">
                <!-- Événement 1 -->
                <div class="col-md-6">
                    <div class="event-card">
                        <img src="https://via.placeholder.com/400x200" alt="Event Image">
                        <div class="event-card-body">
                            <h5>Conférence Tech 2024</h5>
                            <p><strong>Date Début :</strong> 15 janvier 2024</p>
                            <p><strong>Date Fin :</strong> 17 janvier 2024</p>
                            <p><strong>Lieu :</strong> Paris, France</p>
                        </div>
                        <div class="overlay">
                            <h5>Évaluer nos ressources</h5>
                            <p>Locaux :</p>
                            <div class="ratings" id="rating-local-1">
                                <button class="rating-btn" data-value="1">1</button>
                                <button class="rating-btn" data-value="2">2</button>
                                <button class="rating-btn" data-value="3">3</button>
                                <button class="rating-btn" data-value="4">4</button>
                                <button class="rating-btn" data-value="5">5</button>
                            </div>
                            <p class="mt-3">Matériel :</p>
                            <div class="ratings" id="rating-material-1">
                                <button class="rating-btn" data-value="1">1</button>
                                <button class="rating-btn" data-value="2">2</button>
                                <button class="rating-btn" data-value="3">3</button>
                                <button class="rating-btn" data-value="4">4</button>
                                <button class="rating-btn" data-value="5">5</button>
                            </div>
                            <p class="mt-3">Personnel :</p>
                            <div class="ratings" id="rating-personnel-1">
                                <button class="rating-btn" data-value="1">1</button>
                                <button class="rating-btn" data-value="2">2</button>
                                <button class="rating-btn" data-value="3">3</button>
                                <button class="rating-btn" data-value="4">4</button>
                                <button class="rating-btn" data-value="5">5</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>

    <script>
        // Fonction pour gérer la sélection de l'évaluation
        document.querySelectorAll('.rating-btn').forEach(button => {
            button.addEventListener('click', function () {
                // Récupérer l'élément parent du bouton cliqué (le conteneur de l'évaluation)
                const ratingContainer = this.closest('.ratings');
                
                // Retirer la classe 'selected' de tous les boutons du groupe de l'évaluation
                ratingContainer.querySelectorAll('.rating-btn').forEach(btn => {
                    btn.classList.remove('selected');
                });
                
                // Ajouter la classe 'selected' au bouton cliqué
                this.classList.add('selected');

                // Afficher la valeur sélectionnée dans la console (ou envoyer cette valeur à un serveur)
                const ratingValue = this.getAttribute('data-value');
                console.log(`Évaluation sélectionnée : ${ratingValue}`);
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
