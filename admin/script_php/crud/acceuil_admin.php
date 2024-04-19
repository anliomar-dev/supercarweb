<?php
	include("../fonctions.php");
	verifierAuthentification("../index.php", "../session_expire.html"); 
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
        <div class="container text-center">
            <div class="row">
                <div class='col-12 text-bg-light' style='background-color: white;'>
                    <form class='row' action='' method='POST'>
                        <div class="col-12 mb-3 sticky-top text-bg-info">
                            <div class="row">
                                <div class="col-12 col-lg-4 border p-3">Titre et vidéo<div class='col-2'><a href='acceuilmodify.php'style='font-size: 20px; text-decoration: none;'>📝</a></div></div>
                                <div class="col-12 col-lg-4 border p-3">Cadre proposition<div class='col-2'><a href='acceuilmodify2.php'style='font-size: 20px; text-decoration: none;'>📝</a></div></div>
                                <div class="col-12 col-lg-4 border p-3">Actualité<div class='col-2'><a href='acceuilmodify3.php'style='font-size: 20px; text-decoration: none;'>📝</a></div></div>
                                <div class="row d-flex align-items-center justify-content-center">
                                    <button class="w-25 my-5"><a href="../index.php">Retour</a></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>