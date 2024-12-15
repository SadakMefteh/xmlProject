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

$message = "";

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération et validation des paramètres d'entrée
    $nom = htmlspecialchars(trim($_POST["nom"] ?? ''));
    $prenom = htmlspecialchars(trim($_POST["prenom"] ?? ''));
    $adresse = htmlspecialchars(trim($_POST["adresse"] ?? ''));
    $preferences = $_POST['preferences'] ?? [];
    $email = htmlspecialchars(trim($_POST["email"] ?? ''));
    $motDePasse = htmlspecialchars(trim($_POST["motDePasse"] ?? ''));
    $privilege = $_POST['privilege'];
    // Vérification des champs obligatoires
    if (empty($nom) || empty($prenom) || empty($adresse) || empty($email) || empty($motDePasse)) {
        $message = "Tous les champs obligatoires doivent être remplis.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Adresse email invalide.";
    } else {
        // Préparation des données
        $preferences = is_array($preferences) ? array_map('htmlspecialchars', $preferences) : [];
        $preference = implode(', ', $preferences);

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
        <login>{$email}</login>
        <motDePasse>{$motDePasse}</motDePasse>
        <privilège>{$privilege}</privilège>
    </utilisateur>
    into \$doc/utilisateurs
XQUERY;

        // Exécution de la requête
        $result = $exist->executeQuery($xquery);

        if ($result === false) {
            $message = "Erreur lors de l'ajout : " . htmlspecialchars($exist->getLastError());
        } else {
            $message = "Participant ajouté avec succès.";
            if ($privilege == "Participant"){
                header("Location: participant.php");
                exit();
            }else{
                header("Location: organisateur.php");
                exit();
            }

        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription à un Événement</title>
    <!-- Lien vers Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&family=Dancing+Script:wght@600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="inscription.css">
</head>
<body>
    <div class="container-main">
        <div class="left-section"></div>
        <div class="right-section">
            <h2>Créer un compte</h2>
            <?php if ($message): ?>
                <div class="alert alert-info"><?= htmlspecialchars($message); ?></div>
            <?php endif; ?>
            <form action="" method="POST">
                <div class="mb-3">
                    <label for="prenom" class="form-label">Prénom</label>
                    <input type="text" class="form-control" id="prenom" name="prenom" required>
                </div>
                <div class="mb-3">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="nom" name="nom" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="adresse" class="form-label">Adresse</label>
                    <input type="text" class="form-control" id="adresse" name="adresse" required>
                </div>
                <div class="mb-3">
                    <label for="preferences" class="form-label">Préférences</label>
                    <div>
                        <input type="checkbox" id="seminaire" name="preferences[]" value="Séminaire">
                        <label for="seminaire">Séminaire</label>
                    </div>
                    <div>
                        <input type="checkbox" id="lancement" name="preferences[]" value="Lancement de produit">
                        <label for="lancement">Lancement de produit</label>
                    </div>
                    <div>
                        <input type="checkbox" id="soiree" name="preferences[]" value="Soirée d'entreprise">
                        <label for="soiree">Soirée d'entreprise</label>
                    </div>
                    <div>
                        <input type="checkbox" id="convention" name="preferences[]" value="Convention">
                        <label for="convention">Convention</label>
                    </div>
                    <div>
                        <input type="checkbox" id="voyage" name="preferences[]" value="Voyage de récompense">
                        <label for="voyage">Voyage de récompense</label>
                    </div>
                    <div>
                        <input type="checkbox" id="autre" name="preferences[]" value="Autre">
                        <label for="autre">Autre</label>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="motDePasse" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" id="motDePasse" name="motDePasse" required>
                </div>
                <label class="form-label">S'inscrire en tant que :</label>
    <div class="btn-group" role="group" aria-label="Choisissez un rôle">
        <input type="radio" class="btn-check" name="privilege" id="participant" autocomplete="off" value="Participant">
        <label class="btn btn-outline-primary" for="participant">Participant</label>

        <input type="radio" class="btn-check" name="privilege" id="organisateur" autocomplete="off" value="Organisateur">
        <label class="btn btn-outline-primary" for="organisateur">Organisateur</label>
    </div>
                <div class="d-flex justify-content-between">
                
                    <button type="submit" class="btn btn-primary">Créer un compte</button>
                    <button type="button" class="btn btn-secondary" onclick="history.back()">Annuler</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
