<?php
require_once __DIR__ . '/../config.php';
require_once __DIR__ . '/../Model/utilisateurs.php';

class UtilisateursController
{
    public function ajouterUtilisateur($utilisateur)
    {
        try{
            $db = config::getConnexion();
            $query = $db->prepare(
                'INSERT INTO utilisateurs (nom, prenom, email, mdp, role) 
                VALUES (:nom, :prenom, :email, :mot_de_passe, :role)'
            );
            $query->execute([
                'nom' => $utilisateur->getNom(),
                'prenom' => $utilisateur->getPrenom(),
                'email' => $utilisateur->getEmail(),
                'mot_de_passe' => $utilisateur->getMdp(),
                'role' => $utilisateur->getRole()
            ]);
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }

    public function afficherUtilisateurs()
    {
        try {
            $db = config::getConnexion();
            $query = $db->query('SELECT * FROM utilisateurs');
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }
    public function supprimerUtilisateur($id)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare('DELETE FROM utilisateurs WHERE id = :id');
            $query->execute(['id' => $id]);
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }
    public function modifierUtilisateur($utilisateur, $id)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE utilisateurs SET 
                    nom = :nom, 
                    prenom = :prenom, 
                    email = :email, 
                    mdp = :mdp, 
                    role = :role 
                WHERE id = :id'
            );
            $query->execute([
                'nom' => $utilisateur->getNom(),
                'prenom' => $utilisateur->getPrenom(),
                'email' => $utilisateur->getEmail(),
                'mdp' => $utilisateur->getMdp(),
                'role' => $utilisateur->getRole(),
                'id' => $id
            ]);
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }
    public function findUserById($id)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare('SELECT * FROM utilisateurs WHERE id = :id');
            $query->execute(['id' => $id]);
            return $query->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }
    public function authenticate($email, $password)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare('SELECT * FROM utilisateurs WHERE email = :email');
            $query->execute(['email' => $email]);
            $user = $query->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['mdp'])) {
                return $user;
            }
            return false;
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }
}    