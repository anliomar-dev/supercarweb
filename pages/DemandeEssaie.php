
<?php
    include("../admin/script_php/fonctions.php");
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Demande d'essai de voiture</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
        <!--lien font awsome-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" 
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" 
        crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="../stylesheet/ESSAI.CSS">
        <link rel="stylesheet" href="../stylesheet/navbar.CSS">
    </head>
    <body>
        <div class="container-fluid" id="haut">
            <div class="row">
                <div class="col p-3" id="slogan">Supercar : ........ une experience unique</div>
                <div class="col d-flex justify-content-end">
                    <a href=""><i class="fa-brands fa-facebook-f p-3" id="facebook"></i></a>
                    <a href=""><i class="fa-brands fa-instagram p-3"></i></a>
                    <a href=""><i class="fa-brands fa-x-twitter p-3"></i></a>
                    <a href=""><i class="fa-brands fa-linkedin-in p-3"></i></a>
                </div>
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
                            <a class="navbar-item nav-link" id="links" href="index.php">Accueil</a>
                            <a class="navbar-item nav-link" id="links" href="voitures.html">Voitures</a>
                            <a class="navbar-item nav-link" id="links" href="evenement.php">Évènements</a>
                            <a class="navbar-item nav-link" id="links" href="DemandeEssaie.php">Demande d'essai</a>
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
                    <a class="navbar-item nav-link" id="links" href="index.php">Accueil</a>
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
        <div class="container mt-5 border p-3 form" style="max-width: 750px;">
            <h3 class="text-center">Demande d'essai</h3>
            <form action="../database/essaie.php" class="form" method="post">
                <div class="mb-3">
                    <label for="date_essai" class="form-label">Date d'essai</label>
                    <input type="date" class="form-control" id="date_essai" name="date_essai" required>
                </div>
                <div class="mb-3">
                    <label for="heure_essai" class="form-label">Heure d'essai</label>
                    <input type="time" class="form-control" id="heure_essai" name="heure_essai" required>
                </div>
                <div class="col-12 mb-3">
                    <label for="nom-marque">Marque</label>
                        <select class="col-12 form-select" name="IdMarque" id="">
                            <?php
                                $options_marques = option_marques();
                                echo $options_marques; 
                            ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="marque_voiture" class="form-label">moteur:</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="type_voiture" id="thermique" value="thermique" checked>
                        <label class="form-check-label" for="thermique">thermique</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="type_voiture" id="electrique" value="electrique">
                        <label class="form-check-label" for="electrique">electrique</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="type_voiture" id="hybride" value="hybride">
                        <label class="form-check-label" for="hybride">Hybride</label>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="model_voiture" class="form-label">Modèle de la voiture:</label>
                    <select class="col-12 form-select" name="IdModele" id="">
                        <?php
                            $options_modeles = option_modeles();
                            echo $options_modeles;
                        ?>
                    </select>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Envoyer</button>
            </form>
        </div>
        <footer class="container-fluid footer mt-5 text-center p-3">
            <div class="row">
                <div class="col-12 mt-3"><a href=""><a href="">A PROPOS DE NOUS</a></a></div>
                <div class="col-12 mt-3"><a href="">Arborescence</a></div>
                <div class="col-12 mt-3"><a href="">Politique de confidentialité</a></div>
                <div class="col-12 copy mt-3" style="border-bottom: solid 1px white; border-top: solid 1px white;;"><a href="">&copy;2024 SUPERCAR</a></div> 
            </div>
        </footer>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    </body>
</html>
