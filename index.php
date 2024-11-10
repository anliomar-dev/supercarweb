<?php
// Détecter l'URL demandée
$url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : '/';

// Définir les routes (URL et page associée)
switch ($url) {
    case '':
    case '/':
    case '/supercar':
        require 'supercar/home.php';
        break;
    case 'signin':
        require 'supercar/signin.php';
        break;
    case 'signup':
        require 'supercar/signup.php';
        break;
    case 'marques':
        require 'supercar/marques.php';
        break;
    case 'essai':
        require 'supercar/essai.php';
        break;
    case 'evenements':
        require 'supercar/evenements.php';
        break;
    case 'contact':
        require 'supercar/contact.php';
        break;
    case 'modele':
        if (isset($_GET['modele']) && is_numeric($_GET['modele'])) {
            $modele_id = (int)$_GET['modele']; // Conversion en entier pour sécurité
            // Tu peux utiliser $modele_id ici si nécessaire.
            require 'supercar/modele.php';
        } else {
            // Si le paramètre 'modele' est manquant ou non valide
            echo "Modèle invalide ou non spécifié.";
        }
        break;
    case 'wampindex':
        require 'wampindex.php';
        break;
    default:
        // Page 404 si l'URL n'existe pas
        echo "404 - Page non trouvée pour l'URL : " . htmlspecialchars($url);
        break;
}
?>
