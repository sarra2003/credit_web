<?php
class Question
{
    private $id;
    private $texte;
    private $idCampagne;

    public function __construct($id, $idCampagne, $texte)
    {
        $this->id = $id;
        $this->idCampagne = $idCampagne;
        $this->texte = $texte;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTexte()
    {
        return $this->texte;
    }

    public function getIdCampagne()
    {
        return $this->idCampagne;
    }
}
