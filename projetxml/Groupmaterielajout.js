// Ajouter un nouveau matériel avec quantité
function addNouveauMateriel() {
    const materielInput = document.getElementById("nouveauMateriel");
    const quantiteInput = document.getElementById("nouveauQuantite");
    const materielsList = document.getElementById("materielsList");

    const materiel = materielInput.value.trim();
    const quantite = parseInt(quantiteInput.value);

    if (!materiel) {
        alert("Veuillez entrer un nom de matériel.");
        return;
    }

    if (isNaN(quantite) || quantite < 1) {
        alert("Veuillez entrer une quantité valide.");
        return;
    }

    // Ajouter à la liste
    const li = document.createElement("li");
    li.className = "list-group-item d-flex justify-content-between align-items-center";

    // Contenu de la ligne
    li.innerHTML = `
        <span>${materiel} (Quantité: ${quantite})</span>
        <button class="btn btn-danger btn-sm" onclick="removeMateriel(this)">Supprimer</button>
    `;

    // Ajouter l'élément à la liste
    materielsList.appendChild(li);

    // Réinitialiser les inputs
    materielInput.value = "";
    quantiteInput.value = "1";
}

// Supprimer un matériel de la liste
function removeMateriel(button) {
    const li = button.closest("li");
    li.remove();
}

// Enregistrer le type avec les matériels et leurs quantités
function saveNewType() {
    const nouveauType = document.getElementById("nouveauType").value.trim();
    const materielsList = document.getElementById("materielsList");

    if (!nouveauType) {
        alert("Veuillez entrer un type de matériel.");
        return;
    }

    const nouveauxMateriels = Array.from(materielsList.children).map((li) => {
        const content = li.querySelector("span").textContent;
        const [materiel, quantite] = content.match(/(.+)\s\(Quantité:\s(\d+)\)/).slice(1, 3);
        return { nom: materiel.trim(), quantite: parseInt(quantite) };
    });

    if (nouveauxMateriels.length === 0) {
        alert("Veuillez ajouter au moins un matériel.");
        return;
    }

    // Ajouter au dictionnaire global
    materiels[nouveauType.toLowerCase()] = nouveauxMateriels;

    // Réinitialiser le formulaire
    document.getElementById("nouveauType").value = "";
    materielsList.innerHTML = "";

    alert(`Type "${nouveauType}" ajouté avec succès.`);
}
