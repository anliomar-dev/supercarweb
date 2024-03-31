<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
    <?php
        include("server.php");
        if(isset($_POST['modifier'])) {
            $idvoiture = $_POST["modifier"];
        }
        $selection = "SELECT * FROM voitures order by IdVoiture";
        $curseur = mysqli_query($dbd, $selection);
        while($row = mysqli_fetch_array($curseur)){
            $IdVoiture = $row["IdVoiture"];
            $Couleur = $row["Couleur"];
            $typemoteur = $row["TypeMoteur"];
            $Carburant = $row["Carburant"];
            $Km = $row["Km"];
            $BoiteVitesse = $row["BoiteVitesse"];    
        }
        mysqli_free_result($curseur);
        // fermeture de la connexion avec la base de données
        mysqli_close($dbd);
    ?>
    <div class='container'>
        <div class='row'>
            <div class='col-lg-4 col-sm-12' style='background-color: blue;'>
                <div class='row'>
                    <?php
                    include("server.php");
                    if(isset($_POST['modifier'])) {
                        $idvoiture = $_POST["modifier"];
                    }
                    $selection = "SELECT * FROM voitures WHERE IdVoiture='$idvoiture'";
                    $curseur = mysqli_query($dbd, $selection);
                    while($row = mysqli_fetch_array($curseur)){
                        $IdVoiture = $row["IdVoiture"];
                        $Couleur = $row["Couleur"];
                        $typemoteur = $row["TypeMoteur"];
                        $Carburant = $row["Carburant"];
                        $Km = $row["Km"];
                        $BoiteVitesse = $row["BoiteVitesse"];
                    }
                        echo "
                            <div class='col-12 mt-5'>
                                <div class='row'>
                                    <div class='col-lg-2 col-sm-12' style='background-color: blue;'>$Couleur</div>
                                    <div class='col-lg-2 col-sm-12' style='background-color: cyan;'>$typemoteur</div>
                                    <div class='col-lg-2 col-sm-12' style='background-color: aqua;'>$Carburant</div>
                                    <div class='col-lg-1 col-sm-12' style='background-color: yellowgreen;'>$Km</div>
                                    <div class='col-lg-2 col-sm-12' style='background-color: yellow;'>$BoiteVitesse</div>
                                </div>
                            </div>";
                        mysqli_free_result($curseur);
                        // fermeture de la connexion avec la base de données
                        mysqli_close($dbd);
                    ?>
                </div>
            </div>
            <form class='col-' action='' method='post'>
                <div class='row'>
                    <div class='col-12'>
                        <input  type='text' name='typemoteur' palceholer='coul'>
                    </div>
                    <div class='col-12'>
                        <input  type='text' name='carburant'>
                    </div>
                    <div class='col-4'>
                        <input  type='number' min='1' name='km'>
                    </div>
                    <div class='col-18'>
                        <input  type='text' name='boitevitesse'>
                    </div>
                    <input  type='submit' name='modifiervoiture' style='background-color: yellow;'>
                </div>
            </form>
        </div>
    </div>
</body>
</html>