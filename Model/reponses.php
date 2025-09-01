<?php
class Reponse
{
    private $id;
    private $idQuestion;
    private $texte;

    public function __construct($id, $idQuestion, $texte)
    {
        $this->id = $id;
        $this->idQuestion = $idQuestion;
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
}
