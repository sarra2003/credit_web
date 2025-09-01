<?php
// Include controllers
require_once __DIR__ . '/../../Controller/campagnesController.php';
require_once __DIR__ . '/../../Controller/questionsController.php';
require_once __DIR__ . '/../../Controller/utilisateursController.php';

// Start session for deconnection
session_start();

// Handle deconnection
if (isset($_POST['deconnect'])) {
    session_destroy();
    header('Location: /gestiondenquete/View/login.php');
    exit;
}

// Fetch all campagnes
$campagnesController = new campagnesController();
$campagnes = $campagnesController->afficherCampagnes();

// Handle show clients for envoyer
$showClientsForCampagne = null;
if (isset($_POST['show_clients']) && isset($_POST['campagne_id'])) {
    $showClientsForCampagne = intval($_POST['campagne_id']);
    $utilisateursController = new utilisateursController();
    $clients = $utilisateursController->getUsersByRole('client');
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Agent Dashboard - Campagnes</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
</head>
<body>
    <div class="navbar">
        <span>Agent Dashboard</span>
        <form method="post" style="margin:0;">
            <button type="submit" name="deconnect" class="deconnect-btn">Déconnexion</button>
        </form>
    </div>
    <div class="container">
        <?php if (isset($success)): ?>
            <div class="success"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>
        <?php if (isset($error)): ?>
            <div class="error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <?php foreach ($campagnes as $campagne): ?>
            <div class="campagne">
                <h2><?= htmlspecialchars($campagne->titre) ?></h2>
                <p><?= htmlspecialchars($campagne->description) ?></p>
                <div class="questions">
                    <strong>Questions:</strong>
                    <ul>
                        <?php
                        $questionsController = new questionsController();
                        $questions = $questionsController->getQuestionsByCampagne($campagne->id);
                        foreach ($questions as $question):
                        ?>
                            <li><?= htmlspecialchars($question->texte) ?></li>
                            <button type="button" onclick="openEditPopup(<?= $question->id ?>, '<?= htmlspecialchars(addslashes($question->texte)) ?>')" >Modifier</button>
                            <div id="edit-popup-<?= $question->id ?>" class="edit-popup" style="display:none; position:fixed; top:30%; left:50%; transform:translate(-50%, -50%); background:#fff; border:1px solid #ccc; padding:20px; z-index:1000;">
                                <form method="post" action="modifierquestion.php" style="margin:0;">
                                    <input type="hidden" name="question_id" value="<?= $question->id ?>">
                                    <input type="hidden" name="id_campagne" value="<?= $campagne->id ?>">
                                    <input type="text" name="nouveau_texte" id="edit-text-<?= $question->id ?>" value="<?= htmlspecialchars($question->texte) ?>" style="width:250px;">
                                    <button type="submit">Enregistrer</button>
                                    <button type="button" onclick="closeEditPopup(<?= $question->id ?>)">Annuler</button>
                                </form>
                            </div>
                            <form method="post" action="supprimerquestion.php" style="display:inline;">
                                <input type="hidden" name="question_id" value="<?= $question->id ?>">
                                <button type="submit" onclick="return confirm('Supprimer cette question ?');">Supprimer</button>
                            </form>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <form method="post" action="ajouterquestion.php" id="add-question-form-<?= $campagne->id ?>" onsubmit="return validateQuestionForm(<?= $campagne->id ?>);">
                    <input type="hidden" name="campagne_id" value="<?= $campagne->id ?>">
                    <input type="text" name="question_text" id="question-text-<?= $campagne->id ?>" placeholder="Add a question..." >
                    <button type="submit">Add Question</button>
                </form>
                
                <form method="post" style="margin-top:10px;">
                    <input type="hidden" name="campagne_id" value="<?= $campagne->id ?>">
                    <button type="submit" name="show_clients">Envoyer</button>
                </form>
                <?php if ($showClientsForCampagne === $campagne->id && isset($clients)): ?>
                    <div class="clients-list">
                        <h3>Clients</h3>
                        <?php foreach ($clients as $client): ?>
                            <div class="client-row">
                                <span><?= htmlspecialchars($client['nom']) ?> (<?= htmlspecialchars($client['email']) ?>)</span>
                                <form method="post" action="envoyer.php" style="margin:0;">
                                    <input type="hidden" name="id_campagne" value="<?= $campagne->id ?>">
                                    <input type="hidden" name="id_client" value="<?= $client['id'] ?>">
                                    <button type="submit" class="envoyer-btn">Envoyer</button>
                                </form>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>