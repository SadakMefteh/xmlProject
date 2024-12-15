<?php
define("REST_PATH", "http://localhost:8080/exist/rest/db/categories");
$username = "admin"; // Nom d'utilisateur
$password = "admin"; // Mot de passe

function executeQuery($query) {
    global $username, $password;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, REST_PATH);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Content-Type: application/query+xml",
    ]);
    curl_setopt($ch, CURLOPT_USERPWD, "$username:$password"); // Authentification

    $result = curl_exec($ch);

    if (curl_errno($ch)) {
        die('Erreur cURL : ' . curl_error($ch));
    }

    curl_close($ch);
    return $result;
}

// Requête XQuery simple pour tester la connexion
$query = <<<XQUERY
xquery version "3.1";
doc("/db/categories/categories.xml")
XQUERY;

$result = executeQuery($query);

if ($result) {
    echo "Connexion réussie. Voici le résultat :";
    echo "<pre>" . htmlspecialchars($result) . "</pre>";
} else {
    echo "Échec de la connexion ou aucune donnée trouvée.";
}
?>
