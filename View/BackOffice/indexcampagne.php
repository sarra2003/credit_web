<?php
require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../../Model/campagnes.php';
require_once __DIR__ . '/../../Controller/campagnesController.php';

$controller = new CampagnesController();
$campagnes = $controller->afficherCampagnes();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion des Campagnes</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
</head>
<body>
    <div class="sidebar">
        <h3>Back Office</h3>
        <a href="indexuser.php">Utilisateurs</a>
        <a href="indexcampagne.php">Campagnes</a>
        <a href="#">Tableau de bord</a>
        <a href="#">Paramètres</a>
        <a href="../login.php">Déconnexion</a>
    </div>
    <div class="container">
        <h2>Liste des Campagnes</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Titre</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
<?php foreach ($campagnes as $campagne): ?>
            <tr>
                <td><?= htmlspecialchars($campagne->id) ?></td>
                <td><?= htmlspecialchars($campagne->titre) ?></td>
                <td><?= htmlspecialchars($campagne->description) ?></td>
                <td class="actions">
                    <?php
?>
<button type="button" onclick="openModifierCampagnePopup('<?= htmlspecialchars($campagne->id) ?>','<?= htmlspecialchars($campagne->titre) ?>','<?= htmlspecialchars($campagne->description) ?>')">Modifier</button>
                    <a href="supprimercampagne.php?id=<?= htmlspecialchars($campagne->id) ?>" onclick="return confirm('Supprimer cette campagne ?');">Supprimer</a>
                </td>
            </tr>
<?php endforeach; ?>
        </table>
        <!-- Popup Form for Modifier Campagne -->
        <div id="modifierCampagnePopup" class="popup" style="display:none;">
            <div class="popup-content">
                <span class="close" onclick="closeModifierCampagnePopup()">&times;</span>
                <h2>Modifier Campagne</h2>
                <form id="modifierCampagneForm" method="post" action="modifiercampagne.php">
                    <input type="hidden" name="id" id="modifier_campagne_id">
                    <input type="text" name="nom" id="modifier_campagne_nom" placeholder="Nom">
                    <input type="text" name="description" id="modifier_campagne_description" placeholder="Description">
                    <input type="submit" value="Enregistrer">
                </form>
            </div>
        </div>
        <h2>Ajouter une Campagne</h2>
        <form name="ajoutCampagne" action="ajoutercampagne.php" method="post" onsubmit="return validateCampagneForm();">
            <input type="text" name="nom" placeholder="Nom">
            <input type="text" name="description" placeholder="Description">
            <input type="submit" value="Ajouter">
        </form>
    </div>
    
</body>
</html>
