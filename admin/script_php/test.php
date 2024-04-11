<?php
// Mot de passe saisi par l'utilisateur
$mot_de_passe = "mot_de_passe_securise";

// Hacher le mot de passe avec bcrypt
$hash = password_hash($mot_de_passe, PASSWORD_DEFAULT);

// Afficher le hash (pour vérification)
echo $hash;
?>
