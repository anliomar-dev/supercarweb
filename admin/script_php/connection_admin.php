<?php
include("server.php");
    $_SESSION['idIAdmin'] = '';
    $_SESSION['username'] = '';
    // Fonction pour vérifier l'authentification de l'utilisateur
    function Authentification($dbd, $identifiant, $mot_de_passe) {
        // Requête préparée pour récupérer le mot de passe associé à l'identifiant
        $requete = "SELECT MotDePasse, IdAdmin FROM admin WHERE Identifiant = ?";
        $statement = mysqli_prepare($dbd, $requete);
        mysqli_stmt_bind_param($statement, "s", $identifiant);
        mysqli_stmt_execute($statement);
        $resultat = mysqli_stmt_get_result($statement);
        if ($resultat) {
            // Vérifie si l'identifiant existe
            if (mysqli_num_rows($resultat) > 0) {
                $row = mysqli_fetch_assoc($resultat);
                $hash = $row['MotDePasse'];
                $idAdmin = $row['IdAdmin'];
                // Vérifie si le mot de passe correspond au hash stocké
                if (password_verify($mot_de_passe, $hash)) {
                    // Démarrer une session
                    session_start();
                    $_SESSION['idIAdmin'] = $idAdmin;
                    $_SESSION['username'] = $identifiant;
                    return true; // Authentification réussie
                } else {
                    return false; // Mot de passe incorrect
                }
            } else {
                return false; // Identifiant inexistant
            }
        } else {
            return false; // Erreur de requête
        }

    mysqli_stmt_close($statement);
}

// Vérifie si le formulaire a été soumis
if (isset($_POST["submit"])) {
    $identifiant = mysqli_real_escape_string($dbd, $_POST["identifiant"]);
    $mot_de_passe = mysqli_real_escape_string($dbd, $_POST["mot_de_passe"]);;

    if (Authentification($dbd, $identifiant, $mot_de_passe)) {
        session_start();
        header("Location: index.php");
        exit();
    } else {
        echo "<p>Identifiant ou mot de passe incorrect.</p>";
    }
}
// Fermeture de la connexion
mysqli_close($dbd);

?>
