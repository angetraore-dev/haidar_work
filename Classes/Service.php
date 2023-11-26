<?php

namespace Classes;

class Service extends DbConfig
{
    protected $idService;
    protected $libelle;
    protected $prix;

    /**
     * @return mixed
     */
    public function getIdService()
    {
        return $this->idService;
    }

    /**
     * @return mixed
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * @param mixed $libelle
     */
    public function setLibelle($libelle): void
    {
        $this->libelle = $libelle;
    }

    /**
     * @return mixed
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * @param mixed $prix
     */
    public function setPrix($prix): void
    {
        $this->prix = $prix;
    }

    /**
     * @return array|false|mixed
     * To get All Services
     */
    public static function getAllService()
    {
        $stmt = "SELECT * FROM service order by libelle DESC ";

        return self::getDb()->query($stmt, get_called_class());
    }

}