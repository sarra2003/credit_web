<?php
class Utilisateur
{
    private $id;
    private $nom;
    private $prenom;
    private $email;
    private $mdp;
    private $role;

    public function __construct($id, $nom, $prenom, $email, $mdp, $role)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->email = $email;
        $this->prenom = $prenom;
        $this->mdp = $mdp;
        $this->role = $role;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getMdp()
    {
        return $this->mdp;
    }

    public function getRole()
    {
        return $this->role;
    }
}