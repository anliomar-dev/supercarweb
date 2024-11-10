<?php
    // start new session if there is not a session
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link href="bootstrap-5.3.3-dist/css/bootstrap.min.css" rel="stylesheet">
        <!--cdn font awsome-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" 
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" 
        crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="stylesheets/acceuil.css">
        <link rel="stylesheet" href="stylesheets/layout.css">
        <title>acceuil</title>
        <style>
            .userDropdown{
                width: 25px;
                height: 25px;
                fill: white;
            }
        </style>
    </head>
    <body>
        <div class="overlay"></div>
        <section class="header">
            <div class="header_container">
                <div  class="header_logo">
                    <img src="medias/images/logos/supercar_logo_blanc.webp" alt="" class="logo" id="logo">
                </div>
                <div class="toggle-button">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                        <path fill-rule="evenodd" d="M3 6.75A.75.75 0 0 1 3.75 6h16.5a.75.75 0 0 1 0 1.5H3.75A.75.75 0 0 1 3 6.75ZM3 12a.75.75 0 0 1 .75-.75h16.5a.75.75 0 0 1 0 1.5H3.75A.75.75 0 0 1 3 12Zm0 5.25a.75.75 0 0 1 .75-.75h16.5a.75.75 0 0 1 0 1.5H3.75a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd" />
                    </svg>
                </div>
                <!--navbar-->
                <div class="header_links-buttons">
                    <div class="menu-close-button">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                            <path fill-rule="evenodd" d="M5.47 5.47a.75.75 0 0 1 1.06 0L12 10.94l5.47-5.47a.75.75 0 1 1 1.06 1.06L13.06 12l5.47 5.47a.75.75 0 1 1-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 0 1-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <nav class="header_menu">
                        <ul>
                            <li><a href="/super-car/" class="header_link">Acceuil</a></li>
                            <li><a href="/super-car/supercar/marques" class="header_link">Marques</a></li>
                            <li><a href="/super-car/supercar/essai" class="header_link">Essai</a></li>
                            <li><a href="/super-car/supercar/evennements" class="header_link">Evénnements</a></li>
                            <li><a href="/super-car/supercar/contact" class="header_link">contact</a></li>
                        </ul>
                    </nav>
                    <!--end navbar-->
                    <div class="d-flex">
                        <?php
                            if(isset($_SESSION['email'])){
                                include_once('components/dropdown_accountSettings.php');
                            }else{
                                echo"
                                    <a href='/super-car/supercar/signin' class='btn btn-secondary header_secondary'>Login</a>
                                    <a href='/super-car/supercar/signup' class='btn btn-primary ms-3'>Sign up</a>
                                ";
                            }
                        ?>
                    </div>
                </div>
            </div>
        </section>
        <div class="entete">
            <div class="filter"></div>
            <div class="container action">
                <div class="text">
                    <h1 class="text-center animation1">supercar</h1>
                    <h2 class="animation2">find your dream car with us</h2>
                    <p class="text-white animation3">depuis 2009 nous vous accompagnons pour vous aider a trouvez votre voiture de reve</p>
                    <div class="buttons text-center col-12">
                        <a href="/super-car/supercar/contact" class="btn btn-primary animation4">contactez nous</a>
                        <a href="/super-car/supercar/signup" class="btn btn-secondary animation5">inscrivez vous</a>
                    </div>
                </div>
                <div class="image">
                    <img src="medias/images/pexels-mikebirdy-1335077-removebg-preview.png" alt="mercedes" class="img-fluid">
                </div>
            </div>
        </div>
        <main>
            <section class="types">
                    <div class="browse">
                        <div class="marques-section">
                            <div class="row">
                                <div class="col-12 marques d-flex justify-content-center">
                                    <div class="marques-section_marques scroller">
                                        <div class="logos scroller_inner">
                                            <div class="browse-type">
                                                <img src="medias/images/icons/thermique.webp" alt="">
                                            </div>
                                            <div class="browse-type">
                                                <img src="medias/images/icons/electric-car.webp" alt="">
                                            </div>
                                            <div class="browse-type">
                                                <img src="medias/images/icons/voiture-hybride.webp" alt="">
                                            </div>
                                            <div class="browse-type">
                                                <img src="medias/images/icons/boite-manuelle.webp" alt="">
                                            </div>
                                            <div class="browse-type">
                                                <img src="medias/images/icons/boite-auto.webp" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </section>
            <section class="about pt-5">
                <div class="container">
                    <div class="row py-5 about_content d-flex justify-content-center">
                        <div class="col-lg-5 about_image">
                            <img src="medias/images/vente.webp" alt="" class="img-fluid">
                        </div>
                        <div class="col-lg-5 about_body">
                            <div class="row">
                                <div class="col-12"><h5>Apropos de Nous</h5></div>
                                <div class="col-12 about_title">
                                </div>
                                <div class="about_text">
                                    <p>depuis Depuis 2009, nous proposons de voitures de qualités de divers marques. on vous accompagnement     pour mieux choisir la voitures qui vous convient
                                    </p>
                                </div>
                                <div class="col-12">
                                    <div class="col-12 about_list">
                                        <p>faites un essai en 3 étapes</p>
                                        <h6>1- <a href="/super-car/supercar/signup">inscrivez vous</a></h6>
                                        <h6>2- <a href="/super-car/supercar/contact">connectez vous</a></h6>
                                        <h6>3- <a href="/super-car/supercar/essai">demander l'essai en ligne</a></h6>
                                    </div>
                                    <div class="col-12 py-3">
                                        <a href="/super-car/supercar/signup" class="btn btn-primary" style="color: white;">je m'inscris</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="looking-for">
                <div class="container cards">
                    <div class="d-flex justify-content-center cards_content">
                        <div class=" looking-for_card">
                            <div class="looking-for_row row-login">
                                <div class="col-12">
                                    <h4>que recherchez vous</h4>
                                    <p class="my-3">Contactez nous par email ou par téléphone pour en savoir plus sur nos services.</p>
                                </div>
                                <div class="col-12 card_buttons">
                                    <a class="btn btn-primary" href="/super-car/supercar/contact">contactez nous</a>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <div class="looking-for_card">
                            <div class="looking-for_row row-essai">
                                <div class="col-12">
                                    <h4>passez à l'action</h4>
                                    <p class="my-3">Nous nous engageons à fournir à nos clients un service exceptionnel.</p>
                                </div>
                                <div class="col-12 card_buttons">
                                    <a class="btn btn-primary" href="/super-car/supercar/essai">Demander un essai</a>
                                    <svg width="110" height="111" viewBox="0 0 110 111" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_5_901)">
                                            <g clip-path="url(#clip1_5_901)">
                                                <path d="M43.1686 15.5442C36.3829 15.5442 30.2324 19.5367 27.4699 25.7345L16.292 50.813C9.59104 51.2734 4.29688 56.8514 4.29688 63.6692V76.5598C4.29688 82.4925 9.10636 87.302 15.0391 87.302H17.9835C17.9994 86.4753 18.0204 85.6488 18.0469 84.8223C17.3476 83.3968 16.9533 81.7945 16.9533 80.0996L16.7578 72.4778C16.7578 66.8412 17.9046 61.6641 22.0885 60.8212C24.0773 60.4206 25.7424 59.0656 26.5573 57.2076L40.3605 25.7345C43.1228 19.5367 49.2733 15.5442 56.0592 15.5442H43.1686Z" fill="#CEE1F2"/>
                                                <path d="M94.9609 87.302C100.894 87.302 105.703 82.4925 105.703 76.5598V63.6692C105.703 56.5499 99.9318 50.7786 92.8125 50.7786L79.5736 24.9705C76.6474 19.1888 70.7184 15.5442 64.2383 15.5442H43.1686C36.3829 15.5442 30.2324 19.5367 27.4699 25.7345L16.292 50.813C9.59104 51.2734 4.29688 56.8514 4.29688 63.6692V76.5598C4.29688 82.4925 9.10636 87.302 15.0391 87.302" stroke="#405FF2" stroke-width="5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M38.0273 95.8958C42.7735 95.8958 46.6211 92.0482 46.6211 87.302C46.6211 82.5558 42.7735 78.7083 38.0273 78.7083C33.2811 78.7083 29.4336 82.5558 29.4336 87.302C29.4336 92.0482 33.2811 95.8958 38.0273 95.8958Z" stroke="#405FF2" stroke-width="5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M63.1646 87.302H49.8438" stroke="#405FF2" stroke-width="5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M71.9727 95.8958C76.7189 95.8958 80.5664 92.0482 80.5664 87.302C80.5664 82.5558 76.7189 78.7083 71.9727 78.7083C67.2265 78.7083 63.3789 82.5558 63.3789 87.302C63.3789 92.0482 67.2265 95.8958 71.9727 95.8958Z" stroke="#405FF2" stroke-width="5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M51.5625 67.5363L63.5321 55.9298C65.9379 53.5786 64.2746 49.4911 60.9118 49.4911H49.9492C46.5803 49.4911 44.9199 45.3904 47.3384 43.0433L59.7345 31.0129" stroke="#FF5CF3" stroke-width="5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                                            </g>
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_5_901">
                                                <rect width="110" height="110" fill="white" transform="translate(0 0.719971)"/>
                                            </clipPath>
                                            <clipPath id="clip1_5_901">
                                                <rect width="110" height="110" fill="white" transform="translate(0 0.719971)"/>
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="gallery my-5">
                <h2 class="text-center my-3">Gallery</h2>
                <div class="container d-flex justify-content-center">
                    <div class="grid-gallery">
                        <div class="image1">
                            <img src="medias/images/panamera.webp" alt="">
                        </div>
                        <div class="image3">
                            <img src="medias/images/avengerlongitude.webp" alt="">
                        </div>
                        <div class="image4">
                            <img src="medias/images/ferrari_812.webp" alt="">
                        </div>
                        <div class="image5">
                            <img src="medias/images/panamera.webp" alt="">
                        </div>
                    </div>
                </div>
            </section>
            
            <section class="most-requested">
                <div class="container">
                    <div class="text-center">
                        <h2>Les plus demandées</h2>
                    </div>
                    <div class="row">
                        <div class="card card-1">
                            <div class="card_body">
                                <div class="body-text">
                                    <strong>Ferrari 812</strong>
                                    <p>€ 260,000</p>
                                </div>
                                <div class="hr-1"></div>
                                <div class="svgs">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                        <path d="M96 0C60.7 0 32 28.7 32 64V448c-17.7 0-32 14.3-32 32s14.3 32 32 32H320c17.7 0 32-14.3 32-32s-14.3-32-32-32V304h16c22.1 0 40 17.9 40 40v32c0 39.8 32.2 72 72 72s72-32.2 72-72V252.3c32.5-10.2 56-40.5 56-76.3V144c0-8.8-7.2-16-16-16H544V80c0-8.8-7.2-16-16-16s-16 7.2-16 16v48H480V80c0-8.8-7.2-16-16-16s-16 7.2-16 16v48H432c-8.8 0-16 7.2-16 16v32c0 35.8 23.5 66.1 56 76.3V376c0 13.3-10.7 24-24 24s-24-10.7-24-24V344c0-48.6-39.4-88-88-88H320V64c0-35.3-28.7-64-64-64H96zM216.9 82.7c6 4 8.5 11.5 6.3 18.3l-25 74.9H256c6.7 0 12.7 4.2 15 10.4s.5 13.3-4.6 17.7l-112 96c-5.5 4.7-13.4 5.1-19.3 1.1s-8.5-11.5-6.3-18.3l25-74.9H96c-6.7 0-12.7-4.2-15-10.4s-.5-13.3 4.6-17.7l112-96c5.5-4.7 13.4-5.1 19.3-1.1z"/></svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path d="M32 64C32 28.7 60.7 0 96 0H256c35.3 0 64 28.7 64 64V256h8c48.6 0 88 39.4 88 88v32c0 13.3 10.7 24 24 24s24-10.7 24-24V222c-27.6-7.1-48-32.2-48-62V96L384 64c-8.8-8.8-8.8-23.2 0-32s23.2-8.8 32 0l77.3 77.3c12 12 18.7 28.3 18.7 45.3V168v24 32V376c0 39.8-32.2 72-72 72s-72-32.2-72-72V344c0-22.1-17.9-40-40-40h-8V448c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32V64zM96 80v96c0 8.8 7.2 16 16 16H240c8.8 0 16-7.2 16-16V80c0-8.8-7.2-16-16-16H112c-8.8 0-16 7.2-16 16z"/></svg>
                                    <p>2016</p>
                                </div>
                                <div class="hr-2"></div>
                                <div class="body_buttons">
                                    <a href="" class="voir-plus">Voir plus</a>
                                    <a href="" class="essai">Essai
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                            <path d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card card-2">
                            <div class="card_body">
                                <div class="body-text">
                                    <strong>Ferrari 812</strong>
                                    <p>€ 260,000</p>
                                </div>
                                <div class="hr-1"></div>
                                <div class="svgs">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                        <path d="M96 0C60.7 0 32 28.7 32 64V448c-17.7 0-32 14.3-32 32s14.3 32 32 32H320c17.7 0 32-14.3 32-32s-14.3-32-32-32V304h16c22.1 0 40 17.9 40 40v32c0 39.8 32.2 72 72 72s72-32.2 72-72V252.3c32.5-10.2 56-40.5 56-76.3V144c0-8.8-7.2-16-16-16H544V80c0-8.8-7.2-16-16-16s-16 7.2-16 16v48H480V80c0-8.8-7.2-16-16-16s-16 7.2-16 16v48H432c-8.8 0-16 7.2-16 16v32c0 35.8 23.5 66.1 56 76.3V376c0 13.3-10.7 24-24 24s-24-10.7-24-24V344c0-48.6-39.4-88-88-88H320V64c0-35.3-28.7-64-64-64H96zM216.9 82.7c6 4 8.5 11.5 6.3 18.3l-25 74.9H256c6.7 0 12.7 4.2 15 10.4s.5 13.3-4.6 17.7l-112 96c-5.5 4.7-13.4 5.1-19.3 1.1s-8.5-11.5-6.3-18.3l25-74.9H96c-6.7 0-12.7-4.2-15-10.4s-.5-13.3 4.6-17.7l112-96c5.5-4.7 13.4-5.1 19.3-1.1z"/>
                                    </svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path d="M32 64C32 28.7 60.7 0 96 0H256c35.3 0 64 28.7 64 64V256h8c48.6 0 88 39.4 88 88v32c0 13.3 10.7 24 24 24s24-10.7 24-24V222c-27.6-7.1-48-32.2-48-62V96L384 64c-8.8-8.8-8.8-23.2 0-32s23.2-8.8 32 0l77.3 77.3c12 12 18.7 28.3 18.7 45.3V168v24 32V376c0 39.8-32.2 72-72 72s-72-32.2-72-72V344c0-22.1-17.9-40-40-40h-8V448c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32V64zM96 80v96c0 8.8 7.2 16 16 16H240c8.8 0 16-7.2 16-16V80c0-8.8-7.2-16-16-16H112c-8.8 0-16 7.2-16 16z"/>
                                    </svg>
                                    <p>2016</p>
                                </div>
                                <div class="hr-2"></div>
                                <div class="body_buttons">
                                    <a href="" class="voir-plus">Voir plus</a>
                                    <a href="" class="essai">Essai
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                            <path d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card card-3">
                            <div class="card_body">
                                <div class="body-text">
                                    <strong>Ferrari 812</strong>
                                    <p>€ 260,000</p>
                                </div>
                                <div class="hr-1"></div>
                                <div class="svgs">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                        <path d="M96 0C60.7 0 32 28.7 32 64V448c-17.7 0-32 14.3-32 32s14.3 32 32 32H320c17.7 0 32-14.3 32-32s-14.3-32-32-32V304h16c22.1 0 40 17.9 40 40v32c0 39.8 32.2 72 72 72s72-32.2 72-72V252.3c32.5-10.2 56-40.5 56-76.3V144c0-8.8-7.2-16-16-16H544V80c0-8.8-7.2-16-16-16s-16 7.2-16 16v48H480V80c0-8.8-7.2-16-16-16s-16 7.2-16 16v48H432c-8.8 0-16 7.2-16 16v32c0 35.8 23.5 66.1 56 76.3V376c0 13.3-10.7 24-24 24s-24-10.7-24-24V344c0-48.6-39.4-88-88-88H320V64c0-35.3-28.7-64-64-64H96zM216.9 82.7c6 4 8.5 11.5 6.3 18.3l-25 74.9H256c6.7 0 12.7 4.2 15 10.4s.5 13.3-4.6 17.7l-112 96c-5.5 4.7-13.4 5.1-19.3 1.1s-8.5-11.5-6.3-18.3l25-74.9H96c-6.7 0-12.7-4.2-15-10.4s-.5-13.3 4.6-17.7l112-96c5.5-4.7 13.4-5.1 19.3-1.1z"/></svg>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path d="M32 64C32 28.7 60.7 0 96 0H256c35.3 0 64 28.7 64 64V256h8c48.6 0 88 39.4 88 88v32c0 13.3 10.7 24 24 24s24-10.7 24-24V222c-27.6-7.1-48-32.2-48-62V96L384 64c-8.8-8.8-8.8-23.2 0-32s23.2-8.8 32 0l77.3 77.3c12 12 18.7 28.3 18.7 45.3V168v24 32V376c0 39.8-32.2 72-72 72s-72-32.2-72-72V344c0-22.1-17.9-40-40-40h-8V448c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32V64zM96 80v96c0 8.8 7.2 16 16 16H240c8.8 0 16-7.2 16-16V80c0-8.8-7.2-16-16-16H112c-8.8 0-16 7.2-16 16z"/></svg>
                                    <p>2016</p>
                                </div>
                                <div class="hr-2"></div>
                                <div class="body_buttons">
                                    <a href="" class="voir-plus">Voir plus</a>
                                    <a href="" class="essai">Essai
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                            <path d="M438.6 278.6c12.5-12.5 12.5-32.8 0-45.3l-160-160c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L338.8 224 32 224c-17.7 0-32 14.3-32 32s14.3 32 32 32l306.7 0L233.4 393.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0l160-160z"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="experiences">
                <div class="">
                    <div class="statistiques">
                        <div class="experience">
                            <div class="icon">
                                <img src="medias/images/icons/Happy_User-avatar-positive-ux-experience-512.webp" alt="">
                            </div>
                            <div class="nombre"><strong>35</strong></div>
                            <div class="text">
                                Lorem ipsum dolor sit amet.
                            </div>
                        </div>
                        <div class="experience">
                            <div class="icon">
                                <img src="medias/images/icons/Happy_User-avatar-positive-ux-experience-512.webp" alt="">
                            </div>
                            <div class="nombre"><strong>95</strong></div>
                            <div class="text">Lorem ipsum dolor sit amet.</div>
                        </div>
                        <div class="experience">
                            <div class="icon">
                                <img src="medias/images/icons/Happy_User-avatar-positive-ux-experience-512.webp" alt="">
                            </div>
                            <div class="nombre"><strong>125+</strong></div>
                            <div class="text">Lorem ipsum dolor sit amet.</div>
                        </div>
                        <div class="experience">
                            <div class="icon">
                                <img src="medias/images/icons/Happy_User-avatar-positive-ux-experience-512.webp" alt="">
                            </div>
                            <div class="nombre"><strong>200+</strong></div>
                            <div class="text">Lorem ipsum dolor sit amet.</div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="container marques-section overflow-hidden my-5">
                <div class="row">
                    <div class="col-12 marques d-flex justify-content-space-around flex-column flex-lg-row align-items-center colimn-gap-3">
                        <div class="nos-evennements mx-3 mb-5 mb-lg-0">
                            <img src="medias/images/avengerlongitude.webp" alt="">
                        </div>
                        <div class="marques-section_marques scroller mx-5">
                            <div class="col-12 mb-3 mb-lg-5">
                                <h2 class="text-center">marques disponibles</h2>
                            </div>
                            <div class="logos scroller_inner ">
                                <div class="marque">
                                    <p class="text-center">Ferari</p>  
                                    <img src="medias/images/logos/Ferrari-logo.webp" alt="">
                                </div>
                                <div class="marque">
                                    <p class="text-center">Porsche</p>  
                                    <img src="medias/images/logos/porsche_logo.webp" alt="">
                                </div>
                                <div class="marque">
                                    <p class="text-center">Jeep</p>  
                                    <img src="medias/images/logos/Jeep-logo-history-_-Body-7-3-10-23-1024x640-removebg-preview.webp" alt="">
                                </div>
                                <div class="marque">
                                    <p class="text-center">mercedes</p>  
                                    <img src="medias/images/logos/mercedes_logo.webp" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
        <footer class="footer">
            <div class="container">
                <div class="footer_logo">
                    <div class="logo">
                        <img src="medias/images/logos/supercar_logo_blanc.webp" alt="">
                    </div>
                    <div class="copyright">
                        <p>Copyright © 2024 Supercar ltd.</p>
                        <p>All rights reserved</p>
                    </div>
                    <div class="reseaux">
                        <a href="">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <path d="M512 256C512 114.6 397.4 0 256 0S0 114.6 0 256C0 376 82.7 476.8 194.2 504.5V334.2H141.4V256h52.8V222.3c0-87.1 39.4-127.5 125-127.5c16.2 0 44.2 3.2 55.7 6.4V172c-6-.6-16.5-1-29.6-1c-42 0-58.2 15.9-58.2 57.2V256h83.6l-14.4 78.2H287V510.1C413.8 494.8 512 386.9 512 256h0z"/>
                            </svg>
                        </a>
                        <a href="">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                <path d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z"/>
                            </svg>
                        </a>
                        <a href="">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                <path d="M416 32H31.9C14.3 32 0 46.5 0 64.3v383.4C0 465.5 14.3 480 31.9 480H416c17.6 0 32-14.5 32-32.3V64.3c0-17.8-14.4-32.3-32-32.3zM135.4 416H69V202.2h66.5V416zm-33.2-243c-21.3 0-38.5-17.3-38.5-38.5S80.9 96 102.2 96c21.2 0 38.5 17.3 38.5 38.5 0 21.3-17.2 38.5-38.5 38.5zm282.1 243h-66.4V312c0-24.8-.5-56.7-34.5-56.7-34.6 0-39.9 27-39.9 54.9V416h-66.4V202.2h63.7v29.2h.9c8.9-16.8 30.6-34.5 62.9-34.5 67.2 0 79.7 44.3 79.7 101.9V416z"/>
                            </svg>
                        </a>
                        <a href="">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                <path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"/>
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="column">
                    <div class="footer_title">
                        <h4><strong>Company</strong></h4>
                    </div>
                    <ul>
                        <li><a href="">apropos</a></li>
                        <li><a href="">politiques de confidentialité</a></li>
                        <li><a href="">mentions legales</a></li>
                        <li><a href="">RGPD</a></li>
                        <li><a href="/super-car/supercar/contact">contactez nous</a></li>
                    </ul>
                </div>
                <div class="column">
                    <div class="footer_title">
                        <h4><strong>restez à jour</strong></h4>
                    </div>
                    <div class="footer_form">
                        <form action="">
                            <input type="text" name="" id="email" placeholder="Your email address" autocomplete="email">
                            <button class="footer_button" title="Open in Source Elements">
                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M17.0303 0.969691C17.2341 1.17342 17.3031 1.47584 17.2079 1.74778L11.9579 16.7478C11.8563 17.038 11.5878 17.2369 11.2806 17.2494C10.9733 17.2619 10.6895 17.0856 10.5646 16.8046L7.6818 10.3182L1.1954 7.43538C0.91439 7.31049 0.738092 7.02671 0.750627 6.71945C0.763163 6.41219 0.961991 6.14371 1.25224 6.04213L16.2522 0.792127C16.5242 0.696948 16.8266 0.765962 17.0303 0.969691ZM9.14456 9.91612L11.1671 14.4667L14.7064 4.35429L9.14456 9.91612ZM13.6457 3.29362L3.53331 6.83297L8.0839 8.85546L13.6457 3.29362Z" fill="white"/>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>    
        </footer>
        <script defer src="js/acceuil.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>
