<?php
require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../../Model/questions.php';
require_once __DIR__ . '/../../Controller/questionsController.php';

$questionsController = new questionsController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $questionId = isset($_POST['question_id']) ? $_POST['question_id'] : null;
    $nouveauTexte = isset($_POST['nouveau_texte']) ? $_POST['nouveau_texte'] : null;
    $idCampagne = isset($_POST['id_campagne']) ? $_POST['id_campagne'] : null;

    if ($questionId && $nouveauTexte && $idCampagne) {
        // Créez une nouvelle instance de Question avec les nouvelles informations
        $question = new Question(
            $questionId,
            $idCampagne,
            $nouveauTexte
        );

        // Modifiez la question via le contrôleur
        $questionsController->modifierQuestion($question, $questionId);

        // Redirigez vers le tableau de bord de l'agent après modification
        header('Location: agent_dashboard.php');
        exit;
    }
}