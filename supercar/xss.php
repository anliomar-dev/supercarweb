<?php
session_start();

// Supposons que l'utilisateur soit connecté et que son email actuel soit enregistré en session
$_SESSION['email'] = 'user@example.com';

// Si une requête POST est envoyée, met à jour l'email
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nouvel_email = $_POST['email'];
    $_SESSION['email'] = $nouvel_email;
    echo "Email mis à jour avec succès en : " . $_SESSION['email'];
}
?>

<form method="POST" action="">
    <input type="email" name="email" placeholder="Nouvel email">
    <input type="submit" value="Mettre à jour">
</form>
