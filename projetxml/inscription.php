<?php
$eventId = htmlspecialchars($_REQUEST['idevent']);
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
        <!-- Image fixe à gauche -->
        <div class="left-section">
        </div>

        <!-- Contenu dynamique à droite -->
        <div class="right-section">
            <div id="step-connexion" class="step active">
                <h2>Connexion</h2>
                <form id="form-login">
                    <div class="mb-3">
                        <label for="login" class="form-label">Login</label>
                        <input type="text" class="form-control" id="login" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" id="password" required>
                    </div>
                    <button type="button" class="btn btn-primary w-100" onclick="goToPayment()">Se connecter</button>
                    <p class="mt-3 text-center">
                        <a href="#" onclick="showStep('step-inscription')">Vous n'avez pas de compte ?</a>
                    </p>
                </form>
            </div>

            <div id="step-inscription" class="step">
                <h2>Créer un compte</h2>
                <form id="form-inscription" onsubmit="handleAccountCreation(event)">
                    <div class="mb-3">
                        <label for="prenom" class="form-label">Prénom</label>
                        <input type="text" class="form-control" id="prenom" required>
                    </div>
                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom</label>
                        <input type="text" class="form-control" id="nom" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="email" class="form-control" id="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="adresse" class="form-label">Adresse</label>
                        <input type="text" class="form-control" id="adresse" required>
                    </div>
                    <div class="mb-3">
                        <label for="preferences" class="form-label">Préférences</label>
                        <div>
                            <input type="checkbox" id="seminaire" name="preferences" value="Séminaire">
                            <label for="seminaire">Séminaire</label>
                        </div>
                        <div>
                            <input type="checkbox" id="lancement" name="preferences" value="Lancement de produit">
                            <label for="lancement">Lancement de produit</label>
                        </div>
                        <div>
                            <input type="checkbox" id="soiree" name="preferences" value="Soirée d'entreprise">
                            <label for="soiree">Soirée d'entreprise</label>
                        </div>
                        <div>
                            <input type="checkbox" id="convention" name="preferences" value="Convention">
                            <label for="convention">Convention</label>
                        </div>
                        <div>
                            <input type="checkbox" id="voyage" name="preferences" value="Voyage de récompense">
                            <label for="voyage">Voyage de récompense</label>
                        </div>
                        <div>
                            <input type="checkbox" id="autre" name="preferences" value="Autre">
                            <label for="autre">Autre</label>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary">Créer un compte</button>
                        <button type="button" class="btn btn-secondary" onclick="showStep('step-connexion')">Annuler</button>
                    </div>
                </form>
            </div>

            <div id="step-paiement" class="step">
                <h2>Paiement</h2>
                <p class="label-montant">Montant à payer : <span id="montant">30 DT</span></p>
                <form action="ajoutinscription.php" id="form-paiement">
                    <div class="mb-3">
                        <label for="num-carte" class="form-label">Numéro de carte</label>
                        <input type="text" class="form-control" id="num-carte" pattern="\d{16}" maxlength="16" placeholder="1234 5678 9012 3456" required>
                    </div>
                    <div class="mb-3">
                        <label for="cvc" class="form-label">CVC</label>
                        <input type="password" class="form-control" id="cvc" pattern="\d{3}" maxlength="3" placeholder="123" required>
                    </div>
                    <div class="mb-3">
                        <label for="date-expiration" class="form-label">Date d'expiration</label>
                        <input type="month" class="form-control" id="date-expiration" required>
                    </div>
                    <div class="d-flex justify-content-between">
                    <a href='ajoutinscription.php?idevent=$eventId'><button type='submit' class='btn btn-primary'>Valider</button></a>
                        <button type="button" class="btn btn-secondary" onclick="showStep('step-connexion')">Annuler</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function showStep(stepId) {
            document.querySelectorAll('.step').forEach(step => {
                step.classList.remove('active');
            });
            document.getElementById(stepId).classList.add('active');
        }

        function goToPayment() {
            showStep('step-paiement');
        }

        function handleAccountCreation(event) {
            event.preventDefault();
            alert("Visitez votre mail pour voir votre login et mot de passe.");
            showStep('step-connexion');
        }
    </script>

    <!-- Script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
