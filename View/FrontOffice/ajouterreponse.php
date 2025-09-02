<?php
require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../../Controller/reponsesController.php';

$reponse = new Reponse(
    null, // Assuming ID is auto-incremented
    $_POST['question_id'],
    $_POST['user_id'],
    $_POST['reponse_texte']
);

$reponsesController = new reponsesController();
$reponsesController->ajouterReponse($reponse);
header('Location: client_dashboard.php');
exit;