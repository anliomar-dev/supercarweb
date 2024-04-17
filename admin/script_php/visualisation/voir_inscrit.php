<?php
    include("../fonctions.php");
    verifierAuthentification("../index.php", "../session_expire.html");
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST['deconnexion'])) {
            se_deconnecter();
        }
    }
    if(isset($_GET["id"])){
        $IdInscription = $_GET["id"];
        //affichage de tous les demandes d'essais en faisant une jointure entre la table demandeessai et la table inscription
        global $dbd;
        $selection = "SELECT * FROM inscription WHERE IdInscription = $IdInscription;";
        $curseur = mysqli_query($dbd, $selection);
        if($row = mysqli_fetch_array($curseur)){
            $IdInscription = $row["IdInscription"];
            $Nom = $row["Nom"];
            $Prenom = $row["Prenom"];
            $Adresse = $row["Adresse"];
            $NumTel = $row["NumTel"];
            $email = $row["email"];
        }
        mysqli_free_result($curseur);
    }
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
        <title><?php echo"Essaie n°$IdInscription";?></title>
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
                            <a class="nav-link" href="../index.php">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../crud/inscrits.php">Tous les inscriptions</a>
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
        <div class="container" style="max-width: 80vh">
            <div class="row border">
                <div class="col-12 mt-3 p-5">
                    <div class="row">
                        <div class=" mb-5 text-center"><h3><u>informations</u></h3></div>
                        <div class=" col-sm-4 com-md-4 col-lg-4 py-3">Prenom:</div>
                        <div class=" col-sm-8 com-md-8 col-lg-8 py-3"><strong><?php echo $Prenom;?></strong></div>
                        <div class=" col-sm-4 com-md-4 col-lg-4 py-3">Nom:</div>
                        <div class=" col-sm-8 com-md-8 col-lg-8 py-3"><strong><?php echo $Nom;?></strong></div>
                        <div class=" col-sm-4 com-md-4 col-lg-4 py-3">Adresse:</div>
                        <div class=" col-sm-8 com-md-8 col-lg-8 py-3"><strong><?php echo $Adresse;?></strong></div>
                        <div class=" col-sm-4 com-md-4 col-lg-4 py-3">Téléphone:</div>
                        <div class=" col-sm-8 com-md-8 col-lg-8 py-3"><strong><?php echo $NumTel;?></strong></div>
                        <div class=" col-sm-4 com-md-4 col-lg-4 py-3">Email:</div>
                        <div class=" col-sm-8 com-md-8 col-lg-8 py-3"><strong><?php echo $email;?></strong></div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>
    </body>
</html>