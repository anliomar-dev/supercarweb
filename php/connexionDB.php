<?php
    // Charger les variables d'environnement depuis le fichier .env
    require_once '../vendor/autoload.php'; 

    // Charger le fichier .env
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
    $dotenv->load();

    // Vérifier si les variables d'environnement sont définies
    if (!isset($_ENV['HOST_DB'], $_ENV['DATABASENAME'], $_ENV['USER_DB'], $_ENV['PASSWORD_DB'])) {
        die("Les variables d'environnement nécessaires ne sont pas définies.");
    }

    // Récupérer les variables d'environnement
    $HOST = $_ENV['HOST_DB'];
    $DBNAME = $_ENV['DATABASENAME'];
    $USER = $_ENV['USER_DB'];
    $PASSWORD = $_ENV['PASSWORD_DB'];

    // Connexion à la base de données
    $DB = mysqli_connect($HOST, $USER, $PASSWORD, $DBNAME);

    // Vérifier la connexion
    if (!$DB) {
        die("La connexion à la base de données a échoué: " . mysqli_connect_error());
    }

    // Définir l'encodage de la connexion
    mysqli_set_charset($DB, "utf8");
?>
