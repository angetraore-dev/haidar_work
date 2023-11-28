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
    $output = '';
    $datas = json_decode($_POST['addDesignation']);

    ?>
    <input type="hidden" id="saveValue" name="saveValue" value="<?php echo $datas->idFacture ; ?>" readonly>

    <?php

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

        $alldetailsInserted = $detail->allComporterbyFactureObject($datas->idFacture);

        echo '
            <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Designation</th>
              <th scope="col">Qte</th>
              <th scope="col">Prix</th>
              <th scope="col">Remise</th>
              <th scope="col">Total</th>
            </tr>
          </thead>
          <tbody>';

                for ($i =0; $i < count($alldetailsInserted); $i++) :?>

                    <tr>
                        <th scope="row"><?php echo $i+1 ;?></th>
                        <td><?php echo $alldetailsInserted[$i]->libelle; ?></td>
                        <td><?php echo $alldetailsInserted[$i]->quantite; ?></td>
                        <td><?php echo $alldetailsInserted[$i]->prix; ?></td>
                        <td><?php if ($alldetailsInserted[$i]->pourcentage != 1){
                            echo $alldetailsInserted[$i]->pourcentage .'%';
                            }?></td>
                        <td><?php echo $alldetailsInserted[$i]->total; ?></td>
                    </tr>

                <?php endfor;

         echo '</tbody></table>';


    }


}

if (isset($_POST['savedFacture'])){

    $idFacture = $_POST['savedFacture'];
    $theFacture = Facture::oneFactureAndDetail($idFacture);

    var_dump($theFacture);

    /*clientName createdAtDate numFac miseenplaceDate
     * protected 'idFacture' => int 61
      protected 'numeroFacture' => string 'facture#BACKEND' (length=15)
      protected 'client' => int 3
      protected 'datemiseenplace' => string '2023-11-25' (length=10)
      protected 'typemiseenplace' => string 'ESPIONNAGE' (length=10)
      protected 'codesite' => string 'PLATEAU' (length=7)
      protected 'createdAt' => string '2023-11-28' (length=10)
     echo '<div class="row g-3 my-4 p-2">';
     foreach ($theFacture as $value): ?>
         <div class="col"> <?php echo $value->getNumeroFacture() .'<br>';?></div>
         <div class="col"> <?php echo 'nom & prenoms:' . $theFacture[0]->nom .' '. $theFacture[0]->prenoms .'<br>'; ?></div>
     <div class="col"><?php echo 'Date de la facture :' . $value->getCreatedAt() .'<br>'; ?></div>
     <div class="col"><?php echo 'Date de mise en place:' . $value->getDatemiseenplace() .' <br>' ; ?></div>

     <?php endforeach;

     echo '</div>';
     */


    echo '
            <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Designation</th>
              <th scope="col">Qte</th>
              <th scope="col">Prix</th>
              <th scope="col">Remise</th>
              <th scope="col">Total</th>
            </tr>
          </thead>
          <tbody>';

    for ($i =0; $i < count($theFacture); $i++) :?>

        <tr>
            <th scope="row"><?php echo $i+1 ;?></th>
            <td><?php echo $theFacture[$i]->libelle; ?></td>
            <td><?php echo $theFacture[$i]->quantite; ?></td>
            <td><?php echo $theFacture[$i]->prix; ?></td>
            <td><?php if ($theFacture[$i]->pourcentage != 1){
                    echo $theFacture[$i]->pourcentage .'%';
                }?></td>
            <td><?php echo $theFacture[$i]->total; ?></td>
        </tr>

    <?php endfor;

    echo '</tbody></table>';


}