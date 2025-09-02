<?php
require_once __DIR__ . '/../../Controller/reponsesController.php';

if (
    isset($_POST['reponse_id'], $_POST['nouvelle_reponse'], $_POST['question_id'], $_POST['user_id'])
    && !empty($_POST['reponse_id'])
) {
    $id = intval($_POST['reponse_id']);
    $nouvelleReponse = trim($_POST['nouvelle_reponse']);
    $questionId = intval($_POST['question_id']);
    $userId = intval($_POST['user_id']);
    $reponse = new Reponse($id, $questionId, $userId, $nouvelleReponse);
    $controller = new ReponsesController();
    $controller->modifierReponse($reponse,$id);

    header("Location: client_dashboard.php");
    exit;
} else {
    echo "Tous les champs du formulaire sont requis.";
}