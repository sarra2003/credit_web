<?php
require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../../Model/utilisateurs.php';
require_once __DIR__ . '/../../Controller/utilisateursController.php';

$controller = new UtilisateursController();
$utilisateurs = $controller->afficherUtilisateurs();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Utilisateurs</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
</head>
<body>
    <div class="sidebar">
        <h3>Back Office</h3>
        <a href="indexuser.php">Utilisateurs</a>
        <a href="#">Tableau de bord</a>
        <a href="#">Paramètres</a>
        <a href="#">Déconnexion</a>
    </div>
    <div class="container">
        <h2>Liste des Utilisateurs</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Rôle</th>
                <th>Actions</th>
            </tr>
<?php foreach ($utilisateurs as $user): ?>
            <tr>
                <td><?= htmlspecialchars($user['id']) ?></td>
                <td><?= htmlspecialchars($user['nom']) ?></td>
                <td><?= htmlspecialchars($user['prenom']) ?></td>
                <td><?= htmlspecialchars($user['email']) ?></td>
                <td><?= htmlspecialchars($user['role']) ?></td>
                <td class="actions">
                    <?php
                        // Récupérer les données utilisateur à partir de la base via findUserById
                        $userData = $controller->findUserById($user['id']);
                    ?>
<?php if ($userData): 
    $mdp = htmlspecialchars($userData['mdp']);
    ?>
<button type="button" onclick="openModifierPopup('<?= htmlspecialchars($userData['id']) ?>','<?= htmlspecialchars($userData['nom']) ?>','<?= htmlspecialchars($userData['prenom']) ?>','<?= htmlspecialchars($userData['email']) ?>','<?= $mdp ?>','<?= htmlspecialchars($userData['role']) ?>')">Modifier</button>
<?php else: ?>
<span>Erreur utilisateur</span>
<?php endif; ?>
                    <a href="supprimeruser.php?id=<?= htmlspecialchars($user['id']) ?>" onclick="return confirm('Supprimer cet utilisateur ?');">Supprimer</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <!-- Popup Form for Modifier -->
        <div id="modifierPopup" class="popup" style="display:none;">
            <div class="popup-content">
                <span class="close" onclick="closeModifierPopup()">&times;</span>
                <h2>Modifier Utilisateur</h2>
                <form id="modifierForm" method="post" action="modifieruser.php">
                    <input type="hidden" name="id" id="modifier_id">
                    <input type="text" name="nom" id="modifier_nom" placeholder="Nom">
                    <input type="text" name="prenom" id="modifier_prenom" placeholder="Prénom">
                    <input type="email" name="email" id="modifier_email" placeholder="Email">
                    <input type="password" name="mot_de_passe" id="modifier_mot_de_passe" placeholder="Mot de passe">
                    <select type="hidden" name="role" id="modifier_role">
                        <option value="admin">Admin</option>
                        <option value="agent">Agent</option>
                        <option value="client">Client</option>
                    </select>
                    <input type="submit" value="Enregistrer">
                </form>
            </div>
        </div>
        <h2>Ajouter un Utilisateur</h2>
        <form name="ajoutUser" action="ajouteruser.php" method="post" onsubmit="return validateForm();">
            <input type="text" name="nom" placeholder="Nom">
            <input type="text" name="prenom" placeholder="Prénom">
            <input type="email" name="email" placeholder="Email">
            <input type="password" name="mot_de_passe" placeholder="Mot de passe">
            <select name="role">
                <option value="">Rôle</option>
                <option value="admin">Admin</option>
                <option value="agent">Agent</option>
                <option value="client">Client</option>
            </select>
            <input type="submit" value="Ajouter">
        </form>
    </div>
</body>
</html>