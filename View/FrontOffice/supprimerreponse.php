<?php
require_once __DIR__ . '/../../Controller/reponsesController.php';

if (isset($_POST['reponse_id'])) {
    $id = intval($_POST['reponse_id']);
    $controller = new ReponsesController();
    $controller->supprimerReponse($id);
    header("Location: client_dashboard.php");
    exit;
} else {
    echo "ID de réponse non spécifié.";
}