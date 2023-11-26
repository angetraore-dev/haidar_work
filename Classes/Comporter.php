<?php

namespace Classes;

class Comporter extends DbConfig
{
    protected $idComporter;
    protected $idFacture;
    protected $idService;

    /**
     * @return mixed
     */
    public function getIdComporter()
    {
        return $this->idComporter;
    }

    /**
     * @return mixed
     */
    public function getIdFacture()
    {
        return $this->idFacture;
    }

    /**
     * @param mixed $idFacture
     */
    public function setIdFacture($idFacture): void
    {
        $this->idFacture = $idFacture;
    }

    /**
     * @return mixed
     */
    public function getIdService()
    {
        return $this->idService;
    }

    /**
     * @param mixed $idService
     */
    public function setIdService($idService): void
    {
        $this->idService = $idService;
    }

    public static function getAllComporterByFacture($idFacture)
    {
        $stmt = "SELECT comporter.idComporter, comporter.idFacture, comporter.idService, 
        f.numeroFacture, f.client, f.total, f.createdAt,
        libelle, prix
        FROM comporter 
        JOIN facture f join client c on c.idClient = f.client 
        JOIN service s on s.idService = comporter.idService WHERE comporter.idFacture = ?";

        return self::getDb()->prepare($stmt, [$idFacture], get_called_class());

    }

    /**
     * @param $fields
     * @return bool
     * insert designation foreach facture
     */
    public function create($fields)
    {
        $implodeCols = implode(', ',array_keys($fields));
        $implodePlaceholder = implode(", :",array_keys($fields));
        $sql = "INSERT INTO comporter($implodeCols) VALUES(:" .$implodePlaceholder. ")";

        $db = $this->getPDO()->prepare($sql);
        foreach ($fields as $key => $value){
            $db->bindValue(':' .$key, $value);
        }
        $insertSql = $db->execute();
        return $insertSql;

    }
}