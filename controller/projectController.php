<?php
use Classes\Client;
use Classes\Facture;
use Classes\Service;
use Classes\Comporter;

//createFacture
if (isset($_POST['createFacture'])){
    $datas = json_decode($_POST['createFacture']);
    echo print_r($datas, true);
}