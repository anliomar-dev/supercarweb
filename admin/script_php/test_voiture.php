<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Bootstrap demo</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <!--lien font awsome-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" 
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" 
        crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="../style/marque_admin.css">
    </head>
    <body>
        <div class="container-fluid border">
            <div class="row">
                <?php
                    include("fonctions.php");
                    include("server.php");
                    $selection = "SELECT * FROM voitures order by IdVoiture";
                    $curseur = mysqli_query($dbd, $selection);
                    while($row = mysqli_fetch_array($curseur)){
                        $IdVoiture = $row["IdVoiture"];
                        $Couleur = $row["Couleur"];
                        $typemoteur = $row["TypeMoteur"];
                        $Carburant = $row["Carburant"];
                        $Km = $row["Km"];
                        $BoiteVitesse = $row["BoiteVitesse"];
                        echo "
                            <div class='col-12 mt-5'>
                                <div class='row'>
                                    <div class='col-lg-2 col-sm-12' style='background-color: blue;'>$Couleur</div>
                                    <div class='col-lg-2 col-sm-12' style='background-color: cyan;'>$typemoteur</div>
                                    <div class='col-lg-2 col-sm-12' style='background-color: aqua;'>$Carburant</div>
                                    <div class='col-lg-1 col-sm-12' style='background-color: yellowgreen;'>$Km</div>
                                    <div class='col-lg-2 col-sm-12' style='background-color: yellow;'>$BoiteVitesse</div>
                                    <div class='col-lg-2 col-sm-12'>
                                        <form action='modification.php' method='post'>
                                            <button value='$IdVoiture' name='modifier' class=' style='background-color: yellow;'>modifier</button>
                                        </form>
                                    </div>
                                </div>
                            </div>";
                    }
                    mysqli_free_result($curseur);
                    // fermeture de la connexion avec la base de données
                    mysqli_close($dbd);
                ?>
            </div>
        </div>
        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if(isset($_POST['ajouter_marque'])) {
                    inserer();
                } elseif(isset($_POST['supprimer_marque'])) {
                    supprimer();
                }
            }
        ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>