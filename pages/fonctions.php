<?php
function verifierAuthentification() {
    // Définir le temps d'expiration de session à 30 minutes (ou la valeur appropriée)
    $tempsExpiration = 30 * 60; // 30 minutes en secondes

    // Commencer la session si ce n'est pas déjà fait
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // Vérifier si la session est active
    if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $tempsExpiration)) {
        // La session a expiré, déconnecter l'utilisateur
        session_unset();
        session_destroy();
        // Rediriger l'utilisateur vers une autre page
        header("Location: page_session_expiree.php");
        exit();
    }

    // Vérifier si l'utilisateur est connecté
    if (!isset($_SESSION['username'])) {
        // L'utilisateur n'est pas connecté, rediriger vers une autre page
        header("Location: page_connexion.php");
        exit();
    }

    // Mettre à jour le timestamp de la dernière activité
    $_SESSION['last_activity'] = time();
}
?>