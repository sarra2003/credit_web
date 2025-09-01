<?php
require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../../Model/campagnes.php';
require_once __DIR__ . '/../../Controller/campagnesController.php';

$id = $_POST['id'];
$campagne = new campagne(
    $id,
    $_POST['nom'],
    $_POST['description']
);

$controller = new campagnesController();
$controller->modifierCampagne($campagne, $id);
header('Location: indexcampagne.php');