<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../Model/reponses.php';

class reponsesController
{
    public function ajouterReponse($reponse)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'INSERT INTO reponses (id_question, id_utilisateur, texte) 
                VALUES (:id_question, :id_utilisateur, :texte)'
            );
            $query->execute([
                'id_question' => $reponse->getIdQuestion(),
                'id_utilisateur' => $reponse->getIdUtilisateur(),
                'texte' => $reponse->getTexte()
            ]);
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    public function afficherReponses($id_question, $id_utilisateur)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare('SELECT * FROM reponses WHERE id_question = :id_question AND id_utilisateur = :id_utilisateur');
            $query->execute([
                'id_question' => $id_question,
                'id_utilisateur' => $id_utilisateur
            ]);
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    public function supprimerReponse($id)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare('DELETE FROM reponses WHERE id = :id');
            $query->execute(['id' => $id]);
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    public function modifierReponse($reponse, $id)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
            'UPDATE reponses SET 
                texte = :texte 
            WHERE id = :id'
            );
            $query->execute([
            'texte' => $reponse->getTexte(),
            'id' => $id
            ]);
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    public function findReponseById($id)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare('SELECT * FROM reponses WHERE id = :id');
            $query->execute(['id' => $id]);
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }
    public function getReponsesByUtilisateurAndquestion($userId, $questionId)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare('SELECT * FROM reponses WHERE id_utilisateur = :id_utilisateur AND id_question = :id_question');
            $query->execute(['id_utilisateur' => $userId, 'id_question' => $questionId]);
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }
}
