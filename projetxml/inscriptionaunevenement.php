<?php
// Inclure la classe de connexion à eXist-db
require 'ExistDBConnection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données du formulaire
    $prenom = htmlspecialchars($_POST['prenom'], ENT_QUOTES, 'UTF-8');
    $nom = htmlspecialchars($_POST['nom'], ENT_QUOTES, 'UTF-8');
    $adresse = htmlspecialchars($_POST['adresse'], ENT_QUOTES, 'UTF-8');
    $mail = htmlspecialchars($_POST['mail'], ENT_QUOTES, 'UTF-8');
    $preference = htmlspecialchars($_POST['preference'], ENT_QUOTES, 'UTF-8');


    // Initialiser la connexion eXist-db
    $exist = new ExistDBConnection(
        'http://localhost:8080/exist/rest',
        'admin', // Nom d'utilisateur
        'admin' // Mot de passe
    );

    // Requête XQuery pour ajouter une catégorie
    $xquery = <<<XQUERY
        xquery version "3.1";
        let \$doc := doc("/db/participants/participants.xml")
        let \$newparticipant := 
            <participant>
                <nom>{$nom}</nom>
                <prenom>{$prenom}</prenom>
                <adresse>{$adresse}</adresse>
                <mail>{$mail}</mail>
                <preference>{$preference}</preference>
            </participant>
        return update insert \$newparticipant into \$doc/participants
    XQUERY;

    // Exécuter la requête
    $result = $exist->executeQuery($xquery);

    if (strpos($result, '<exist:result') !== false) {
        echo "participant ajoutée avec succès.";
    } else {
        echo "Erreur lors de l'ajout : " . $result;
    }
}
?>