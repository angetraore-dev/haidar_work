<?php

namespace Classes;
use Classes\DbConfig;

class Facture extends DbConfig
{
    protected $idFacture;
    protected $numeroFacture;
    protected $client;
    protected $datemiseenplace;
    protected $typemiseenplace;
    protected $codesite;
    protected $createdAt;

    /**
     * @return mixed
     */
    public function getIdFacture()
    {
        return $this->idFacture;
    }

    /**
     * @return mixed
     */
    public function getNumeroFacture()
    {
        return $this->numeroFacture;
    }

    /**
     * @param mixed $numeroFacture
     */
    public function setNumeroFacture($numeroFacture): void
    {
        $this->numeroFacture = $numeroFacture;
    }

    /**
     * @return mixed
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * @param mixed $client
     */
    public function setClient($client): void
    {
        $this->client = $client;
    }

    /**
     * @return mixed
     */
    public function getDatemiseenplace()
    {
        return $this->datemiseenplace;
    }

    /**
     * @param mixed $datemiseenplace
     */
    public function setDatemiseenplace($datemiseenplace): void
    {
        $this->datemiseenplace = $datemiseenplace;
    }

    /**
     * @return mixed
     */
    public function getTypemiseenplace()
    {
        return $this->typemiseenplace;
    }

    /**
     * @param mixed $typemiseenplace
     */
    public function setTypemiseenplace($typemiseenplace): void
    {
        $this->typemiseenplace = $typemiseenplace;
    }

    /**
     * @return mixed
     */
    public function getCodesite()
    {
        return $this->codesite;
    }

    /**
     * @param mixed $codesite
     */
    public function setCodesite($codesite): void
    {
        $this->codesite = $codesite;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return array|false|mixed
     * Get All factures by Customers and designation on each Factures
     */
    public static function getAlldistinctfacture()
    {
        $stmt = "SELECT facture.idFacture, facture.client, facture.createdAt, facture.codesite, facture.typemiseenplace, facture.datemiseenplace, facture.numeroFacture, 
            c.nom, c.prenoms, c.contact, c2.total FROM facture 
           INNER JOIN client c on c.idClient = facture.client INNER JOIN comporter c2 on facture.idFacture = c2.idFacture
            INNER JOIN service s on c2.idService = s.idService INNER JOIN remise r on c2.remise = r.idRemise"
        ;

        return DbConfig::getDb()->query($stmt, get_called_class());
    }

    public static function oneFactureAndDetail($idFacture)
    {
        $stmt = "SELECT facture.idFacture, facture.client, facture.createdAt, facture.codesite, facture.typemiseenplace, facture.datemiseenplace, facture.numeroFacture, 
            c.nom, c.prenoms, c.contact, c2.idComporter, c2.quantite, c2.total, r.pourcentage FROM facture 
           INNER JOIN client c on c.idClient = facture.client 
           INNER JOIN comporter c2 on facture.idFacture = c2.idFacture
           INNER JOIN service s on c2.idService = s.idService INNER JOIN remise r on c2.remise = r.idRemise
           WHERE facture.idFacture = ?
            "
        ;

        return DbConfig::getDb()->prepare($stmt, [$idFacture], __CLASS__, true);
    }

    public function newFacture($fields)
    {
        $implodeColumns = implode(', ', array_keys($fields));
        $implodePlaceholders = implode(', :', array_keys($fields));
        $request = "INSERT INTO facture($implodeColumns) VALUES (:". $implodePlaceholders .")";

        $stmt = $this->getPDO()->prepare($request);

        foreach ( $fields as $key => $value ){
            $stmt->bindValue(':'.$key, $value);
        }

        $stmtExec = $stmt->execute();

        return $stmtExec;
    }


}