<?php
class campagnes_client
{
    private $id_campagne;
    private $id_client;

    public function __construct($id_campagne, $id_client)
    {
        $this->id_campagne = $id_campagne;
        $this->id_client = $id_client;
    }

    public function getIdCampagne()
    {
        return $this->id_campagne;
    }

    public function getIdClient()
    {
        return $this->id_client;
    }
}