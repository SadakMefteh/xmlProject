<?php
// Configuration de l'URL d'ExistDB pour XQuery
$xqueryUrl = "http://localhost:8080/exist/rest/xquery"; // URL correcte pour exécuter XQuery
$username = "admin"; // Remplacer par votre nom d'utilisateur
$password = "admin"; // Remplacer par votre mot de passe

// Requête XQuery (modifiez 'collection-name' pour votre collection)
$xquery = "for \$doc in collection('categories') return \$doc";

// Initialisation de cURL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $xqueryUrl); // URL pour exécuter la requête XQuery
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Retourner la réponse
curl_setopt($ch, CURLOPT_POST, true); // Méthode POST
curl_setopt($ch, CURLOPT_POSTFIELDS, $xquery); // Requête XQuery dans le corps de la requête
curl_setopt($ch, CURLOPT_USERPWD, "$username:$password"); // Authentification
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC); // Authentification de base
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/xquery' // Type MIME pour la requête XQuery
));

// Exécution de la requête
$response = curl_exec($ch);

// Gestion des erreurs
if (curl_errno($ch)) {
    echo "Erreur : " . curl_error($ch);
} else {
    // Afficher la réponse
    header('Content-Type: application/xml'); // Afficher le résultat comme XML
    echo $response;
}

// Fermeture de cURL
curl_close($ch);
?>
