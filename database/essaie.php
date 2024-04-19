<?php
    session_start();
    include("connexion.php");
    if (isset($_POST["submit"])) {
        // Le bouton "submit" a été soumis
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
    } else {
        // Le bouton "submit" n'a pas été soumis
        echo "<p>Le formulaire n'a pas été soumis.</p>";
    }
?>