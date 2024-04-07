<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <?php
            include("server.php");
            if(isset($_GET["id"])){
                $IdEvenement = $_GET["id"];
                $selection = "SELECT * FROM evenement order by DateDebut DESC";
                $curseur = mysqli_query($dbd, $selection);
                while($row = mysqli_fetch_array($curseur)){
                    $IdEvenement = $row["IdEvenement"];
                    $theme = $row["théme"];
                    $debut = $row["DateDebut"];
                    $fin = $row["DateFin"];
                    $image = $row["image"];
                    $prix = $row["Prix"];
                    echo "
                        <div class='row'>
                            <div class='col-12 p-3'>$theme</div>
                            <div class='col-6 p-3'>$debut</div>
                            <div class='col-6 p-3'>$fin</div>
                            <div class='col-6'><img src='$image' alt='monimage' class='img-fluid'></div>
                        </div>";
                }
                mysqli_free_result($curseur);
            }
        ?>
    </div>
</body>
</html>