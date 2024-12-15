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
    <!-- CSS personnalisé -->
    <link rel="stylesheet" href="formajoutevent.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        h2 {
            font-family: 'Dancing Script', cursive;
            font-size: 2rem;
            text-align: center;
            margin-bottom: 1.5rem;
            color: #6c63ff;
        }
        .form-control, .btn {
            border-radius: 0.5rem;
        }
        .btn-primary {
            background-color: #007BFF;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .container {
            max-width: 600px;
            background-color: #f9f9f9;
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2>Formulaire d'Inscription à un Événement</h2>
        <form action="inscriptionaunevenement.php" method="POST">
            <!-- Section informations personnelles -->
            <div class="mb-3">
                <label for="prenom" class="form-label">Prénom</label>
                <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Votre prénom" required>
            </div>
            <div class="mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" class="form-control" id="nom" name="nom" placeholder="Votre Nom" required>
            </div>
            <div class="mb-3">
                <label for="adresse" class="form-label">Adresse</label>
                <input type="text" class="form-control" id="adresse" name="adresse" placeholder="Votre adresse" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" class="form-control" id="email" name="mail" placeholder="Votre e-mail" required>
            </div>
            <div class="mb-3">
                <label for="preference" class="form-label">Préférences</label>
                <textarea class="form-control" id="preference" name="preference" rows="3" placeholder="Vos préférences ou remarques"></textarea>
            </div>
            <!-- Bouton de soumission -->
            <button type="submit" class="btn btn-primary w-100">S'inscrire</button>
        </form>
    </div>

    <!-- Script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
