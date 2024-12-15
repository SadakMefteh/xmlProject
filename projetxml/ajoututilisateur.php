<?php
// Inclusion de la classe de connexion à eXistDB
require 'ExistDBConnection.php';

// Initialisation de la connexion à eXistDB
$exist = new ExistDBConnection(
    'http://localhost:8080/exist/rest',
    'admin', // Nom d'utilisateur
    'admin'  // Mot de passe
);

$xmlFilePathUtilisateurs = '/db/utilisateurs/utilisateur.xml';

// Vérifier si le formulaire a été soumis
if (isset($_REQUEST["submit"])) {
    // Récupération et validation des paramètres d'entrée
    $nom = htmlspecialchars(trim($_REQUEST["nom"] ?? ''));
    $prenom = htmlspecialchars(trim($_REQUEST["prenom"] ?? ''));
    $adresse = htmlspecialchars(trim($_REQUEST["adresse"] ?? ''));
    $preference = htmlspecialchars(trim($_REQUEST["preferences"] ?? ''));
    $email = htmlspecialchars(trim($_REQUEST["email"] ?? ''));
    $motDePasse = htmlspecialchars(trim($_REQUEST["motDePasse"] ?? ''));
    $login = htmlspecialchars(trim($_REQUEST["login"] ?? ''));

    // Vérification des champs obligatoires
    if (empty($nom) || empty($prenom) || empty($adresse) || empty($email) || empty($motDePasse) || empty($login)) {
        die("Tous les champs obligatoires doivent être remplis.");
    }

    // Requête XQuery pour ajouter un utilisateur
    $xquery = <<<XQUERY
xquery version "3.1";
let \$doc := doc("$xmlFilePathUtilisateurs")
return
    update insert 
    <utilisateur>
        <nom>{$nom}</nom>
        <prenom>{$prenom}</prenom>
        <adresse>{$adresse}</adresse>
        <preference>{$preference}</preference>
        <login>{$login}</login>
        <email>{$email}</email>
        <motDePasse>{$motDePasse}</motDePasse>
        <privilège>participant</privilège>
    </utilisateur>
    into \$doc/utilisateurs
XQUERY;

    // Exécution de la requête pour ajouter l'utilisateur
    $result = $exist->executeQuery($xquery);

    // Vérification du résultat
    if ($result && strpos($result, '<exist:result') !== false) {
        echo "Participant ajouté avec succès.";
    } else {
        echo "Erreur lors de l'ajout : " . htmlspecialchars($result);
    }
} else {
    echo "Aucune donnée soumise.";
}
?>

