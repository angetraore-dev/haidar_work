<?php

namespace Classes;

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

    public static function getAllComporterByFacture($idFacture)
    {
        $stmt = "SELECT comporter.idComporter, comporter.idFacture, comporter.idService, comporter.quantite, comporter.remise, comporter.total,
        f.numeroFacture, f.client, f.createdAt, s.libelle, s.prix, c.nom, c.prenoms, r.pourcentage
        FROM comporter 
        INNER JOIN facture f join client c on c.idClient = f.client 
        INNER JOIN service s on s.idService = comporter.idService 
        INNER JOIN remise r on comporter.remise = r.idRemise
        WHERE comporter.idFacture = ?";

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