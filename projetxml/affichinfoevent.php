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

// Afficher les résultats dans un tableau HTML
echo "<table border='1'>
      <tr>
          <th>ID</th>
          <th>Titre</th>
          <th>Description</th>
          <th>Date de Début</th>
          <th>Date de Fin</th>
          <th>Lieu</th>
          <th>Nombre de Participants Max</th>
          <th>Status</th>
          <th>Organisateur</th>
      </tr>";

// Boucler à travers les événements et afficher les informations dans le tableau
foreach ($xml->evenement as $evenement) {
    echo "<tr>
            <td>{$evenement->idEvenement}</td>
            <td>{$evenement->titre}</td>
            <td>{$evenement->description}</td>
            <td>{$evenement->dateDebut}</td>
            <td>{$evenement->dateFin}</td>
            <td>{$evenement->lieu}</td>
            <td>{$evenement->nombreParticipantsMax}</td>
            <td>{$evenement->status}</td>
            <td>{$evenement->organisateur->nomOrganisateur} <br> {$evenement->organisateur->emailOrganisateur}</td>
          </tr>";
}

echo "</table>";
?>
