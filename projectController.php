<?php
require 'Classes/Autoloader.php';
Classes\Autoloader::register();
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
    $datas = json_decode($_POST['addDesignation']);
    print_r($datas, true);
    die();
}