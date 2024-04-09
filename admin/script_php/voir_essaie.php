<?php
    include("server.php");
    if(isset($_GET["Ref"])){
        $Ref_Essaie = $_GET["Ref"];
        //affichage de tous les demandes d'essais en faisant une jointure entre la table demandeessai et la table inscription
        global $dbd;
        $selection = "SELECT demandeessaie.*, inscription.Nom, inscription.Prenom, inscription.Adresse, inscription.NumTel,
        inscription.email, modele.NomModele, modele.Prix, modele.Annee, marque.NomMarque
        FROM demandeessaie 
        INNER JOIN inscription ON demandeessaie.IdInscription = inscription.IdInscription
        INNER JOIN modele ON demandeessaie.Modele = modele.IdModele
        INNER JOIN marque ON demandeessaie.Marque = marque.IdMarque
        WHERE Ref_Essaie = $Ref_Essaie;
        ";
        $curseur = mysqli_query($dbd, $selection);
        if($row = mysqli_fetch_array($curseur)){
            $Ref_Essaie = $row["Ref_Essaie"];
            $IdInscription = $row["IdInscription"];
            $DateEssaie= $row["DateEssaie"];
            $HeureEssaie = $row["HeureEssaie"];
            $Marque = $row["Marque"];
            $Modele = $row["Modele"];
            $Moteur = $row["Moteur"];
            $Prenom = $row["Prenom"];
            $Nom = $row["Nom"];
            $Adresse = $row["Adresse"];
            $NumTel = $row["NumTel"];
            $email = $row["email"];
            $Nom_modele = $row["NomModele"];
            $prix_modele = $row["Prix"];
            $Annee_modele = $row["Annee"];
            $Nom_marque = $row["NomMarque"];
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
        <title><?php echo"Essaie n°$Ref_Essaie";?></title>
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
                            <div class="nav-link" href="visualiser_essaie.php">Connecté en tant que: Admin</div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="dashboard.php">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="visualiser_essaie.php">Tous les essaies</a>
                        </li>
                    </ul>
                    <span class="navbar-text">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0 text-center">
                            <li class="nav-item">
                                <a class="nav-link" href="login.html">Se Deconnecter</a>
                            </li>
                        </ul>
                    </span>
                </div>
            </div>
        </nav>
        <h1 class="text-center">Essaie de <?php echo"$Prenom $Nom";?></h1>
        <div class="container">
            <div class="row border">
                <div class="col-12 col-md-12 col-lg-6 mt-3 p-5">
                    <div class="row">
                        <div class="col-12 mb-5"><h3><u>informations le demandeur d'essaie</u></h3></div>
                        <div class="col-3 py-3">Prenom:</div>
                        <div class="col-8 py-3"><strong><?php echo $Prenom;?></strong></div>
                        <div class="col-3 py-3">Nom:</div>
                        <div class="col-8 py-3"><strong><?php echo $Nom;?></strong></div>
                        <div class="col-3 py-3">Adresse:</div>
                        <div class="col-8 py-3"><strong><?php echo $Adresse;?></strong></div>
                        <div class="col-3 py-3">Téléphone:</div>
                        <div class="col-8 py-3"><strong><?php echo $NumTel;?></strong></div>
                        <div class="col-3 py-3">Email:</div>
                        <div class="col-8 py-3"><strong><?php echo $email;?></strong></div>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-6 border">
                    <div class="row">
                        <div class="col-12 text-center">
                            <div class="row">
                                <div class="col-12 p-3"><h3><u>MARQUE</u></h3></div>
                                <div class="col-12 h4"><strong><?php echo $Nom_marque;?></strong></div>
                                <div class="col-12"><hr></div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-12 p-3 text-center"><h3><u>MODELE</u></h3></div>
                                <div class="col-3 py-3 px-5">MODELE:</div>
                                <div class="col-8 mb-3 py-3 px-5 text-end"><strong><?php echo $Nom_modele;?></strong></div>
                                <div class="col-3 py-3 px-5">PRIX:</div>
                                <div class="col-8 mb-3 py-3 px-5 text-end"><strong>€ <?php echo $prix_modele;?></strong></div>
                                <div class="col-3 py-3 px-5">ANNEE:</div>
                                <div class="col-8 mb-3 py-3 px-5 text-end"><strong><?php echo $Annee_modele;?></strong></div>
                                <div class="col-12 mb-3 py-3 px-5">
                                    <div class="row">
                                        <div class="col-3">Date de l'essaie</div>
                                        <div class="col-8 text-end"><strong><?php echo $DateEssaie;?></strong></div>
                                        <div class="col-3">Heure de l'essaie</div>
                                        <div class="col-8 text-end"><strong><?php echo $HeureEssaie;?></strong></div>
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