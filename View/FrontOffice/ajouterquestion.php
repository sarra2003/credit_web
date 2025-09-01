<?php
require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../../Model/questions.php';
require_once __DIR__ . '/../../Controller/questionsController.php';

$question = new Question(
    null, // Assuming ID is auto-incremented
    $_POST['campagne_id'],
    $_POST['question_text']
);
$questionsController = new questionsController();
$questionsController->ajouterQuestion($question);
header('Location: /gestiondenquete/View/FrontOffice/agent_dashboard.php');
exit;