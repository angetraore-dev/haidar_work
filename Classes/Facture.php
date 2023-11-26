<?php

namespace Classes;

class Facture extends DbConfig
{
    protected $idFacture;
    protected $numeroFacture;
    protected $client;
    protected $total;
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
        $stmt = "SELECT *  FROM facture 
            JOIN client c on c.idClient = facture.client
            JOIN comporter c2 on facture.idFacture = c2.idFacture
            JOIN service s on s.idService = c2.idService
            order by createdAt DESC "
        ;

        return self::getDb()->query($stmt, get_called_class());
    }

    public static function CreateFacture($fields)
    {

        $implodeColumns = implode(', ', array_keys($fields));
        $implodePlaceholders = implode(', :', array_keys($fields));

        $request = "INSERT INTO facture($implodeColumns) VALUES (:". $implodePlaceholders .")";

        $stmt = self::getDb()->prepare($request, $fields,get_called_class());

        foreach ( $fields as $key => $value ){
            $stmt->bindValue(':'.$key, $value);
        }

        $stmtExec = $stmt->execute();

        return $stmtExec;

    }


}