<?php
require_once __DIR__ . '/../Model/campagnes_clients.php';
require_once __DIR__ . '/../config.php';
class campagnes_clientsController
{
    public function ajouterCampagneClient($id_campagne, $id_utilisateur)
    {
        $db = config::getConnexion();
        $stmt = $db->prepare("INSERT INTO campagnes_clients (id_campagne, id_utilisateur) VALUES (:id_campagne, :id_utilisateur)");
        $stmt->bindParam(':id_campagne', $id_campagne);
        $stmt->bindParam(':id_utilisateur', $id_utilisateur);
        $stmt->execute();
    }

    public function afficherCampagnesByUtilisateur($id_utilisateur){
        $db = config::getConnexion();
        $sql = "SELECT campagne.* 
            FROM campagne 
            INNER JOIN campagnes_clients ON campagne.id_campagne = campagnes_clients.id_campagne 
            WHERE campagnes_clients.id_utilisateur = :id_utilisateur";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id_utilisateur', $id_utilisateur);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function campagneClientExists($id_campagne, $id_utilisateur)
    {
        $db = config::getConnexion();
        $sql = "SELECT COUNT(*) FROM campagnes_clients WHERE id_campagne = :id_campagne AND id_utilisateur = :id_utilisateur";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id_campagne', $id_campagne);
        $stmt->bindParam(':id_utilisateur', $id_utilisateur);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }
}