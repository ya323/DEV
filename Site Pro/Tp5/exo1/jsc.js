// Fonction pour gérer l'ajout d'un utilisateur au tableau
document.getElementById('userForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Empêche l'envoi du formulaire au serveur

    // Récupération des données du formulaire
    let nom = document.getElementById('nom').value;
    let prenom = document.getElementById('prenom').value;
    let dateNaissance = document.getElementById('dateNaissance').value;
    let aimeWeb = document.getElementById('aimeWeb').checked ? 'Oui' : 'Non';
    let remarques = document.getElementById('remarques').value;

    // Vérification que le champ nom est rempli
    if (nom === '') {
        document.getElementById('errorMessage').textContent = "Le champ nom est obligatoire.";
        return;
    } else {
        document.getElementById('errorMessage').textContent = ""; // Réinitialiser le message d'erreur
    }

    // Ajout de l'utilisateur dans le tableau
    let tableBody = document.getElementById('userTableBody');
    let newRow = tableBody.insertRow();

    newRow.innerHTML = `
        <td>${nom}</td>
        <td>${prenom}</td>
        <td>${dateNaissance}</td>
        <td>${aimeWeb}</td>
        <td>${remarques}</td>
        <td><span class="btn edit">Edit</span> | <span class="btn delete">Delete</span></td>
    `;

    // Ajout de l'événement Delete
    newRow.querySelector('.delete').addEventListener('click', function() {
        tableBody.removeChild(newRow); // Supprimer la ligne
    });

    // Ajout de l'événement Edit
    newRow.querySelector('.edit').addEventListener('click', function() {
        if (this.textContent === 'Edit') {
            // Activer le mode édition
            let cells = newRow.querySelectorAll('td:not(:last-child)');
            cells.forEach(function(cell) {
                let cellValue = cell.innerText;
                cell.innerHTML = `<input type="text" class="editable" value="${cellValue}">`;
            });

            // Remplacer Edit par Save
            this.textContent = 'Save';
        } else {
            // Sauvegarder les nouvelles valeurs dans les cellules
            let cells = newRow.querySelectorAll('td:not(:last-child)');
            cells.forEach(function(cell) {
                let input = cell.querySelector('input');
                cell.textContent = input.value; // Remplacer l'input par la valeur de texte
            });

            // Revenir au bouton Edit
            this.textContent = 'Edit';
        }
    });

    // Réinitialiser le formulaire
    document.getElementById('userForm').reset();
});


