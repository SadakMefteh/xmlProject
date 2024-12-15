<?php
// Charger le fichier XML
$xml = simplexml_load_file('events.xml');

// Vérifier si le chargement a réussi
if ($xml === false) {
    die('Erreur lors du chargement du fichier XML');
}

// Afficher les événements dans une table HTML
echo "<table border='1'>";
echo "<tr>
        <th>ID</th>
        <th>Titre</th>
        <th>Description</th>
        <th>Date Début</th>
        <th>Date Fin</th>
        <th>Lieu</th>
        <th>Nombre Participants Max</th>
        <th>Catégorie</th>
      </tr>";

// Parcourir chaque événement
foreach ($xml->evenement as $evenement) {
    echo "<tr>";
    echo "<td>{$evenement->idEvenement}</td>";
    echo "<td>{$evenement->titre}</td>";
    echo "<td>{$evenement->description}</td>";
    echo "<td>{$evenement->dateDebut}</td>";
    echo "<td>{$evenement->dateFin}</td>";
    echo "<td>{$evenement->lieu}</td>";
    echo "<td>{$evenement->nombreParticipantsMax}</td>";
    echo "<td>{$evenement->nomCategorie}</td>";
    echo "</tr>";
}

echo "</table>";
?>
