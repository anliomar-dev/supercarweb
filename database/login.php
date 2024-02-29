
<?php
    include("connexion.php");

    // Si le bouton "submit" est pressé, on affecte les valeurs remplies sur le formulaire aux variables correspondantes
    if (isset($_POST["submit"])) {
        $identifiant = mysqli_real_escape_string($dbd, $_POST["identifiant"]);
        $mot_de_passe = $_POST["mot_de_passe"];

        // Requête pour récupérer le mot de passe associé à l'identifiant
        $requete = "SELECT MotDePasse, IdInscription FROM inscription WHERE Identifiant = '$identifiant'";
        $resultat = mysqli_query($dbd, $requete);

        if ($resultat) {
            // Vérifier si l'identifiant existe
            if (mysqli_num_rows($resultat) > 0) {
                $row = mysqli_fetch_assoc($resultat);
                $hash = $row['MotDePasse'];
                $idInscription = $row['IdInscription'];

                // Vérifier si le mot de passe correspond au hash stocké
                if (password_verify($mot_de_passe, $hash)) {
                    echo "<p>Connexion réussie.</p>";
                    //demarrer une session
                    session_start();
                    $_SESSION['idInscription'] = $idInscription;
                    $_SESSION['username'] = $identifiant;
                    // Vous pouvez rediriger l'utilisateur vers une page sécurisée ici
                    header("Location: ../pages/essai.html");
                    exit();
                } else {
                    echo "<p>Mot de passe incorrect.</p>";
                }
            } else {
                echo "<p>L'identifiant n'existe pas.</p>";
            }
        } else {
            echo "<p>Erreur de requête.</p>";
        }
    }
    // Fermeture de la connexion
    mysqli_close($dbd);
?>
