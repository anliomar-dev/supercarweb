<?php
    //server name
    $host = "localhost";
    //username
    $login = "root";
    //password
    $pass = "Omaranli56Multisys";
    //database name
    $dbname = "supercars";
    $dbd = mysqli_connect($host, $login, $pass, $dbname);
    if($dbd){
        //echo "connexion a MySql réussi <br>";
    }
    else{
        die("La connexion à la base de données a échoué: " . mysqli_connect_error());
    }
    mysqli_set_charset($dbd, "utf8");
?>