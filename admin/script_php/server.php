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
        echo "connexion a MySql réussi <br>";
    }
    else{
        echo "connexion a MySql non réussi:" . mysqli_connect_error();
    }
    mysqli_set_charset($dbd, "utf8");
?>