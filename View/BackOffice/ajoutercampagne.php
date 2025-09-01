<?php
require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../../Model/campagnes.php';
require_once __DIR__ . '/../../Controller/campagnesController.php';

$campagne = new Campagne(
    null, // Assuming ID is auto-incremented
    $_POST['nom'],
    $_POST['description']
);

$controller = new CampagnesController();
$controller->ajouterCampagne($campagne);
header('Location: indexcampagne.php');
