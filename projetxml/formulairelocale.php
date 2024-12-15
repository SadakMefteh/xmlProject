<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Event Builder</title>
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="css/normalize.css" />
  <!-- Font Awesome Library -->
  <link rel="stylesheet" href="css/all.min.css" />
  <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&#038;display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
  <div class="container">
    <!-- Left Section with Video -->
    <div class="left">
      <video autoplay muted loop class="background-video">
        <source src="images/UpscaleVideo_1_20241122.mp4" type="video/mp4">
      </video>
      
    </div>

    <!-- Right Section with Form -->
    <div class="right">
      <h1>Ajouter un locale</h1>
      <form action="ajoutcategories.php" method="post">
        <div class="form-group">
          <label class="form-label" for="nomloc">le nom du local</label>
          <input type="text" class="form-control" name="nomloc" id="nomloc" placeholder="Entrer le nom du local" required>
        </div>
        <div class="form-group">
          <label class="form-label" for="adloc">Adresse du local</label>
          <input type="text" class="form-control" name="adloc" id="adloc" placeholder="Entrer l'adresse du local" required>
        </div>
    <div class="form-group">
        <label for="photo">Ajouter une photo de ce locale:</label>
        <input type="file" id="photo" name="photo" accept="image/*" >
      </div>
      <div class="preview">
        <p>Aperçu de l'image :</p>
        <img id="photoPreview" alt="Aperçu de la photo">
      </div>
  
      
  
    <script>
      // Écouteur pour l'upload d'une image
      const photoInput = document.getElementById('photo');
      const photoPreview = document.getElementById('photoPreview');
  
      photoInput.addEventListener('change', function (event) {
        const file = event.target.files[0]; // Récupérer le fichier sélectionné
  
        if (file) {
          const reader = new FileReader();
  
          // Charger l'image et mettre à jour l'aperçu
          reader.onload = function (e) {
            photoPreview.src = e.target.result;
            photoPreview.style.display = 'block'; // Afficher l'image
          };
  
          reader.readAsDataURL(file); // Lire le fichier
        } else {
          photoPreview.src = '';
          photoPreview.style.display = 'none'; // Masquer l'aperçu si aucun fichier sélectionné
        }
      });
    </script>
        <button type="submit" class="btn btn-primary" name="submit" id="submit" >Ajouter</button>
      </form>
    </div>
  </div>
  <script src="script.js"></script>
</body>
</html>