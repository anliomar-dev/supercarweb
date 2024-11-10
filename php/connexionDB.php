<?php
    // Informations de connexion
    $HOST = "localhost";
    $LOGIN = "root";
    $PASS = "Omaranli56Multisys";
    $DBNAME = "supercarDB";

    // Établir la connexion
    $DB = mysqli_connect($HOST, $LOGIN, $PASS, $DBNAME);

    // Vérifier la connexion
    if (!$DB) {
        die("La connexion à la base de données a échoué: " . mysqli_connect_error());
    }

    // Définir le jeu de caractères
    mysqli_set_charset($DB, "utf8");

    // Connexion réussie (aucun message affiché)
?>
