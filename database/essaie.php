<?php
    include("../database/connexion.php");

    // Définir le temps d'expiration de session à 30 minutes
    $tempsExpiration = 1 * 60; // 1 minutes en secondes

    // Définir la durée maximale de vie d'une session (en secondes)
    ini_set('session.gc_maxlifetime', $tempsExpiration);
    // Définir le temps d'expiration du cookie de session
    session_set_cookie_params($tempsExpiration);
     // Mettre à jour le timestamp de la dernière activité à chaque action de l'utilisateur
    $_SESSION['last_activity'] = time();

     // Vérifier si la session a expiré
    if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $tempsExpiration)) {
         // La session a expiré, déconnecter l'utilisateur
        session_unset();
        session_destroy();
         // Rediriger l'utilisateur vers la page de connexion ou une autre page appropriée
        header("Location: ../pages/sessin_expire.html");
        exit();
    }
    // Commencer une session
    session_start();


    if (isset($_POST["submit"])) {
        // Le bouton "submit" a été soumis

        // Vérifier si l'utilisateur est connecté
        if (!isset($_SESSION['username'])) {
            // Si l'utilisateur n'est pas connecté, redirigez-le vers la page de connexion
            echo "<p>Redirection vers la page de connexion...</p>";
            header("Location: ../pages/session_expire.html");
            exit();
        } else {
            // Assainir et valider les données saisies par l'utilisateur
            $date = mysqli_real_escape_string($dbd, $_POST["date_essai"]);
            $heure = mysqli_real_escape_string($dbd, $_POST["heure_essai"]);
            $marque = mysqli_real_escape_string($dbd, $_POST["IdMarque"]);
            $moteur = mysqli_real_escape_string($dbd, $_POST["type_voiture"]);
            $modele = mysqli_real_escape_string($dbd, $_POST["IdModele"]);
            $IdInscription = $_SESSION['idInscription'];
            // Requête d'insertion avec une déclaration paramétrée
            $inserer = "INSERT INTO demandeessaie (DateEssaie, HeureEssaie, Marque, Modele, Moteur, IdInscription)
                        VALUES ('$date', '$heure', '$marque', '$modele', '$moteur', $IdInscription)";
            mysqli_query($dbd, $inserer);
            echo "<p>Données insérées avec succès</p>";
            mysqli_close($dbd);
        }
    } else {
        // Le bouton "submit" n'a pas été soumis
        echo "<p>Le formulaire n'a pas été soumis.</p>";
    }
?>