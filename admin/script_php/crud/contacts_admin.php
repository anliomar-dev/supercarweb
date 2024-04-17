<?php
    include("../fonctions.php");
    verifierAuthentification("../index.php", "../session_expire.html"); 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST['ajouter_contacts'])) {
            inserer('contacts', ['Nom', 'Prenom', 'email', 'NumTel']);
        } elseif(isset($_POST['supprimer_contacts'])) {
            supprimer('contacts', 'IdContact');
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
        <!--lien plugin indicateurs telephonique-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@19.2.14/build/css/intlTelInput.css">
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
                        <form action="" method="POST" class="col-12 p-3 mt-5 mb-5">
                            <div class="row p-3">
                                <div class="col-6 mt-3">
                                    <label for="Nom">Nom</label>
                                    <input class="form-control col-12" type="text" name="Nom" required>
                                </div>
                                <div class="col-6 mt-3">
                                    <label for="Prenom">Prenom</label>
                                    <input class="form-control col-12" type="text" name="Prenom" required>
                                </div>
                                <div class="col-6 mt-3">
                                    <label for="telephone" class="col-12">NumTel</label>
                                    <input class="form-control" type="telephone" name="NumTel" id="phone" value="+1"  required>
                                </div>
                                <div class="col-6 mt-3">
                                    <label for="email">email</label>
                                    <input class="form-control col-12" type="text" name="email" required>
                                </div>
                                <div class="col-6 mt-3">
                                    <input type="submit" name="ajouter_contacts" value="Valider" class="btn btn-primary">
                                </div>
                                <div class="col-6 mt-3">
                                    <input type="reset" class="btn btn-secondary" value="reset">
                                </div>
                            </div>
                        </form>
                        <div class="col-12 ps-5 pt-5">
                            <h5><i class="fa-solid fa-arrow-left"></i><a href="../index.php" class="retour">RETOUR</a></h5>
                        </div>
                    </div>
                </div>
                <div class='col-12 col-sm-12 col-md-12 col-lg-8 border text-bg-light'>
                    <form class='row' action='' method='post'>
                        <div class="col-12 mb-3 sticky-top text-bg-info" style='background-color: #4A7696;'>
                            <div class="row">
                                <div class="col-4 p-3 border">Nom</div>
                                <div class="col-6 p-3 border">Email</div>
                                <div class="col-2 p-3 border text-center"><button class="text-bg-info"  style="color: white; border: none" value="supprimer" name="supprimer_contacts" style="background-color:  #4A7696; color: white; border: none"><i class="fa-solid fa-trash" style="color: #ff0000;"></i></button></div>
                            </div>
                        </div>
                        <?php
                            afficher_infos_contacts();
                        ?>
                    </form>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@19.2.14/build/js/intlTelInput.min.js"></script>
        <script>
            const input = document.querySelector("#phone");
                window.intlTelInput(input, {
                    utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@19.2.14/build/js/utils.js",
                });
        </script>
    </body>
</html>