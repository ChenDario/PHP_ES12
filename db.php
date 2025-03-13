<?php
    //Definizione Variabili
    $host = "localhost";
    $db = "Museo";
    $user = "root";
    $pass = "";
    $conn = mysqli_connect($host, $user, $pass, $db) or die("Connessione non riuscita: " . mysqli_connect_error() );
?>