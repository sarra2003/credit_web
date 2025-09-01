// Contrôle de saisie du formulaire d'ajout utilisateur
document.addEventListener('DOMContentLoaded', function () {
    var form = document.querySelector('form[action="ajouteruser.php"]');
    if (!form) return;
    form.addEventListener('submit', function (e) {
        var nom = form.nom.value.trim();
        var prenom = form.prenom.value.trim();
        var email = form.email.value.trim();
        var mot_de_passe = form.mot_de_passe.value;
        var role = form.role.value;

        if (nom === "" || prenom === "" || email === "" || mot_de_passe === "" || role === "") {
            alert("Tous les champs sont obligatoires.");
            e.preventDefault();
            return;
        }
        // Vérification email simple
        var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(email)) {
            alert("Veuillez entrer une adresse email valide.");
            e.preventDefault();
            return;
        }
        // Mot de passe minimum 6 caractères
        if (mot_de_passe.length < 6) {
            alert("Le mot de passe doit contenir au moins 6 caractères.");
            e.preventDefault();
            return;
        }
    });

   window.openModifierPopup = function (id, nom, prenom, email, motdepasse, role) {
  const popup = document.getElementById('modifierPopup');
  popup.style.display = 'block';
  document.getElementById('modifier_id').value = id;
  document.getElementById('modifier_nom').value = nom;
  document.getElementById('modifier_prenom').value = prenom;
  document.getElementById('modifier_email').value = email;
  document.getElementById('modifier_mot_de_passe').value = motdepasse;
  document.getElementById('modifier_role').value = role;
};

window.closeModifierPopup = function () {
  document.getElementById('modifierPopup').style.display = 'none';
};


        function closeModifierPopup() {
            document.getElementById('modifierPopup').style.display = 'none';
        }

        // Attach event listeners to Modifier links
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('a[href^="modifieruser.php?id="]').forEach(function(link) {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    var row = this.closest('tr');
                    var id = row.children[0].textContent;
                    var nom = row.children[1].textContent;
                    var prenom = row.children[2].textContent;
                    var email = row.children[3].textContent;
                    var role = row.children[4].textContent;
                    openModifierPopup(id, nom, prenom, email, role);
                });
            });
        });
});

 function openModifierCampagnePopup(id, nom, description) {
            document.getElementById('modifier_campagne_id').value = id;
            document.getElementById('modifier_campagne_nom').value = nom;
            document.getElementById('modifier_campagne_description').value = description;
            document.getElementById('modifierCampagnePopup').style.display = 'block';
        }
        function closeModifierCampagnePopup() {
            document.getElementById('modifierCampagnePopup').style.display = 'none';
        }
        function validateCampagneForm() {
            var nom = document.forms['ajoutCampagne']['nom'].value;
            var description = document.forms['ajoutCampagne']['description'].value;
            if (!nom) {
                alert('Veuillez remplir le nom de la campagne.');
                return false;
            }
            if (!description) {
                alert('Veuillez remplir la description de la campagne.');
                return false;
            }
            return true;
        }