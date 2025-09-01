<?php
require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../../Model/campagnes_clients.php';
require_once __DIR__ . '/../../Controller/campagnes_clientsController.php';

$campagne_client= new campagnes_client(
    $_POST['id_campagne'],
    $_POST['id_client']
);
$controller = new campagnes_clientsController();
if ($controller->campagneClientExists($_POST['id_campagne'], $_POST['id_client'])) {
    echo "Le client est déjà associé à cette campagne.";
    header("Refresh:1; url=agent_dashboard.php");
    exit;
}
$controller->ajouterCampagneClient($_POST['id_campagne'], $_POST['id_client']);
header('Location: agent_dashboard.php');