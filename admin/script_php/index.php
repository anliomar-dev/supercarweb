<?php
    include("fonctions.php");
    verifierAuthentification("connection_admin.html", "session_expire.html");
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST['deconnexion'])) {
            se_deconnecter("connection_admin.html");
        }
    }
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Dashboard</title>
        <!--cdn bootstrap-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <!--lien font awsome-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" 
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" 
        crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="../style/dashboard.css">
    </head>
    <style>
        a{
            color: black;
            text-decoration: none;
        }
    </style>
    <body>
        <div class="container-fluid text-center entete sticky-top">
            <div class="row">
                <div class="col"><p>Supercar administration</p></div>
            </div>
        </div>
        <div class="container-fluid border">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-8 text-center right">
                    <div class="row">
                        <div class="col-12 border mb-3 bienvenue"><h3>Bienvenue <strong style="color: green;"><?php echo 'Admin( '. $_SESSION['username']. ')';  ?>  <span><i class="fa-solid fa-circle" style="color: #23e00b;"></i></span></strong></h3></div>
                        <div class="col-12 col-lg-4 mb-3">
                            <div class="row right-links">
                            <div class="col-12 h4" style="background-color: #4A7696; color: white">voir le site</div>
                            <div class="col-12 col-sm-4 col-md-4 col-lg-12 mt-5 mb-5"><a href="../../pages/index.php
                            " class="bg-primary" target="_blank">Voir le site</a></div>
                            <div class="col-12 h4" style="background-color: #4A7696; color: white;">Compte</div>
                                <div class="col-12 col-sm-4 col-md-4 col-lg-12 mt-5 mb-5"><form action="" method="POST"><button class="btn btn-primary" name="deconnexion" type="submit">Se deconnecter</button></form></div>
                                <div class="col-12 col-sm-4 col-md-4 col-lg-12 mt-5 mb-5"><a href="" class="bg-primary" >modifier passe</a></div>
                                <div class="col-12 col-sm-4 col-md-4 col-lg-12 mt-5 mb-5"><a href="donnees_admin.php?IdAdmin=<?php echo $_SESSION['idIAdmin'];?>" class="bg-primary" >mes données</a></div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-8 border">
                            <div class="row">
                            <div class="col-12 border h4" style="background-color: #4A7696; color: white;">Visualisation</div>
                                <div class="col-12 p-3 mt-5 border text-bg-info"><a href="visualisation/visualiser_essaie.php">demandes d'essais</a></div>
                                <div class="col-12 p-3 mt-5 border text-bg-info"><a href="visualisation/visualier_evenement.php">voir les evenements</a></div>
                                <div class="col-12 p-3 mt-5 border text-bg-info"><a href="visualisation/visualiser_modeles.php">voir les modèles</a></div>
                                <div class="col-12 p-3 mt-5 border text-bg-info"><a href="visualisation/visualiser_voitures.php">voir les voitures</a></div>
                                <div class="col-12 p-3 mt-5 border text-bg-info"><a href="">Statistiques</a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-12 col-lg-4 border pt-3 px-5 left" style="height: 100vh">
                    <div class="row">
                        <div class="col-12 p-3">
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12 titre-h4">
                                            <h4>Authetification et authorisation</h4>
                                        </div>
                                        <div class="col-12 pt-3 border d-flex justify-content-between px-3">
                                            <p class="users">Utilisateurs</p>
                                            <a href="">➕add</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mt-3">
                                    <div class="row">
                                        <div class="col-12 titre-h4">
                                            <h4>Tables</h4>
                                        </div>
                                        <div class="col-12 pt-3 border d-flex justify-content-between px-3">
                                            <p class="table">Acceui</p>
                                            <a href="crud/acceuil_admin.php">📝</a>
                                        </div>
                                        <div class="col-12 pt-3 border d-flex justify-content-between px-3">
                                            <p class="table">voitures</p>
                                            <a href="crud/voitures_admin.php">➕add</a>
                                        </div>
                                        <div class="col-12 pt-3 border d-flex justify-content-between px-3">
                                            <p class="table">Modèles</p>
                                            <a href="crud/modele_admin.php">➕add</a>
                                        </div>
                                        <div class="col-12 pt-3 border d-flex justify-content-between px-3">
                                            <p class="table">Marques</p>
                                            <a href="crud/marque_admin.php">➕add</a>
                                        </div>
                                        <div class="col-12 pt-3 border d-flex justify-content-between px-3">
                                            <p class="table">Inscriptions</p>
                                            <a href="crud/inscrits.php">➕add</a>
                                        </div>
                                        <div class="col-12 pt-3 border d-flex justify-content-between px-3">
                                            <p class="table">Contacts</p>
                                            <a href="crud/contacts_admin.php">➕add</a>
                                        </div>
                                        <div class="col-12 pt-3 border d-flex justify-content-between px-3">
                                            <p class="table">evenements</p>
                                            <a href="crud/evenements_admin.php">➕add</a>
                                        </div>
                                        <div class="col-12 pt-3 border d-flex justify-content-between px-3">
                                            <p class="table">demandes d'essais</p>
                                            <a href="crud/essai_admin.php">➕add</a>
                                        </div>
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