<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>inscription insertion</title>
</head>
<body>
    <?php
        include("connexion.php");
        //si le bouton [submit] est pressé, on affect les valeurs remplient sur le formulaire aux variables correpondants
        if (isset($_POST["submit"])){
            $nom = $_POST["nom"];
            $prenom = $_POST["prenom"];
            $adresse = $_POST["adresse"];
            $telephone = $_POST["telephone"];
            $email = $_POST["email"];
            $identifiant = $_POST["identifiant"];
            $mot_de_passe = $_POST["mot_de_passe"];
            $confirme_pass = $_POST["confirme_pass"];
            // Supposons que l'identifiant soit stocké dans une variable $identifiant
            $identifiant = mysqli_real_escape_string($dbd, $_POST['identifiant']);
            // Supposons que l'adresse email soit stocké dans une variable $Email
            $Email = mysqli_real_escape_string($dbd, $_POST['email']);
            // Vérifier si l'identifiant existe déjà
            $requete_identifiant = "SELECT * FROM inscription WHERE Identifiant = '$identifiant'";
             // Vérifier si l'adresse email existe déjà
            $requete_email = "SELECT * FROM inscription WHERE email = '$Email'";
            //on éxécute la requete pour l'identifiant
            $result_identifiant = mysqli_query($dbd, $requete_identifiant);
            //on éxécute la requete pour l'adrese email
            $result_email = mysqli_query($dbd, $requete_email);
            if (mysqli_num_rows($result_identifiant) > 0) {
                // L'identifiant existe déjà, afficher un message d'erreur
                echo "Cet identifiant est déjà utilisé. Choisissez un autre.";
            }
            else if (mysqli_num_rows($result_email) > 0){
                echo"cet adresse email est déja associé à un compte";
            }
            else {
                // L'identifiant n'existe pas, vous pouvez procéder à l'inscription
                if ($mot_de_passe != $confirme_pass){
                    // Envoie du code JavaScript pour afficher une alerte
                    //echo '<script type="text/javascript">alert("les mot de passe saisis dans les deux champs doivnet être identique");</script>';
                }else{
                    $hash = password_hash($mot_de_passe, PASSWORD_DEFAULT);
                    $inserer = "INSERT INTO inscription (Nom, Prenom, Adresse, NumTel, email, Identifiant, MotDePasse) 
                    VALUES ('$nom', '$prenom', '$adresse', '$telephone', '$email', '$identifiant', '$hash')";
                    mysqli_query($dbd, $inserer);
                    // Vérifier si l'insertion a réussi
                    if(mysqli_affected_rows($dbd) > 0){
                        echo "<p>Vos données ont été insérées avec succès.</p>";
                        $id_inscription =  mysqli_insert_id($dbd);
                        // Maintenant, insérez les données dans la table connexion en utilisant les valeurs de la table inscription
                        $inserer_connexion = "INSERT INTO connexion (Identifiant, MotDePasse, IdInscription) 
                        VALUES ('$identifiant', '$hash', $id_inscription)";
                        mysqli_query($dbd, $inserer_connexion);
                        // Vérifiez si l'insertion dans la table connexion a réussi
                        if (mysqli_affected_rows($dbd) > 0) {
                        echo "<p>Vos données ont été insérées avec succès.</p>";
                        } else {
                        echo "<p>Erreur d'insertion dans la table connexion.</p>";
                        }
                    } else {
                        echo "<p>Erreur d'insertion dans la table inscription.</p>";
                    }
                }                                                 
            } 
        }
        // Fermeture de la connexion
        mysqli_close($dbd);
    ?>
</body>
</html>
