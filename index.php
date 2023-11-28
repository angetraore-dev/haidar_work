<?php
session_start();
require 'Classes/Autoloader.php';
Classes\Autoloader::register();
use Classes\Client;
use Classes\Facture;
use Classes\Remise;
use Classes\Service;

$allCustomers = Client::getAllClient();
$facture = Facture::getAlldistinctfacture();
$allService = Service::getAllService();
$allRemise = Remise::getAllPourcentage();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="angetraore-dev">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="assets/css/style.css" rel="stylesheet">
    <title> OOP PHP CODE Haidar Project</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!--
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    -->
    <style>

        ul

        {

            background-color:#eee;

            cursor:pointer;

        }

        li

        {

            padding:12px;

        }

    </style>

</head>
<body>
<div class="container my-4">

    <div class="col-sm-8  mx-auto" id="forfacture">

        <h3 class="h3 text-black fw-4 fs-3 my-4 text-left" id="create_facture"> Create a facture</h3>

        <form class="row g-3" name="form" id="form" role="form">
            <div class="col-md-6">
                <label for="user" class="form-label">Search Customer by Name :</label>

                <input autocomplete="off" type="text" name="user" id="user" class="form-control overflow-scroll" placeholder="Enter Customer Name" />

                <div id="userList" class="overflow-scroll"></div>

            </div>
            <div class="col-6">
                <label for="datemiseenplace" class="form-label">Date de mise en place</label>
                <input type="date" class="form-control" id="datemiseenplace" name="datemiseenplace" />
            </div>

            <div class="col-6">
                <label for="numFacture" class="form-label">Numero Facture</label>
                <input type="text" class="form-control" id="numFacture" name="numFacture" />
            </div>

            <div class="col-md-6">
                <label for="createdAt" class="form-label">Created AT</label>

                <input type="date" name="createdAt" class="form-control" id="createdAt" />

            </div>

            <div class="col-6">
                <label for="typemiseenplace" class="form-label">Type de mise en place</label>
                <input type="text" class="form-control" name="typemiseenplace" id="typemiseenplace" />
            </div>
            <div class="col-md-6">
                <label for="codesite" class="form-label">Code du Site</label>
                <input type="text" class="form-control" id="codesite" name="codesite" />
            </div>


            <div class="col-12 my-3">
                <button type="button" id="createFacture" name="createFacture" class="btn btn-primary float-end">next</button>
            </div>
        </form>
    </div>

    <div class="col-sm-8 mx-auto border border-outline-warning" id="forcomporter">

        <h3 class="h3 text-primary fw-3 fs-3 my-4 text-center" id="add_service">Facture's Details</h3>

        <!-- Form name addService -->
        <form class="form py-4 px-2" name="addService" id="addService" role="form">

            <div class="row g-3">
                <div class="col">
                    <label for="idService" class="form-label">Designation</label>
                    <select name="idService" id="idService" class="form-select">
                        <?php for ($i =0; $i < count($allService); $i++) : ?>
                            <option value="<?php echo $allService[$i]['idService']; ?>"><?php echo $allService[$i]['libelle']; ?></option>
                        <?php endfor; ?>

                    </select>
                </div>

                <div class="col">
                    <label for="prix" class="form-label">Prix</label>
                    <input class="form-control" type="text" name="prix" id="prix" value="" readonly="readonly" />
                </div>
            </div>


            <div class="row g-3 py-4">

                <div class="col-8">

                    <label for="quantity" class="form-label">Quantite</label>

                    <div class="qte-div">

                        <button type="button" class="quantity-left-minus" data-type="minus" data-field=""> - </button>

                        <input type="number" class="" name="quantity" id="quantity" value="" min="1" max="100" readonly />

                        <button type="button" class="quantity-right-plus" data-type="plus" data-field="">+</button>

                    </div>

                </div>


                <div class="col">
                    <label for="remise" class="form-label">Remise</label>
                    <select name="remise" id="remise" class="form-select">
                        <option value="0" selected="selected">CHOOSE A REMISE OR NOT ?</option>

                        <?php for ($y =0; $y < count($allRemise); $y++) : ?>
                            <?php if ($allRemise[$y]['idRemise'] != 1) : ?>
                                <option class="form-control" value="<?php echo $allRemise[$y]['idRemise'] .'-'.$allRemise[$y]['pourcentage']; ?>"> <?php echo $allRemise[$y]['pourcentage']; ?>%</option>
                            <?php endif; ?>
                        <?php endfor;?>
                    </select>
                </div>

            </div>

            <!-- idFacture to repeat insertion in same facture -->
           <div class="row g-3 p-4">
               <div class="col">
                   <label for="idFacture" class="form-label">Facture numero:</label>
                   <input class="form-control" type="text" name="idFacture" id="idFacture" value="" readonly="readonly" />

               </div>
               <div class="col amountremise">
                   <label for="total" class="form-label fw-6 text-back">Montant TOTAL en FCFA *</label><br>

                   <div class="amountremisesub">

                       <label for="sub" class="form-label text-muted"><small>Remise Amount:</small></label>
                       <span><p class="text-muted" id="sub"></p> FCFA</span>
                   </div>
                   <input class="form-control" type="text" name="total" id="total" value="" readonly="readonly">

               </div>
           </div>

            <div class="col-12 my-4">
                <button class="btn btn-primary bg-dark text-white float-start" type="button" name="ajouter" id="ajouter">Ajouter a la facture</button>
                <button class="btn btn-outline-success text-black float-end" type="button" name="save" id="save">Save & close</button>
            </div>

        </form>

        <!--<label for="quantity" class="form-label">Quantite</label>
      <div class="input-group">
      <span class="input-group-btn">
          <button type="button" class="quantity-left-minus btn btn-danger btn-number"  data-type="minus" data-field="">
              <span class="glyphicon glyphicon-minus"></span>
          </button>
      </span>
          <input type="number" id="quantity" name="quantity" class="form-control" value="" min="1" max="100" readonly="readonly" />
          <span class="input-group-btn">
          <button type="button" class="quantity-right-plus btn btn-success btn-number" data-type="plus" data-field="">
              <span class="glyphicon glyphicon-plus"></span>
          </button>
      </span>
      </div>-->
<!--for detail facture -->
        <div id="retourderequest"></div>
    </div>

    <div class="col-sm-8 mx-auto border-2 border-success p-4" id="displayFacture">
        <div class="row theFacture">

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="assets/js/project.js"></script>

</body>
</html>
