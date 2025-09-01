<?php
require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../../Model/campagnes.php';
require_once __DIR__ . '/../../Controller/campagnesController.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $controller = new CampagnesController();
    $controller->supprimerCampagne($id);
    header('Location: indexcampagne.php');
    exit();
}