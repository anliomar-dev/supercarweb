<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>contact insertion</title>
</head>
<body>
    <?php
        include("connexion.php");
        $prenom = $_POST["prenom"];
        $nom = $_POST["nom"];
        $email = $_POST["email"];
        $telephone = $_POST["telephone"];
        
        $insert = "INSERT INTO contacts (Nom, Prenom, email, NumTel) VALUES ('$nom', '$prenom', '$email', '$telephone')";

        mysqli_query($dbd, $insert);

        
        // Vérifier si l'insertion a réussi
        if(mysqli_affected_rows($dbd) > 0) {
            echo "<p>Vos données ont été insérées avec succès.</p>";
        } else {
            echo "<p>Erreur d'insertion.</p>";
        }

        // Fermeture de la connexion
        mysqli_close($dbd);
    ?>
</body>
</html>
