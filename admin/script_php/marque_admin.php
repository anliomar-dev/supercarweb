<?php
    include("fonctions.php");
    include("server.php");
    $id = [];
    $marque = [];
    $selection = "SELECT * FROM marque order by IdMarque";
    $curseur = mysqli_query($dbd, $selection);
    while($row = mysqli_fetch_array($curseur)){
        $IdMarque = $row["IdMarque"];
        array_push($id, $IdMarque);
        $NomMarque = $row["NomMarque"];
        array_push($marque, $NomMarque);
        //echo "<tr><td class='col-3 border'>$IdMarque.</td><td class='col-6 border'>$NomMarque.</td></tr></br>";
    }
    mysqli_free_result($curseur);
    // fermeture de la connexion avec la base de données
    mysqli_close($dbd);
?>

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
    <body style="background-color: white;">
        <?php
            
        ?>
        <div class="container-fluid border">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-4 border">
                    <div class="row">
                        <form action="" method="POST" class="col-12 p-3 mt-5 mb-5">
                            <label for="nom-marque"><h4 class="marque">Nom de la marque</h4></label><br><br>
                            <input class="col-6" type="text" name="NomMarque" required>
                            <input type="submit" name="ajouter_marque" value="ajouter">
                        </form>
                        <div class="col-12 ps-5 pt-5">
                            <h5><i class="fa-solid fa-arrow-left"></i><a href="dashboard.php">RETOUR</a></h5>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-8 border pt-5">
                    <div class="row">
                        <div class="col-3 border">
                            <div class="row">
                                <div class="col-12">
                                    <h3 class="col-12">ID</h3>
                                    <?php
                                        foreach($id as $x){
                                            echo "<h5>$x</h5><hr>";
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 border">
                            <div class="row">
                                <div class="col-12">
                                    <h3 class="col-12">Marques</h3>
                                    <?php
                                        foreach($marque as $y){
                                            echo "<h5>$y</h5><hr>";
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-3 border">
                            <div class="row">
                                <div class="col-12">
                                    <div class="col-12 text-center">
                                        <form action="" method="POST">
                                            <h4 class="col-12">
                                                <input type="submit" value="supprimer" name="supprimer_marque" style="background-color: red; color: white;">
                                            </h4>
                                            <?php
                                                foreach($id as $x){
                                                    echo "<input type='checkbox' name='IdMarque[]' value=$x><hr>";
                                                }
                                            ?>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if(isset($_POST['ajouter_marque'])) {
                    inserer('marque', ['NomMarque',]);
                } elseif(isset($_POST['supprimer_marque'])) {
                    supprimer('marque', 'IdMarque');
                }
            }
        ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>