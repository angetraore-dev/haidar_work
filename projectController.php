<?php
require 'Classes/Autoloader.php';
Classes\Autoloader::register();

use Classes\Comporter;
use Classes\Database;
use Classes\DbConfig;
use Classes\Facture;
use Classes\Service;


if (isset($_POST['createFacture'])){

    $datas = json_decode($_POST['createFacture']);
    $user_field = explode(" ", $datas->user);
    $user_id = $user_field[0];

    $fields = [
        'idFacture' => null,
        'numeroFacture' => $datas->numFacture,
        'client' => $user_id,
        'datemiseenplace' => $datas->datemiseenplace,
        'typemiseenplace' => $datas->typemiseenplace,
        'codesite' => $datas->codesite,
        'createdAt' => $datas->createdAt
    ];

    $conn = new Facture();
    $bind = $conn->newFacture($fields);
    if ($bind){
        /*
         * Va servir pour inserer plusieurs services sur la facture precedement creee
         * lastinsertid est l'id de la derniere facture enregistree
         */
        $lastInsertID = $conn->LastInsertId();

        echo $lastInsertID;
    }


}

if (isset($_POST['idService'])){
$id = $_POST['idService'];
$price = Service::findPrice($id);
echo $price->getPrix();

}

if (isset($_POST['addDesignation'])){
    /*
     * [idService] => 1
    [prix] => 100000 //n 'est pas a inserer
    [quantity] => 7
    [remise] => 2-10
    [idFacture] => 46
    [total] => 630000
     */
    //Cest l affichage
    //echo $datas->idService;
    $datas = json_decode($_POST['addDesignation']);

    if (empty($datas->remise)){

        $rr = 1;

    }else{

        $remiseValue = explode("-", $datas->remise);

        $rr = $remiseValue[0];
    }



    $fields = [
      'idComporter' => null,
      'idFacture' => $datas->idFacture,
      'idService' => $datas->idService,
      'quantite' => $datas->quantity,
      'remise' => $rr,
      'total' => $datas->total
    ];

    $detail = new Comporter();
    $bind = $detail->create($fields);

    if ($bind){

        $lastInsertIdComporter = $detail->LastInsertId();

        //Get all insertion by facture

        $alldetailsInserted = Comporter::getAllComporterByFacture($datas->idFacture);

        echo print_r($alldetailsInserted, true);
    }





}