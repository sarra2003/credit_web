<?php
require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../../Model/utilisateurs.php';
require_once __DIR__ . '/../../Controller/utilisateursController.php';
$id= $_POST['id'];
$user= new utilisateur(
    $id,
    $_POST['nom'],
    $_POST['prenom'],
    $_POST['email'],
    $_POST['mot_de_passe'],
    $_POST['role']
);

$controller = new UtilisateursController();
$controller->modifierUtilisateur($user, $id);
header('Location: indexuser.php');
