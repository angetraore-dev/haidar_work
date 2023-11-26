<?php

namespace Classes;

use PDO;

class Client extends DbConfig
{
    protected $idClient;
    protected $nom;
    protected $prenoms;
    protected $contact;

    /**
     * @return mixed
     */
    public function getIdClient()
    {
        return $this->idClient;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom): void
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getPrenoms()
    {
        return $this->prenoms;
    }

    /**
     * @param mixed $prenoms
     */
    public function setPrenoms($prenoms): void
    {
        $this->prenoms = $prenoms;
    }

    /**
     * @return mixed
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * @param mixed $contact
     */
    public function setContact($contact): void
    {
        $this->contact = $contact;
    }

    /**
     * @return array|false|mixed
     * To get All Clients
     */
    public static function getAllClient(){
        $stmt = "SELECT * FROM client ORDER BY nom";
        return self::getDb()->query($stmt, get_called_class());
    }


}