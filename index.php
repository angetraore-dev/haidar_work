<?php
session_start();
require 'Classes/Autoloader.php';

 Classes\Autoloader::register();
use Classes\Client;

$allCustomers = Client::getAllClient();
//include('controller/projectController.php');


?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="angetraore-dev">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title> OOP PHP CODE</title>
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
    <div class="col-sm-8  mx-auto">
        <h3 class="h3 text-black fw-4 fs-3 my-4 text-left"> Create a facture</h3>


        <div id="datasenttocontroller"></div>
        <form class="row g-3" name="form" id="form" role="form">
            <div class="col-md-6">
                <label for="user" class="form-label">Search Customer by Name :</label>

                <input autocomplete="off" type="text" name="user" id="user" class="form-control" placeholder="Enter Customer Name" />

                <div id="userList"></div>

            </div>
            <div class="col-6">
                <label for="datemise" class="form-label">Date de mise en place</label>
                <input type="datetime-local" class="form-control" id="datemise" />
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
                <label for="typemise" class="form-label">Type de mise en place</label>
                <input type="text" class="form-control" name="typemise" id="typemise" />
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
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="assets/js/project.js"></script>

</body>
</html>
