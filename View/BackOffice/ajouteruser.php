<?php
require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../../Model/utilisateurs.php';
require_once __DIR__ . '/../../Controller/utilisateursController.php';

$user = new Utilisateur(
    1,
    $_POST['nom'],
    $_POST['prenom'],
    $_POST['email'],
    $_POST['mot_de_passe'],
    $_POST['role']
);
$controller = new UtilisateursController();
$controller->ajouterUtilisateur($user);
header('Location: indexuser.php');