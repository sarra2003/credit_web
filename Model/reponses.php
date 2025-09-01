<?php
class Reponse
{
    private $id;
    private $idQuestion;
    private $idUtilisateur;
    private $texte;

    public function __construct($id, $idQuestion, $idUtilisateur, $texte)
    {
        $this->id = $id;
        $this->idQuestion = $idQuestion;
        $this->idUtilisateur = $idUtilisateur;
        $this->texte = $texte;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getIdQuestion()
    {
        return $this->idQuestion;
    }

    public function getTexte()
    {
        return $this->texte;
    }

    public function getIdUtilisateur()
    {
        return $this->idUtilisateur;
    }
}
