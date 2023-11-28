<?php

namespace Classes;

use PDO;

class Comporter extends DbConfig
{
    protected $idComporter;
    protected $idFacture;
    protected $idService;
    protected $quantite;
    protected $remise;
    protected $total;

    /**
     * @return mixed
     */
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * @param mixed $quantite
     */
    public function setQuantite($quantite): void
    {
        $this->quantite = $quantite;
    }

    /**
     * @return mixed
     */
    public function getRemise()
    {
        return $this->remise;
    }

    /**
     * @param mixed $remise
     */
    public function setRemise($remise): void
    {
        $this->remise = $remise;
    }

    /**
     * @return mixed
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * @param mixed $total
     */
    public function setTotal($total): void
    {
        $this->total = $total;
    }

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

    /**
     * @param $idFacture
     * @return array|false|mixed
     *  Return ALl Facture and Details but not good
     */
    public static function getAllComporterByFacture($idFacture)
    {
        $stmt =  "SELECT comporter.idComporter, comporter.idFacture, comporter.idService, comporter.quantite, comporter.remise, comporter.total,
        f.numeroFacture, f.client, f.createdAt, s.libelle, s.prix, c.nom, c.prenoms, r.pourcentage
        FROM comporter 
        INNER JOIN facture f join client c on c.idClient = f.client 
        INNER JOIN service s on s.idService = comporter.idService 
        INNER JOIN remise r on comporter.remise = r.idRemise
        WHERE comporter.idFacture = ?"
        ;

        return DbConfig::getDb()->prepare($stmt, [$idFacture], get_called_class());

    }

    /**
     * @param $idFacture
     * @return array|false|mixed
     * Return All Details by Facture
     */
    public static function allComporterByFacture($idFacture){
        $sql = "
            SELECT comporter.idComporter, comporter.idFacture, s.libelle, s.prix, r.pourcentage, comporter.quantite, comporter.total FROM comporter 
                INNER JOIN service s on s.idService = comporter.idService 
                INNER JOIN remise r on r.idRemise = comporter.remise 
            WHERE idFacture = ? 
        ";

        return DbConfig::getDb(PDO::FETCH_OBJ)->prepare($sql, [$idFacture], get_called_class());

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

        $stmt = $this->getPDO()->prepare($sql);

        foreach ($fields as $key => $value){

            $stmt->bindValue(':' .$key, $value);
        }

        if ( $stmt->execute() ){

            $insert = true;

        }else{

            $insert = false;
        }

        return $insert;

    }

    /*
     * id = idFacture | idComporter
     */
    public function update($fields, $id):bool
    {
        $st = "";
        $counter = 1;
        $row_fields = count($fields);

        foreach ($fields as $key => $value){

            if ( $counter == $row_fields ){

                $set = "$key = :" .$key;

                $st = $st . $set;

            }else{

                $set = "$key = :" .$key . ", ";

                $st = $st . $set;
                $counter++;
            }

        }

        $sql = "";

        $sql .= "UPDATE comporter SET " .$st;

        $sql .= " WHERE idComporter = ".$id;

        $stmt = $this->getPDO()->prepare($sql);

        foreach ($fields as $key => $value){

            $stmt->bindValue(':' .$key, $value);
        }

        if ($stmt->execute() ){

            $insert = true;

        }else{

            $insert = false;
        }

        return $insert;

    }

    public function delete($id):bool
    {
        $sql = "DELETE FROM comporter WHERE idComporter = :idComporter LIMIT 1";
        $stmt = $this->getPDO()->prepare($sql);
        $stmt->bindValue(':idComporter', $id, PDO::PARAM_INT);

        if ( $stmt->execute() ){

            $insert = true;

        }else{

            $insert = false;
        }

        return $insert;

    }
}