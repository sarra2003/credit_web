<?php
require_once __DIR__ . '/../../config.php';
require_once __DIR__ . '/../../Model/questions.php';

class QuestionsController
{
    public function ajouterQuestion($question)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'INSERT INTO questions (texte, id_campagne) 
                VALUES (:texte, :id_campagne)'
            );
            $query->execute([
                'texte' => $question->getTexte(),
                'id_campagne' => $question->getIdCampagne()
            ]);
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    public function afficherQuestions()
    {
        try {
            $db = config::getConnexion();
            $query = $db->query('SELECT * FROM questions');
            return $query->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    public function supprimerQuestion($id)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare('DELETE FROM questions WHERE id = :id');
            $query->execute(['id' => $id]);
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    public function modifierQuestion($question, $id)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE questions SET 
                    texte = :texte, 
                    id_campagne = :id_campagne 
                WHERE id = :id'
            );
            $query->execute([
                'texte' => $question->getTexte(),
                'id_campagne' => $question->getIdCampagne(),
                'id' => $id
            ]);
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    public function recupererQuestion($id)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare('SELECT * FROM questions WHERE id = :id');
            $query->execute(['id' => $id]);
            $question = $query->fetch(PDO::FETCH_OBJ);
            return $question;
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }
}