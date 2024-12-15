<?php
// URL de base d'eXist-db
$existDbUrl = "http://localhost:8080/exist/rest/db";

// Identifiants eXist-db
$username = "admin";
$password = "admin";

// Fonction pour récupérer toutes les catégories
function getCategories($collection, $document) {
    global $existDbUrl, $username, $password;

    // Requête XQuery pour récupérer toutes les catégories
    $xquery = <<<XQUERY
xquery version "3.1";
let \$doc := doc('/db/$collection/$document')
for \$categorie in \$doc/categories/categorie
return <categorie>
    <idcat>{\$categorie/idcat}</idcat>
    <nom>{\$categorie/nom}</nom>
    <image>{\$categorie/image}</image>
</categorie>
XQUERY;

    // URL pour exécuter la requête XQuery
    $url = $existDbUrl . "/_query";

    // Requête HTTP avec cURL
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $xquery);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Content-Type: application/query+xml",
        "Accept: application/xml"
    ));

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    // Si la requête a réussi, retourner le résultat
    if ($httpCode === 200) {
        return simplexml_load_string($response);
    } else {
        return null;
    }
}

// Afficher les catégories
$collection = "categories"; // Nom de la collection dans eXist-db
$document = "categories.xml";  // Nom du fichier XML
$categories = getCategories($collection, $document);

if ($categories) {
    echo "<h1>Liste des catégories</h1>";
    echo "<table border='1' cellpadding='10' cellspacing='0'>";
    echo "<thead><tr><th>ID</th><th>Nom</th><th>Image</th></tr></thead>";
    echo "<tbody>";
    
    // Parcourir et afficher chaque catégorie dans le tableau
    foreach ($categories->categorie as $categorie) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($categorie->idcat) . "</td>";
        echo "<td>" . htmlspecialchars($categorie->nom) . "</td>";
        echo "<td><img src='" . htmlspecialchars($categorie->image) . "' alt='Image de la catégorie' width='100'></td>";
        echo "</tr>";
    }

    echo "</tbody>";
    echo "</table>";
} else {
    echo "Aucune catégorie trouvée ou erreur de récupération.";
}
?>
