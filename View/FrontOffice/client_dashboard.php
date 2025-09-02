<?php
// Include controllers
require_once __DIR__ . '/../../Controller/campagnesController.php';
require_once __DIR__ . '/../../Controller/questionsController.php';
require_once __DIR__ . '/../../Controller/reponsesController.php';
require_once __DIR__ . '/../../Controller/campagnes_clientsController.php';

// Start session
session_start();

$userId = $_SESSION['id'];

// Fetch campagnes sent to this client
$campagnesController = new campagnes_clientsController();
$campagnes = $campagnesController->afficherCampagnesByUtilisateur($userId);

$questionsController = new questionsController();
$reponsesController = new reponsesController();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Client Dashboard - Mes Campagnes</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
</head>
<body>
    <div class="navbar">
        <span>Client Dashboard</span>
        <form method="post" action="../login.php" style="margin:0;">
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

        <?php if (empty($campagnes)): ?>
            <p>Aucune campagne ne vous a été envoyée.</p>
        <?php else: ?>
            <?php foreach ($campagnes as $campagne): ?>
                <div class="campagne">
                    <h2><?= htmlspecialchars($campagne['titre']) ?></h2>
                    <p><?= htmlspecialchars($campagne['description']) ?></p>
                    <div class="questions">
                        <strong>Questions:</strong>
                        <ul>
                            <?php
                            $questions = $questionsController->getQuestionsByCampagne($campagne['id']);
                            foreach ($questions as $question):
                                $reponses = $reponsesController->getReponsesByUtilisateurAndQuestion($userId, $question->id);
                            ?>
                                <li>
                                    <div>
                                        <span><?= htmlspecialchars($question->texte) ?></span>
                                    </div>
                                    <?php foreach ($reponses as $reponse): ?>
                                        <div class="reponse">
                                            <strong>Votre réponse:</strong>
                                            <span><?= htmlspecialchars(is_array($reponse) ? (isset($reponse['texte']) ? $reponse['texte'] : '') : $reponse) ?></span>
                                            <button type="button" class="modifier-btn" onclick="openModifierPopup(this, '<?= is_array($reponse) && isset($reponse['id']) ? $reponse['id'] : '' ?>', '<?= htmlspecialchars(is_array($reponse) ? (isset($reponse['texte']) ? $reponse['texte'] : '') : $reponse) ?>', '<?= $question->id ?>', '<?= $userId ?>')">Modifier</button>
                                            <!-- Popup Modal -->
                                            <div class="modifier-popup" style="display:none; position:fixed; top:0; left:0; width:100vw; height:100vh; background:rgba(0,0,0,0.5); align-items:center; justify-content:center; z-index:9999;">
                                                <div style="background:#fff; padding:20px; border-radius:8px; min-width:300px; position:relative;">
                                                    <span style="position:absolute; top:10px; right:15px; cursor:pointer;" onclick="closeModifierPopup(this)">&times;</span>
                                                    <form method="post" action="modifierreponse.php" onsubmit="return validateModifierForm(this);">
                                                        <input type="hidden" name="reponse_id" value="">
                                                        <input type="text" name="nouvelle_reponse" placeholder="Modifier votre réponse..." required style="width:100%;">
                                                        <input type="hidden" name="question_id" value="">
                                                        <input type="hidden" name="user_id" value="">
                                                        <button type="submit" style="margin-top:10px;">Enregistrer</button>
                                                    </form>
                                                </div>
                                            </div>
                                            <script>
                                                
                                            </script>
                                            <style>
                                               
                                            </style>
                                            <form method="post" action="supprimerreponse.php" style="display:inline;" onsubmit="return confirm('Voulez-vous vraiment supprimer cette réponse ?');">
                                                <input type="hidden" name="reponse_id" value="<?= is_array($reponse) && isset($reponse['id']) ? $reponse['id'] : '' ?>">
                                                <button type="submit">Supprimer</button>
                                            </form>
                                        </div>
                                    <?php endforeach; ?>
                                    
                                    <?php if (empty($reponses)): ?>
                                        <form method="post" style="margin-top:5px;" action="ajouterreponse.php">
                                            <input type="hidden" name="question_id" value="<?= $question->id ?>">
                                            <input type="hidden" name="user_id" value="<?= $userId ?>">
                                            <input type="text" name="reponse_texte" placeholder="Votre réponse..." style="width:250px;">
                                            <button type="submit">Envoyer</button>
                                        </form>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</body>
</html>