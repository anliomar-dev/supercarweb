<?php
    // lod env variables from .env file

    require_once 'vendor/autoload.php'; 
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    $HOST = $_ENV['HOST_DB'];
    $DBNAME = $_ENV['DATABASENAME'];
    $USER = $_ENV['USER_DB'];
    $PASSWORD = $_ENV['PASSWORD_DB'];

    // connect
    $DB = mysqli_connect($HOST, $USER, $PASSWORD, $DBNAME);

    // check conection
    if (!$DB) {
        die("La connexion à la base de données a échoué: " . mysqli_connect_error());
    }

    // encoding
    mysqli_set_charset($DB, "utf8");
?>
