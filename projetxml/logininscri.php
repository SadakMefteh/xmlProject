<?php
$eventId = htmlspecialchars($_REQUEST['idevent']);
?>
<?php
// Inclure la connexion à eXistDB
require 'ExistDBConnection.php'; 

// Initialiser les variables
$errorMessage = '';
$existClient = new ExistDBConnection('http://localhost:8080/exist/rest', 'admin', 'admin'); // Modifiez l'URL et les identifiants si nécessaire
$xmlFilePath = '/db/utilisateurs/utilisateur.xml';

if (isset($_POST['submit'])) {
    // Récupérer les données du formulaire
    $login = htmlspecialchars($_POST['login'] ?? '', ENT_QUOTES, 'UTF-8');
    $password = htmlspecialchars($_POST['password'] ?? '', ENT_QUOTES, 'UTF-8');

    // Vérification des champs vides
    if (empty($login) || empty($password)) {
        $errorMessage = 'Veuillez remplir tous les champs.';
    } else {
        // Requête XQuery pour vérifier les identifiants
        $xquery = "
        let \$doc := doc('$xmlFilePath')
        for \$utilisateur in \$doc//utilisateur
        where \$utilisateur/login = '$login' and \$utilisateur/motDePasse = '$password'
        return 
          <utilisateur>
            <nom>{\$utilisateur/nom/text()}</nom>
            <prenom>{\$utilisateur/prenom/text()}</prenom>
            <adresse>{\$utilisateur/adresse/text()}</adresse>
            <preference>{\$utilisateur/preference/text()}</preference>
            <email>{\$utilisateur/email/text()}</email>
            <login>{\$utilisateur/login/text()}</login>
            <motDePasse>{\$utilisateur/motDePasse/text()}</motDePasse>
            <privilege>{\$utilisateur/privilège/text()}</privilege>
          </utilisateur>";

        // Exécuter la requête
        $results = $existClient->executeQuery($xquery);

        // Charger les résultats XML
        $xml = simplexml_load_string($results);

        if ($xml && count($xml->utilisateur) > 0) {
            // Redirection ou message de succès
            
            // Exemple : Redirection vers une autre page

            header("Location: inscriptionevent.php?idevent=" . urlencode($eventId) . "&login=" . urlencode($login));
            exit(); 
            // header('Location: tableau_de_bord.php');
            exit;
        } else {
            $errorMessage = 'Login ou mot de passe incorrect.';
        }
    }
}
?>



<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <!-- Lien vers Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&family=Dancing+Script:wght@600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container-main {
            max-width: 400px;
            width: 100%;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
    </style>
</head>
<body>
    <div class="container-main">
        <h2 class="text-center">Connexion</h2>

        <?php if (!empty($errorMessage)): ?>
            <div class="alert alert-danger" role="alert">
                <?= $errorMessage ?>
            </div>
        <?php endif; ?>

        <form action="" method="POST">
            <div class="mb-3">
                <label for="login" class="form-label">Login</label>
                <input type="text" name="login" class="form-control" id="login" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" name="password" class="form-control" id="password" required>
            </div>
            <button type="submit" name="submit" class="btn btn-primary w-100">Se connecter</button>
        </form>

        <p class="mt-3 text-center">
            <a href="signininscrit.php" >Vous n'avez pas de compte ?</a>
        </p>
    </div>
</body>
</html>
