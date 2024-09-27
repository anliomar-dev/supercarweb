<?php
// Récupérer le chemin exact de l'URL
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Normaliser le chemin pour éviter les barres obliques finales
$path = rtrim($path, '/');

// Afficher le chemin pour diagnostic (optionnel)
// echo "Path: " . htmlspecialchars($path) . "<br>";

// Utilisation de 'match' pour définir le routage
$callable = match($path) {
    "/supercar/admin" => function() {
        // Inclure directement le fichier `index.php` dans le dossier `script_php`
        include_once __DIR__ . '/script_php/index.php';
    },
    "/supercar/admin/script_php/index" => function() {
        include_once __DIR__ . '/script_php/index.php';
    },
    "/supercar/admin/connection_admin.html" => function() {
        include_once __DIR__ . '/script_php/connection_admin.html';
    },
    "/supercar/admin/marques" => function() {
        include_once __DIR__ . '/marques.php';
    },
    default => function() use ($path) {
        echo "404 - Page non trouvée pour le chemin : " . htmlspecialchars($path);
    },
};

// Exécuter la fonction associée à la route
$callable();
?>
