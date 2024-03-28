<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="../stylesheet/marques.css">
        <title>modeles</title>
    </head>
    <body>
        <div class="container voitures mt-5">
            <?php
                include("server.php");
                $selectionner = "SELECT * FROM modele order by IdModele";
                $curseur = mysqli_query($dbd, $selectionner);
                while($row = mysqli_fetch_array($curseur)){
                    $idmodele = $row["IdModele"];
                    $nomModele = $row["NomModele"];
                    $prix = $row["Prix"];
                    echo'<div class="row">';
                        echo"<div class='col-sm-12 col-md-12 col-lg-5 d-flex justify-content-center align-items-center'>";
                            echo'<div class="row text-center bg-primary">';
                                echo"<div class='col-12 pt-3'><h4>Modèle : $nomModele</h4></div>";
                                echo'<div class="col-12 text-center"><p>Année: 2014</p></div>';
                                echo"<div class='col-12 text-center'><p>Prix: $prix</p></div>";
                                echo'<div class="col-12 text-center"><p>Vitesse maximal: 232 km/h</p></div>';
                                echo'<div class="col-12 text-center"><h6><a href="ESSAI.HTML">Essayer</a></h6></div>';
                            echo"</div>";
                        echo"</div>";
                        echo'<div class="col-sm-12 col-md-12 col-lg-7 img-voiture">';
                            echo'<img src="../../images/ferrari/ferrari_812.webp" class="img-fluid d-block w-100" alt="...">';
                        echo"</div>";
                    echo"</div>"; 
                    echo "<br><br>";
                }
                mysqli_free_result($curseur);
                // fermeture de la connexion avec la base de données
                mysqli_close($dbd);
            ?>
            <!--<div class="row">
                <div class="col-sm-12 col-md-12 col-lg-5 d-flex justify-content-center align-items-center">
                    <div class="row text-center">
                        <div class="col-12 pt-3"><h4>Modèle : Porsche - Macan</h4></div>
                        <div class="col-12 text-center"><p>Année: 2014</p></div>
                        <div class="col-12 text-center"><p>Prix: 59 293 €</p></div>
                        <div class="col-12 text-center"><p>Vitesse maximal: 232 km/h</p></div>
                        <div class="col-12 text-center"><p>moteur: 2.0-litre inline four-cylinder turbo engine (moteur à combustion)</p></div>
                        <div class="col-12 text-center"><h6><a href="ESSAI.HTML">Essayer</a></h6></div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-7 img-voiture">
                    <img src="../images/images/macancar.avif" class="d-block w-100" alt="...">
                </div>
            </div>-->
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>