<?php
require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../../Model/questions.php';
require_once __DIR__ . '/../../Controller/questionsController.php';

$questionsController = new questionsController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $questionId = isset($_POST['question_id']) ? $_POST['question_id'] : null;

    if ($questionId) {
        // Supprimez la question via le contrôleur
        $questionsController->supprimerQuestion($questionId);

        // Redirigez vers le tableau de bord de l'agent après suppression
        header('Location: agent_dashboard.php');
        exit;
    }
}