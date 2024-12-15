<?php
// Inclure la classe de connexion à eXist-db
require 'ExistDBConnection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données du formulaire
    $nomCat = htmlspecialchars($_POST['nomcat'], ENT_QUOTES, 'UTF-8');
    $photoPath = '';

    // Gestion de l'upload de la photo
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $uploadsDir = 'uploads/';
        $photoPath = $uploadsDir . basename($_FILES['photo']['name']);
        
        // Déplacer la photo uploadée dans le répertoire cible
        if (!move_uploaded_file($_FILES['photo']['tmp_name'], $photoPath)) {
            die('Erreur lors de l\'upload de la photo.');
        }
    }

    // Initialiser la connexion eXist-db
    $exist = new ExistDBConnection(
        'http://localhost:8080/exist/rest',
        'admin', // Nom d'utilisateur
        'admin' // Mot de passe
    );

    // Requête XQuery pour ajouter une catégorie
    $xquery = <<<XQUERY
        xquery version "3.1";
        let \$doc := doc("/db/categories/categories.xml")
        let \$newCategory := 
            <categorie>
                <idcat>3</idcat>
                <nom>{$nomCat}</nom>
                <image>{$photoPath}</image>
            </categorie>
        return update insert \$newCategory into \$doc/categories
    XQUERY;

    // Exécuter la requête
    $result = $exist->executeQuery($xquery);

    if (strpos($result, '<exist:result') !== false) {
        echo "Catégorie ajoutée avec succès.";
    } else {
        echo "Erreur lors de l'ajout : " . $result;
    }
}
?>
