<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" 
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" 
    referrerpolicy="no-referrer"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.min.css">
    <link rel="stylesheet" href="../stylesheet/accueil.css">
    <title>Acceuil</title>
</head>
<body>

    <div class="container-fluid d-flex align-items-center justify-content-between bg-dark" id="header">
        <h6 style="color: #1167eb;">Supercar : Une expérience unique</h6>
        <div class="container-{breakpoint}">
            <a href=""><i class="fa-brands fa-facebook-f p-3"></i></a>
            <a href=""><i class="fa-brands fa-instagram p-3"></i></a>
            <a href=""><i class="fa-brands fa-x-twitter p-3"></i></a>
            <a href=""><i class="fa-brands fa-linkedin-in p-3"></i></a>
        </div>
    </div>

    <nav class="navbar navbar-light shadow bg-white rounded" id="responsive">
        <div class="container-fluid d-flex align-items-center justify-content-between">
            <div></div>
            <a class="navbar-brand" href="#">
                <img id="image" src="../images/logo.png">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 text-center navmenu">
                    <div class="container-{breakpoint} d-flex justify-content-center" id="navbar">
                        <a class="navbar-item nav-link" id="links" href="">Accueil</a>
                        <a class="navbar-item nav-link" id="links" href="voitures.html">Voitures</a>
                        <a class="navbar-item nav-link" id="links" href="evenement.php">Évènements</a>
                        <a class="navbar-item nav-link" id="links" href="DemandeEssaie.php">Demande d'essai</a>
                        <a class="navbar-item nav-link" id="links" href="contact1.html">Contactez-nous</a>
                    </div>
                    <div class="container-{breakpoint}" id="buttons">
                        <a href="signup.html"><button type="button" id="button" class="btn btn-outline-primary mb-2">S'inscrire</button></a>
                        <a href="login.html"><button type="button" id="button" class="btn btn-outline-primary">Connexion</button></a>
                    </div>
                </ul>
            </div>
        </div>
    </nav>

    <nav class="navbar navbar-light shadow bg-white rounded" id="no_responsive">
        <div class="container-fluid d-flex align-items-center justify-content-between">
            <a class="navbar-brand" href="#">
            <img src="../images/logo.png" >
            </a>
            <div class="container-{breakpoint} d-flex justify-content-center" id="navbar">
                <a class="navbar-item nav-link" id="links" href="">Accueil</a>
                <a class="navbar-item nav-link" id="links" href="voitures.html">Voitures</a>
                <a class="navbar-item nav-link" id="links" href="evenement.php">Évènements</a>
                <a class="navbar-item nav-link" id="links" href="DemandeEssaie.php">Demande d'essai</a>
                <a class="navbar-item nav-link" id="links" href="contact1.html">Contactez-nous</a>
            </div>
            <div class="container-{breakpoint}" id="buttons">
                <a href="signup.html"><button type="button" id="button" class="btn btn-outline-primary">S'inscrire</button></a>
                <a href="login.html"><button type="button" id="button" class="btn btn-outline-primary">Connexion</button></a>
            </div>
        </div>
    </nav>

    <?php
        include("../database/connexion.php");
        $selection = "SELECT TitreVideo, Video, Lien FROM acceuil WHERE ID = 1;";
        $curseur = mysqli_query($dbd, $selection);
		while($row = mysqli_fetch_array($curseur)) {	
            $video = $row["Video"];
            $titre = $row["TitreVideo"];
            $lien = $row["Lien"];
    ?>

    <div id="video">
        <video class="img-fluid" autoplay loop muted>
            <source src="<?php echo $video ?>" type="video/mp4" />
        </video>
        <div class="text-white" id="titre">
            <h1><?php echo $titre ?></h1>
            <a href="<?php echo $lien ?>"><button id="discover">Découvrir dés maintenant</button></a>
        </div>
    </div>

    <?php
        }
        mysqli_free_result($curseur);
        mysqli_close($dbd);
    ?>

    <div class="container-fluid mb-5">
        <div class="d-flex justify-content-center mb-4">
            <h2><u>Que recherchez-vous ?</u></h2>
        </div>
        <div class="d-flex align-items-center justify-content-around" id="outils">
            <div class="container d-flex flex-column align-items-center justify-content-center">
                <i class="ri-calendar-todo-line"></i>
                <a href="evenement.php" target="_blank"><button>Voir les évènements</button></a>
            </div>
            <div class="container d-flex flex-column align-items-center justify-content-center">
                <i class="ri-steering-fill"></i>
                <a href="DemandeEssaie.php" target="_blank"><button>Réservez un essai</button></a>
            </div>
            <div class="container d-flex flex-column align-items-center justify-content-center">
                <i class="ri-contacts-book-line"></i>
                <a href="contact1.html" target="_blank"><button>Contactez-nous</button></a>
            </div>
        </div>
    </div>


    <div class="container-fluid">
        <div class="d-flex justify-content-center mb-4">
            <h2><u>Profitez-vous</u></h2>
        </div>
        <div class="row">
            <?php
                include("../database/connexion.php");
                $selection = "SELECT CadreModele, CadreImg, CadrePollution, CadrePrix, CadreLien FROM acceuil WHERE ID BETWEEN 2 AND 3;";
                $curseur = mysqli_query($dbd, $selection);
                while ($row = mysqli_fetch_array($curseur)) {
                    $cadremodele = $row["CadreModele"];
                    $cadreimg = $row["CadreImg"];
                    $cadrepollution = $row["CadrePollution"];
                    $cadreprix = $row["CadrePrix"];
                    $cadrelien = $row["CadreLien"];
            ?>
            <div class="col-12 m-0 p-0 mb-5 position-relative" id="card">
                <img style="width:100%" src="<?php echo $cadreimg ?>">
                <div id="title" >
                    <h3 class="mb-3"><?php echo $cadremodele ?></h3>
                    <h4 class="mb-4"><?php echo $cadreprix ?> € </h4>
                    <a href="<?php echo $cadrelien ?>"><button id="discover">Découvrir dés maintenant</button></a>
                </div>
                <img class="card-img-overlay position-absolute h-25" id="co2" src="<?php echo $cadrepollution?>">
            </div>
            <?php
                }
                mysqli_close($dbd);
            ?>
        </div>
    </div>
    <h2 class="text-center"><u>Actualités</u></h2>
    <div class="container-fluid d-flex align-items-center justify-content-around mt-4 mb-5" id="actualite">
        <?php
            include("../database/connexion.php");
            $selection = "SELECT ActualiteImg, ActualiteDescription, ActualiteLink FROM acceuil WHERE ID BETWEEN 4 AND 6;";
            $curseur = mysqli_query($dbd, $selection);
            while ($row = mysqli_fetch_array($curseur)) {
                $actualiteimg = $row["ActualiteImg"];
                $description = $row["ActualiteDescription"];
                $link = $row["ActualiteLink"];
        ?>
        <div class="card rounded-sm border border-info" id="imghover" style="width: 30rem;">
            <a href="<?php echo $link?>" class="text-decoration-none">
            <img class="card-img-top" src="<?php echo $actualiteimg?>">
            <div class="card-body">
                <p class="card-text text-center text-dark "><?php echo $description?></p>
            </div></a>
        </div>
        <?php
            }
            mysqli_close($dbd);
        ?>
    </div>
    <footer class="d-flex align-items-center justify-content-center text-white mt-5" style="background-color: black; padding: 20px;">
        <div class="container-fluid d-flex flex-column align-items-center justify-content-center">
            <p style="font-weight: 600; font-size: 17px;" id="propos">À PROPOS DE NOUS</p>
            <div class="container-{breakpoint} d-flex flex-column align-items-center justify-content-center">
                <a class="mb-2" id="link_footer">Arborescence</a>
                <a id="link_footer">Mentions légales</a>
            </div>
            <div class="container-fluid d-flex align-items-center justify-content-center mt-3" style="border-bottom: solid 1px white; border-top: solid 1px white; width: 90%;">
                <p class="mt-3"><strong>© 2024 SUPERCAR</strong></p>
            </div>
        </div>
    </footer>
</body>
</html>