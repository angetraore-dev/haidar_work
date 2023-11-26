<?php
$connect = mysqli_connect("localhost", "root", "root@48_", "Dbhaidar");
//use Classes\DbConfig;

if(isset($_POST["query"])){

    $output = '';

    $query = "SELECT * FROM client WHERE client.nom LIKE '%".$_POST["query"]."%'";

    $result = mysqli_query($connect, $query);

    $output = '<ul class="list-unstyled">';



    if(mysqli_num_rows($result) > 0){

        while($row = mysqli_fetch_array($result)){

            $output .= '<li>'.$row["idClient"] .' '.$row["nom"].' '.$row["prenoms"].'</li>';

        }

    }else{

        $output .= '<li>User Not Found</li>';

    }



    $output .= '</ul>';

    echo $output;

}
