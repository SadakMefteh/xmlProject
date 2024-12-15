<?php
// URL de base d'eXist-db
$existDbUrl = "http://localhost:8080/exist/rest/db";

// Identifiants eXist-db
$username = "admin";
$password = "admin";

// Fonction pour effectuer une requête GET
function getDocument($collection, $document) {
    global $existDbUrl, $username, $password;
    $url = $existDbUrl . "/$collection/$document";
    
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
    $response = curl_exec($ch);
    curl_close($ch);

    return $response;
}

// Exemple d'utilisation
$collection = "categories";
$document = "categories.xml";
$result = getDocument($collection, $document);

// Affichage du contenu XML
header("Content-Type: text/xml");
echo $result;
?>
