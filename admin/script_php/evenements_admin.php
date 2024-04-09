<?php
    include("fonctions.php");
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST['ajouter_evenement'])) {
            nouveau_evenement();
            header("Location: dashboard.php");
            exit;
        } elseif(isset($_POST['supprimer_evenement'])) {
            supprimer('evenement', 'IdEvenement');
            header("Location: dashboard.php");
            exit;
        }
    }                   
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
        <style>
            .formulaire-gauche{
                position: sticky;
                top: 0;
            }
            @media screen and (max-width: 991px){
                .formulaire-gauche{
                position: static;
            }
            }
        </style>
    </head>
    <body>
        <div class="container-fluid border">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-4 border text-bg-info formulaire-gauche" style="height: 100vh">
                    <div class="row">
                        <form action="" method="POST" class="col-12 p-3 mt-5 mb-5" >
                            <div class="row p-3">
                                <div class="col-12">
                                    <label for="theme">Théme:</label>
                                    <input class="col-12 form-control" type="text" name="théme" required>
                                </div>
                                <div class="col-6 pt-3">
                                    <label for="datedebut">Date du début:</label>
                                    <input class="col-12 form-control" type="date" name="DateDebut" required>
                                </div>
                                <div class="col-6 pt-3">
                                    <label for="datefin">Fin:</label>
                                    <input class="col-12 form-control" type="date" name="DateFin" required>
                                </div>
                                <div class="col-6 pt-3">
                                    <label for="image">Image:</label>
                                    <input class="col-12 form-control" type="file"  name="image" required>
                                </div>
                                <div class="col-6 pt-3">
                                    <label for="prix">Prix:</label>
                                    <input class="col-12 form-control" type="number"  min=1 name="Prix" required>
                                </div>
                                <div class="col-12 pt-3">
                                    <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" name="Description" rows="3"></textarea>
                                </div>
                                <div class="col-6 mt-3">
                                    <input type="submit" name="ajouter_evenement" value="ajouter" class="btn btn-primary">
                                </div>
                                <div class="col-6 mt-3">
                                    <input type="reset" class="btn btn-secondary" value="reset">
                                </div>
                            </div>
                        </form>
                        <div class="col-12 ps-5 pt-5">
                            <h5><i class="fa-solid fa-arrow-left"></i><a href="dashboard.php" class="retour">RETOUR</a></h5>
                        </div>
                    </div>
                </div>
                <div class='col-12 col-sm-12 col-md-12 col-lg-8 border text-bg-light' style='background-color: rgb(255, 252, 224);'>
                    <form class='row' action='' method='POST'>
                        <div class="col-12 mb-3 sticky-top text-bg-info">
                            <div class="row">
                                <div class="col-4 border p-3">Thème</div>
                                <div class="col-3 border p-3">Debut</div>
                                <div class="col-3 border p-3">Fin</div>
                                <div class="col-2 border p-3 text-center text-bg-info"><button class="text-bg-info" value="supprimer" name="supprimer_evenement" style="color: white; border: none"><i class="fa-solid fa-trash" style="color: #ff0000;"></i></button></div>
                            </div>
                        </div>
                        <?php
                            $infos_evenements = afficher_infos_evenements();
                            echo $infos_evenements;
                        ?>
                    </form>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>