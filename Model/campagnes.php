<?php
class Campagne
{
    private $id;
    private $titre;
    private $description;

    public function __construct($id, $titre, $description)
    {
        $this->id = $id;
        $this->titre = $titre;
        $this->description = $description;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitre()
    {
        return $this->titre;
    }

    public function getDescription()
    {
        return $this->description;
    }
}
