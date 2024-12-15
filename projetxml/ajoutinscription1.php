<?php
// Récupération des paramètres en sécurisant les entrées
$eventId = htmlspecialchars($_REQUEST['idevent']);
$login = htmlspecialchars($_REQUEST['login']);

// Validation des entrées
if (!ctype_digit($eventId) || empty($login)) {
    die('Invalid input parameters.');
}

// Inclusion de la classe de connexion à eXistDB
require 'ExistDBConnection.php';

// Initialisation de la connexion à eXistDB
$exist = new ExistDBConnection(
    'http://localhost:8080/exist/rest',
    'admin', // Nom d'utilisateur
    'admin'  // Mot de passe
);

$xmlFilePathUtilisateurs = '/db/utilisateurs/utilisateur.xml';
$xmlFilePathEvenements = '/db/evenement/evenement.xml';

// Requête XQuery pour récupérer les informations de l'utilisateur
$xqueryUtilisateur = <<<XQUERY
let \$doc := doc('$xmlFilePathUtilisateurs')
for \$utilisateur in \$doc//utilisateur
where \$utilisateur/login = '$login'
return 
<participant>
    <nom>{\$utilisateur/nom/text()}</nom>
    <prenom>{\$utilisateur/prenom/text()}</prenom>
    <adresse>{\$utilisateur/adresse/text()}</adresse>
    <preference>{\$utilisateur/preference/text()}</preference>
    <email>{\$utilisateur/email/text()}</email>
</participant>
XQUERY;

// Exécution de la requête pour récupérer les informations utilisateur
$results = $exist->executeQuery($xqueryUtilisateur);

if (!$results) {
    die("Erreur lors de la récupération des informations utilisateur.");
}

// Charger les résultats XML dans un objet SimpleXML
$xml = simplexml_load_string($results);
if (!$xml || empty($xml->participant)) {
    die("Utilisateur introuvable.");
}

// Extraire les données utilisateur
$participant = $xml->participant[0];
$nom = htmlspecialchars(trim($participant->nom));
$prenom = htmlspecialchars(trim($participant->prenom));
$adresse = htmlspecialchars(trim($participant->adresse));
$preference = htmlspecialchars(trim($participant->preference));
$email = htmlspecialchars(trim($participant->email));

// Requête XQuery pour ajouter un participant à l'événement
$xquery = <<<XQUERY
xquery version "3.1";
let \$doc := doc("$xmlFilePathEvenements")
let \$event := \$doc//Evenement[idEvenement="$eventId"]
return
    if (exists(\$event)) then (
        update insert 
        <participant>
            <nom>{$nom}</nom>
            <prenom>{$prenom}</prenom>
            <adresse>{$adresse}</adresse>
            <preference>{$preference}</preference>
            <login>{$email}</login>
        </participant>
        into \$event/participants,
        <status>Participant ajouté avec succès</status>
    ) else (
        <error>Événement introuvable</error>
    )
XQUERY;

// Exécution de la requête pour ajouter le participant
$result = $exist->executeQuery($xquery);

if (strpos($result, '<status>') !== false) {
    echo "Participant ajouté avec succès.";
    header("Location: participant.php?idevent=$eventId&login=$login");
    exit();

} else {
    echo "Erreur lors de l'ajout : " . htmlspecialchars($result);
}
?>
