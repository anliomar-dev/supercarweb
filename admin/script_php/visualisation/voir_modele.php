<?php
    include("../fonctions.php");
    verifierAuthentification("../index.php", "../session_expire.html");
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST['deconnexion'])) {
            se_deconnecter("../connection_admin.html");
        }
    }
    if(isset($_GET["IdModele"])){
        $IdModele = $_GET["IdModele"];
        $selection = "SELECT * FROM modele WHERE IdModele = $IdModele;";
        $curseur = mysqli_query($dbd, $selection);
        if($row = mysqli_fetch_array($curseur)){
            $IdModele = $row["IdModele"];
            $NomModele = $row["NomModele"];
            $Prix = $row["Prix"];
            $Annee = $row["Annee"];        }
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
        <title><?php echo"Voiture n° $IdModele"?></title>
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
                            <a class="nav-link" href="visualiser_modeles.php">Tous les modeles</a>
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
        <div class="container mt-5">
            <div class="row">
                <div class="col-12 col-sm-12 col-lg-12 mt-3">
                    <div class="row">
                        <div class="col-12"><h3><?php echo $NomModele; ?></h3></div>
                        <div class="col-12"><hr></div>
                            <div class="row">
                            <div class="col-12 p-3">
                                    <div class="row">
                                        <div class="col-5">Prix:</div>
                                        <div class="col-7"><strong><?php echo $Prix; ?></strong></div>
                                    </div>
                                </div>
                                <div class="col-12 p-3">
                                    <div class="row">
                                        <div class="col-5">Année:</div>
                                        <div class="col-7"><strong><?php echo $Annee; ?></strong></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>
    </body>
</html>