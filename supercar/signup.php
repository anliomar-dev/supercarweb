<?php
    // start new session if there is not a session
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>signup</title>
    <!-- Lien vers le CSS de Bootstrap -->
    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"
    >-->
    <link href="../bootstrap-5.3.3-dist/css/bootstrap.min.css" rel="stylesheet">
    <!--cdn font awsome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" 
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" 
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!--cdn css plugin indicateurs telephonique-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@19.2.14/build/css/intlTelInput.css">
    <!--script plugin indicateurs telephonique-->
    <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@19.2.14/build/js/intlTelInput.min.js"></script>
    
    <link href="../stylesheets/navbar.css" rel="stylesheet">
    <link href="../stylesheets/signup.css" rel="stylesheet">
    <style>
        .userDropdown{
            width: 25px;
            height: 25px;
            fill: white;
        }
    </style>
</head>
<body class="position-relative">
    <?php
        include_once("../components/navbar.php")
    ?>
    <span class="alert alert-success position-absolute z-5 mt-3 d-flex" role="alert" style="display: none;">
        <p class="m-0 success-message"></p>
        <svg class="close-alert-success" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
            <path d="M6.28 5.22a.75.75 0 0 0-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 1 0 1.06 1.06L10 11.06l3.72 3.72a.75.75 0 1 0 1.06-1.06L11.06 10l3.72-3.72a.75.75 0 0 0-1.06-1.06L10 8.94 6.28 5.22Z" />
        </svg>
    </span>
    <span class="alert alert-danger position-absolute z-5 mt-3 d-flex" role="alert" style="display: none;">
        <p class="m-0 error-message"></p>
        <svg class="close-alert-danger" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
            <path d="M6.28 5.22a.75.75 0 0 0-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 1 0 1.06 1.06L10 11.06l3.72 3.72a.75.75 0 1 0 1.06-1.06L11.06 10l3.72-3.72a.75.75 0 0 0-1.06-1.06L10 8.94 6.28 5.22Z" />
        </svg>
    </span>
    
    <!-- signup form -->
    <div class="form_container d-flex justify-content-center pt-3">
        <div class="signup-form">
            <h2 class="text-center font-weight-bold">INSCRIPTION</h2>
            <p class="text-center text-danger validation-message">
                Le bouton d'inscription restera désactivé jusqu'à ce que tous les champs soient correctement remplis
            </p>
            <form style="width: 100%;" id="signupForm">
                <input type="hidden" id="action" value="create">
                <div class="row mt-3 pt-2">
                    <div class="form-group col-md-6">
                        <label for="firstName">Prenom</label>
                        <input type="text" class="form-control" data-minLength="2" id="firstName" placeholder="Prenom" autocomplete="given-name" autofocus>
                        <p class="text-danger" style="display: none;">Minimum 2 caractères</p>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="lastName">Nom</label>
                        <input type="text" class="form-control" data-minLength="2" id="lastName" placeholder="Nom" autocomplete="family-name">
                        <p class="text-danger" style="display: none;">Minimum 2 caractères</p>
                    </div>
                </div>
                <div class="form-group mt-3">
                    <label for="address">Adress</label>
                    <input type="text" class="form-control" data-minLength="5" id="address" placeholder="Adress" autocomplete="address-level1">
                    <p class="text-danger" style="display: none;">Veuillez remplir ce champ (minimum 5 caractères)</p>
                </div>
                <div class="row mt-3">
                    <div class="form-group col-md-6 mt-2">
                        <label for="phone">Téléphone</label><br>
                        <input type="text" class="form-control" id="phone" placeholder="Téléphone" value="+1" autocomplete="tel-national">
                        <p class="text-danger error" style="display: none">ex: +230 5429 7857</p>
                    </div>
                    <div class="form-group col-md-6 mt-2">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="ex: exemple@gamil.com" autocomplete="email">
                        <p class="text-danger" style="display: none">email non valid</p>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="form-group col-md-6 position-relative password-container">
                        <label for="password">Mot de passe</label>
                        <span class="eye-icon">👁️</span>
                        <span style="display: none;" class="hide-password">🙈</span>
                        <input type="password" class="form-control passwordField" name="password" id="password" placeholder="Mot de passe" autocomplete="current-password">
                    </div>
                    <div class="form-group col-md-6 position-relative password-container confirm-pass-container">
                        <span class="eye-icon">👁️</span>
                        <span style="display: none;" class="hide-password">🙈</span>
                        <label for="confirmPassword">Mot de passe</label>
                        <input type="password" class="form-control passwordField" name="confirmPassword" id="confirmPassword" placeholder="confirmation" autocomplete="current-password">
                    </div>
                </div>
                <p class="passwordMessage">
                    pour un mot de passe fort, minimum: <br>
                    8 caractères, 1 lettre majuscule, 1 lettre miniscule, un chiffre, 1 caractère spéciale
                </p>
                <button type="button" id="submitSignup" class="btn col-12 signup-btn mt-2" data-bs-toggle="modal" data-bs-target="#reviewModal">SIGNUP</button>
                <button type="reset" class="btn col-12 btn-reset mt-2">reset</button>
            </form>
            <div class="text-center mt-3">
                <small>Avez-vous déjà un compte ? <a href="/super-car/supercar/signin" class="signin-link">signin</a></small>
            </div>
        </div>
    </div>

    <!-- First Modal: Review Data -->
    <div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header d-flex flex-column">
                    <button type="button" class="btn-close col-12" data-bs-dismiss="modal" aria-label="Close"></button>
                    <h4 class="modal-title col-12 text-center" id="reviewModalLabel">Vérifiez vos informations</h4>
                    
                </div>
                <div class="modal-body">
                    <p>Veuillez vérifier les informations suivantes avant de confirmer :</p>
                    <hr>
                    <div>
                        <label for="readonly-firstName">Prenom</label>
                        <input class="form-control" id="readonly-firstName" type="text" value="" aria-label="Disabled input example" disabled readonly>
                    </div>
                    <div>
                        <label for="readonly-lastName">Nom</label>
                        <input class="form-control" id="readonly-lastName" type="text" value="" aria-label="Disabled input example" disabled readonly>
                    </div>
                    <div>
                        <label for="readonly-address">Address</label>
                        <input class="form-control" id="readonly-address" type="text" value="" aria-label="Disabled input example" disabled readonly>
                    </div>
                    <div>
                        <label for="readonly-phone">Téléphone</label>
                        <input class="form-control" id="readonly-phone" type="text" value="" aria-label="Disabled input example" disabled readonly>
                    </div>
                    <div>
                        <label for="readonly-email">Email</label>
                        <input class="form-control" id="readonly-email" type="text" value="" aria-label="Disabled input example" disabled readonly>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn signup-btn col-12" id="confirmReviewButton">Confirmer</button>
                    <button type="button" class="btn btn-second col-12" data-bs-dismiss="modal">Modifier</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Second Modal: Consent and Conditions -->
    <div class="modal fade" id="consentModal" tabindex="-1" aria-labelledby="consentModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content px-3">
                <div class="modal-header">
                    <h5 class="modal-title" id="consentModalLabel">Consentement au traitement des données</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>
                        En soumettant ce formulaire, vous consentez expressément à la collecte, au stockage, et au traitement de vos données personnelles par "SUPERCAR". 
                        Vous reconnaissez avoir pris connaissance des informations relatives à la collecte, au stockage, et au traitement de vos données personnelles, telles que détaillées dans notre 
                        <a href="#" target="_blank">Page des Mentions Légales</a>.
                    </p>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="consentCheckbox">
                        <label class="form-check-label" for="consentCheckbox">
                            J'ai lu et compris les conditions ci-dessus.
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-primary confirm-signup-btn" id="finalConfirmButton" disabled>Confirmer et Soumettre</button>
                </div>
            </div>
        </div>
    </div>
    <!--- scripts -->
    <!-- FontAwesome for social icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="../js/signup.js" type="module" defer></script>
</body>
</html>
