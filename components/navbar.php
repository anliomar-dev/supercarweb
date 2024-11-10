<?php
    include_once('../php/utils.php');
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $login_url = "/super-car/supercar/signin";
        if(isset($_POST['logout'])) {
            logout($login_url);
        }
    }
?>

<nav class="navbar navbar-expand-lg navbar-custom sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="/super-car/">
            <img src="../medias/images/logos/supercar_logo_blanc.webp" alt="SuperCar logo" style="height: 50px;">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/super-car/">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/super-car/supercar/marques">Marques</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/super-car/supercar/essai">Essai</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/super-car/supercar/evennements">Événements</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/super-car/supercar/contact">Contact</a>
                </li>
            </ul>
            <div class="d-flex">
                <?php
                    if(isset($_SESSION['email'])){
                        include_once('dropdown_accountSettings.php');
                    }else{
                        echo"
                            <a class='btn btn-login me-2' href='/super-car/supercar/signin'>Login</a>
                            <a class='btn btn-signup' href='/super-car/supercar/signup'>Sign up</a>
                        ";
                    }
                ?>
            </div>
        </div>
    </div>
</nav>

