<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../Model/campagnes.php';

class CampagnesController
{
    public function ajouterCampagne($campagne)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'INSERT INTO campagnes (titre, description) 
                VALUES (:titre, :description)'
            );
            $query->execute([
                'titre' => $campagne->getTitre(),
                'description' => $campagne->getDescription()
            ]);
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    public function afficherCampagnes()
    {
        try {
            $db = config::getConnexion();
            $query = $db->query('SELECT * FROM campagnes');
            return $query->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    public function supprimerCampagne($id)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare('DELETE FROM campagnes WHERE id = :id');
            $query->execute(['id' => $id]);
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    public function modifierCampagne($campagne, $id)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE campagnes SET 
                    titre = :titre, 
                    description = :description
                WHERE id = :id'
            );
            $query->execute([
                'titre' => $campagne->getTitre(),
                'description' => $campagne->getDescription(),
                'id' => $id
            ]);
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    public function recupererCampagne($id)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare('SELECT * FROM campagnes WHERE id = :id');
            $query->execute(['id' => $id]);
            $campagne = $query->fetch(PDO::FETCH_OBJ);
            return $campagne;
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }
}
