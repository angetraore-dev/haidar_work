<?php

namespace Classes;

class Remise extends Database
{
    protected $idRemise;
    protected $pourcentage;

    /**
     * @return mixed
     */
    public function getIdRemise()
    {
        return $this->idRemise;
    }

    /**
     * @return mixed
     */
    public function getPourcentage()
    {
        return $this->pourcentage;
    }

    /**
     * @param mixed $pourcentage
     */
    public function setPourcentage($pourcentage): void
    {
        $this->pourcentage = $pourcentage;
    }


}