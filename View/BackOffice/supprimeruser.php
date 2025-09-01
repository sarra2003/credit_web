<?php
require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../../Model/utilisateurs.php';
require_once __DIR__ . '/../../Controller/utilisateursController.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $controller = new UtilisateursController();
    $controller->supprimerUtilisateur($id);
    header('Location: indexuser.php');
    exit();
}