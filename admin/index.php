<?php
// Récupérer le chemin exact de l'URL
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Normaliser le chemin pour éviter les barres obliques finales
$path = rtrim($path, '/');

$callable = match($path) {
    "/super-car/admin" => function() {
        include_once __DIR__ . '/dashboard.php';
    },
    "/super-car/admin/utilisateurs" => function() {
        include_once __DIR__ . '/utilisateurs.php'; 
    },
    "/super-car/admin/marques" => function() {
        include_once __DIR__ . '/marques.php'; 
    },
    "/super-car/admin/modeles" => function() {
        include_once __DIR__ . '/modeles.php';
    },
    "/super-car/admin/essais" => function() {
        include_once __DIR__ . '/essais.php'; 
    },
    "/super-car/admin/contacts" => function() {
        include_once __DIR__ . '/contacts.php';
    },
    "/super-car/admin/evennements" => function() {
        include_once __DIR__ . '/evennements.php';
    },
    "/super-car/admin/dashboard" => function() {
        include_once __DIR__ . '/dashboard.php';
    },
    "/super-car/admin/visites" => function() {
        include_once __DIR__ . '/visites.php';
    },
    "/super-car/admin/groupes" => function() {
        include_once __DIR__ . '/groupes.php'; 
    },
    "/super-car/admin/permissions" => function() {
        include_once __DIR__ . '/permissions.php';
    },
    "/super-car/admin/horaires" => function() {
        include_once __DIR__ . '/horaires.php';
    },
    "/super-car/admin/newsletter" => function() {
        include_once __DIR__ . '/newsletter.php';
    },
    default => function() {
        // Rediriger vers une page 404 personnalisée
        http_response_code(404); // Définir le code d'état HTTP à 404
        include_once __DIR__ . '/404.php'; // Inclure la page 404 personnalisée
    },
};

// Exécuter la fonction associée à la route
$callable();

?>
