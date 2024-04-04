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
            .formulaire_modele{
                position: sticky;
                top: 0;
            }
            @media screen and (max-width: 991px){
                .formulaire_modele{
                position: static;
            }
            }
        </style>
    </head>
    <body>
        <div class="container-fluid border">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-4 border formulaire_modele" style="height: 100vh">
                    <div class="row">
                        <form action="" method="POST" class="col-12 p-3 mt-5 mb-5">
                            <div class="row p-3 border bg-primary">
                                <div class="col-12">
                                    <label for="nom-marque">Nom du modele</label>
                                    <input class="col-12" type="text" name="NomModele" required>
                                </div>
                                <div class="col-12">
                                    <label for="nom-marque">Prix</label>
                                    <input class="col-12" type="number" name="Prix" min=1 required>
                                </div>
                                <div class="col-12">
                                    <label for="nom-marque">Marque</label>
                                    <select class="col-12" name="IdMarque" id="">
                                        <?php
                                            include("test.php");
                                            option_marques();
                                        ?>
                                    </select>
                                </div>
                                <div class="col-12 mt-3">
                                    <input type="submit" name="ajouter_modele" value="ajouter">
                                </div>
                            </div>
                        </form>
                        <div class="col-12 ps-5 pt-5">
                            <h5><i class="fa-solid fa-arrow-left"></i><a href="dashboard.php">RETOUR</a></h5>
                        </div>
                    </div>
                </div>
                <div class='col-12 col-sm-12 col-md-12 col-lg-8 border mt-3'>
                    <form class='row' action='' method='post'>
                        <div class="col-12 mb-3 sticky-top" style='background-color: #4A7696;'>
                            <div class="row">
                                <div class="col-4 border">(ID)_Modele</div>
                                <div class="col-6 border">Prix</div>
                                <div class="col-2 border text-center"><button value="supprimer" name="supprimer_modele" style="background-color:  #4A7696; color: white; border: none"><i class="fa-solid fa-trash" style="color: #ff0000;"></i></button></div>
                            </div>
                        </div>
                        <?php
                            afficher_infos_modeles();
                        ?>
                    </form>
                </div>
            </div>
        </div>
        <?php
            include("fonctions.php");
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if(isset($_POST['ajouter_modele'])) {
                    inserer('modele', ['NomModele', 'Prix', 'IdMarque']);
                } elseif(isset($_POST['supprimer_modele'])) {
                    supprimer('modele', 'IdModele');
                }
            }
        ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>