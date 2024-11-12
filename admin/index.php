<?php
// Récupérer le chemin exact de l'URL
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Normaliser le chemin pour éviter les barres obliques finales
$path = rtrim($path, '/');

$callable = match($path) {
    "/admin" => function() {
        include_once __DIR__ . '/dashboard.php';
    },
    "/admin/utilisateurs" => function() {
        include_once __DIR__ . '/utilisateurs.php'; 
    },
    "/admin/marques" => function() {
        include_once __DIR__ . '/marques.php'; 
    },
    "/admin/modeles" => function() {
        include_once __DIR__ . '/modeles.php';
    },
    "/admin/essais" => function() {
        include_once __DIR__ . '/essais.php'; 
    },
    "/admin/contacts" => function() {
        include_once __DIR__ . '/contacts.php';
    },
    "/admin/evennements" => function() {
        include_once __DIR__ . '/evennements.php';
    },
    "/admin/dashboard" => function() {
        include_once __DIR__ . '/dashboard.php';
    },
    "/admin/visites" => function() {
        include_once __DIR__ . '/visites.php';
    },
    "/admin/groupes" => function() {
        include_once __DIR__ . '/groupes.php'; 
    },
    "/admin/permissions" => function() {
        include_once __DIR__ . '/permissions.php';
    },
    "/admin/horaires" => function() {
        include_once __DIR__ . '/horaires.php';
    },
    "/admin/newsletter" => function() {
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
