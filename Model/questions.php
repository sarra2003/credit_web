<?php
class Question
{
    private $id;
    private $texte;
    private $idCampagne;

    public function __construct($id, $texte, $idCampagne)
    {
        $this->id = $id;
        $this->texte = $texte;
        $this->idCampagne = $idCampagne;
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
