<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../stylesheet/evenement.css">
    <link rel="stylesheet" href="../stylesheet/navbar.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" 
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" 
    referrerpolicy="no-referrer"/>
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
                        <a class="navbar-item nav-link" id="links" href="accueil.php">Accueil</a>
                        <a class="navbar-item nav-link" id="links" href="voitures.html">Voitures</a>
                        <a class="navbar-item nav-link" id="links" href="evenement.php">Évènements</a>
                        <a class="navbar-item nav-link" id="links" href="DemandeEssai.php">Demande d'essai</a>
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
                <a class="navbar-item nav-link" id="links" href="accueil.php">Accueil</a>
                <a class="navbar-item nav-link" id="links" href="voitures.html">Voitures</a>
                <a class="navbar-item nav-link" id="links" href="evenement.php">Évènements</a>
                <a class="navbar-item nav-link" id="links" href="DemandeEssaie.php">Demande d'essai</a>
                <a class="navbar-item nav-link" id="links" href="contact1.html">Contactez-nous</a>
            </div>
            <div class="container-{breakpoint}" id="buttons">
                <a href="signup.html"><button type="button" id="button" class="btn btn-outline-primary mb-2">S'inscrire</button></a>
                <a href="login.html"><button type="button" id="button" class="btn btn-outline-primary">Connexion</button></a>
            </div>
        </div>
    </nav>

    <?php
        include ("../database/connexion.php");
        $selection = "SELECT * FROM evenement ORDER BY DateDebut;";
        $curseur = mysqli_query($dbd, $selection);
        while($row = mysqli_fetch_array($curseur)) {
            $location = $row["location"];
            $theme= $row["théme"];
            $debut = $row["DateDebut"];
            $fin = $row["DateFin"];
            $prix = $row["Prix"];
            $image = $row["image"];
            $description = $row["Description"]
    ?>

    <div class="d-flex flex-column align-items-center justify-content-center">
        <h4 class="mt-5">
            <?php echo $theme;                    
                if ($fin == "0000-00-00") {
                    echo " (",$debut,")";
                } else {
                    echo " (",$debut," à ",$fin,")";
                }
            ?>
        </h4>
        <div class="card mb-5 mt-4" style="width: 45rem; border: 1px solid red;">
            <img class="card-img" style="border-bottom: 1px solid red;" src=../admin/images/evenements_images/<?php echo $image;?> alt="Card image">
            <div class="card-body" style="background-color:#FFFFF9;">
                <h3 class="card-text text-center"><i class="ri-map-pin-2-line"></i><?php echo $location;?></h3>
                <p class="card-text text-center">
                    <?php
                        if ($fin == "0000-00-00") {
                            echo $debut;
                        } else {
                            echo $debut,"-",$fin;
                        }
                    ?>
                </p>
                <p class="card-text text-center">
                    <?php
                        if ($prix == 0) {
                            echo "GRATUIT";
                        } else {
                            echo "À partir de ", $prix ," €";
                        }
                    ?>
                </p>
                <p class="card-text text-center"><small class="text-muted text-white"><?php echo $theme; ?></small></p>
                <p class="card-text" style="text-align:justify;"><?php echo $description; ?></p>
            </div>
        </div>
    </div>

    <?php
        }
        mysqli_free_result($curseur);
        mysqli_close($dbd);
    ?>

    <footer class="d-flex align-items-center justify-content-center text-white mt-5" style="background-color: black; padding: 20px;">
        <div class="container-fluid d-flex flex-column align-items-center justify-content-center">
            <p style="font-weight: 600; font-size: 17px;" id="propos">À PROPOS DE NOUS</p>
            <div class="container-{breakpoint} d-flex flex-column align-items-center justify-content-center">
                <a class="mb-2" id="link_footer">Arborescence</a>
                <a id="link_footer" href="mentionslegales.html">Mentions légales</a>
            </div>
            <div class="container-fluid d-flex align-items-center justify-content-center mt-3" style="border-bottom: solid 1px white; border-top: solid 1px white; width: 90%;">
                <p class="mt-3"><strong>© 2024 SUPERCAR</strong></p>
            </div>
        </div>
    </footer>
        <script src="../script/script.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>