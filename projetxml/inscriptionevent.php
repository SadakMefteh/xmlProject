<?php
$eventId = htmlspecialchars($_REQUEST['idevent'] ?? '');
$login = htmlspecialchars($_REQUEST['login'] ?? '');

// Inclusion de la classe de connexion à eXistDB
require 'ExistDBConnection.php';

// Initialisation de la connexion à eXistDB
$exist = new ExistDBConnection(
    'http://localhost:8080/exist/rest',
    'admin', // Nom d'utilisateur
    'admin'  // Mot de passe
);

$xmlFilePathEvenements = '/db/evenement/evenement.xml';

// Requête XQuery pour récupérer les informations de l'événement
$xqueryEvenement = <<<XQUERY
let \$doc := doc('$xmlFilePathEvenements')
for \$evenement in \$doc//Evenement
where \$evenement/idEvenement = '$eventId'
return 
<evenement>
    <cotisation>{\$evenement/cotisation/text()}</cotisation>
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
XQUERY;

// Exécution de la requête pour récupérer les informations de l'événement
$results = $exist->executeQuery($xqueryEvenement);
$xml = @simplexml_load_string($results);

// Récupération de la cotisation ou définition d'une valeur par défaut
$cotisation = "Non spécifié";
if ($xml && count($xml->evenement) > 0) {
    $evenement = $xml->evenement[0];
    $cotisation = (string)$evenement->cotisation;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription à un Événement</title>
    <!-- Lien vers Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&family=Dancing+Script:wght@600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="inscription.css">
</head>
<body>
    <div class="container-main">
        <!-- Image fixe à gauche -->
        <div class="left-section">
            <video src="images/rightsection.gif"></video>
        </div>

        <div class="right-section">
                <h2>Paiement</h2>
                <p class="label-montant">Montant à payer : <span id="montant"><?= htmlspecialchars($cotisation) ?> DT</span></p>
                <form action="ajoutinscription.php" id="form-paiement">
                    <div class="mb-3">
                        <label for="num-carte" class="form-label">Numéro de carte</label>
                        <input type="text" class="form-control" id="num-carte" pattern="\d{16}" maxlength="16" placeholder="1234 5678 9012 3456" required>
                    </div>
                    <div class="mb-3">
                        <label for="cvc" class="form-label">CVC</label>
                        <input type="password" class="form-control" id="cvc" pattern="\d{3}" maxlength="3" placeholder="123" required>
                    </div>
                    <div class="mb-3">
                        <label for="date-expiration" class="form-label">Date d'expiration</label>
                        <input type="month" class="form-control" id="date-expiration" required>
                    </div>
                    <div class="d-flex justify-content-between">
                    <a href='ajoutinscription1.php?idevent=<?= urlencode($eventId) ?>&login=<?= urlencode($login) ?>'>
    <button type='button' class='btn btn-primary'>Valider</button>
</a>

                        <button type="button" class="btn btn-secondary" onclick="showStep('step-connexion')">Annuler</button>
                    </div>
                </form>
            
        </div>
    </div>

   
</body>
</html>
