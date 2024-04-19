<?php
    include("fonctions.php");
    verifierAuthentification("index.php", "session_expire.html");
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST['deconnexion'])) {
            se_deconnecter("connection_admin.html");
        }
    }
    if(isset($_GET["IdAdmin"])){
        $IdAdmin = $_GET["IdAdmin"];
        //affichage de tous les demandes d'essais en faisant une jointure entre la table demandeessai et la table inscription
        global $dbd;
        $selection = "SELECT * FROM admin WHERE IdAdmin = $IdAdmin;";
        $curseur = mysqli_query($dbd, $selection);
        if($row = mysqli_fetch_array($curseur)){
            $Nom = $row["Nom"];
            $Prenom = $row["Prenom"];
            $email = $row["email"];
            $Telephone = $row["Telephone"];
            $Identifiant = $row["Identifiant"];
        }
        mysqli_free_result($curseur);
    }
    if (isset($_POST["modifier_passe"])) {
        $mot_de_passe = mysqli_real_escape_string($dbd, $_POST["mot_de_passe"]);
        $confirmer_passe = mysqli_real_escape_string($dbd, $_POST["confirmer_passe"]);
        $Email = mysqli_real_escape_string($dbd, $_POST['email']);
        
        if ($Email == $email) {
            if ($mot_de_passe == $confirmer_passe) {
                $hash = password_hash($mot_de_passe, PASSWORD_DEFAULT);
                
                // Update query with WHERE clause to update specific row
                $modifier = "UPDATE admin SET MotDePasse = '$hash' WHERE Email = '$Email'";
                mysqli_query($dbd, $modifier);
                
                if(mysqli_affected_rows($dbd) > 0) {
                    echo "<p>Vos données ont été mises à jour avec succès.</p>";
                } else {
                    echo "<p>Erreur lors de la mise à jour du mot de passe.</p>";
                }
            } else {
                echo "<script>alert('Les deux mots de passe doivent être identiques.');</script>";
            }
        } else {
            echo "<script>alert('Email invalide.');</script>";
        }
    }
    
    // Fermeture de la connexion
    mysqli_close($dbd);
    
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!--cdn bootstrap-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <!--lien font awsome-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" 
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" 
        crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="../style/dashboard.css">
        <title><?php echo 'Données Admin('. $_SESSION['username'].')';?></title>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top" id="header">
            <div class="container-fluid">
                <div class="navbar-brand">
                    <img src="../images/logo.png" alt="">
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarText">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 text-center navmenu">
                        <li class="nav-item">
                            <div class="nav-link" href="visualiser_essaie.php">Connecté en tant que: <strong><?php echo 'Admin( '. $_SESSION['username']. ')';  ?>  <span><i class="fa-solid fa-circle" style="color: #23e00b;"></i></span></strong></div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Dashboard</a>
                        </li>
                    </ul>
                    <span class="navbar-text">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0 text-center">
                            <li class="nav-item">
                                <form action="" method="POST">
                                    <button class="btn btn-primary" name="deconnexion" type="submit">Se deconnecter</button></
                                </form>
                            </li>
                        </ul>
                    </span>
                </div>
            </div>
        </nav>
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-6 mt-5 p-5 border mx-3" style="border-radius: 10px;">
                    <div class="row">
                        <div class=" mb-5 text-center"><h3><u>Mes donées</u></h3></div>
                        <div class=" col-sm-4 com-md-4 col-lg-4 py-3">Prenom:</div>
                        <div class=" col-sm-8 com-md-8 col-lg-8 py-3"><strong><?php echo $Prenom;?></strong></div>
                        <div class=" col-sm-4 com-md-4 col-lg-4 py-3">Nom:</div>
                        <div class=" col-sm-8 com-md-8 col-lg-8 py-3"><strong><?php echo $Nom;?></strong></div>
                        <div class=" col-sm-4 com-md-4 col-lg-4 py-3">Téléphone:</div>
                        <div class=" col-sm-8 com-md-8 col-lg-8 py-3"><strong><?php echo $Telephone;?></strong></div>
                        <div class=" col-sm-4 com-md-4 col-lg-4 py-3">Email:</div>
                        <div class=" col-sm-8 com-md-8 col-lg-8 py-3"><strong><?php echo $email;?></strong></div>
                        <div class=" col-sm-4 com-md-4 col-lg-4 py-3">Identifiant:</div>
                        <div class=" col-sm-8 com-md-8 col-lg-8 py-3"><strong><?php echo $Identifiant;?></strong></div>
                    </div>
                </div>
                <div class="col-12 col-lg-5 mt-5 mx-3 border p-5 text-bg-info" style="border-radius: 10px;">
                    <form class="row" action="" method="POST">
                        <h5 class="col-12 text-center p-3">changez votre mot de passe</h5>
                        <div class="col-12 p-3">
                            <input type="email" class="form-control" name="email" placeholder="veuillez saisir votre email">
                        </div>
                        <div class="col-12 p-3">
                            <input type="password" class="form-control" name="mot_de_passe" placeholder="nouveau mot de passe">
                        </div>
                        <div class="col-12 p-3">
                            <input type="password" class="form-control" name="confirmer_passe" placeholder="confirmez le mot de passe">
                        </div>
                        <div class="col-12 mx-3">
                            <input type="submit" class="btn btn-primary" name="modifier_passe" value="modifier">
                            <input type="reset" class="btn btn-secondary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>
    </body>
</html>