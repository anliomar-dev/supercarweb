<?php
  // start new session if there is not a session
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>signin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" 
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" 
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="../bootstrap-5.3.3-dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../stylesheets/signin.css" rel="stylesheet">
    <link href="../stylesheets/navbar.css" rel="stylesheet">
    <style>
      .userDropdown{
          width: 25px;
          height: 25px;
          fill: white;
      }
    </style>
  </head>
  <body class="position-ralative">
    <?php
      include_once("../components/navbar.php")
    ?>
    <span class="alert alert-danger position-absolute z-5 mt-3 d-flex" role="alert" style="display: none;">
        <p class="m-0 error-message"></p>
        <svg class="close-alert-danger" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
            <path d="M6.28 5.22a.75.75 0 0 0-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 1 0 1.06 1.06L10 11.06l3.72 3.72a.75.75 0 1 0 1.06-1.06L11.06 10l3.72-3.72a.75.75 0 0 0-1.06-1.06L10 8.94 6.28 5.22Z" />
        </svg>
    </span>
    <div class="form-container">
      <div class="row d-flex justify-content-center">
        <div class="col-10 col-md-6 col-lg-4">
          <form action="" id="signin-form" class="shadow border mt-5 pt-3 pb-5 rounded" style="box-sizing: border-box; padding-inline: 30px;">
            <div class="logo text-center my-3 py-2">
              <img style="width: 190px; height: 56px;" class="img-fluid" src="../medias/images/logos/supercar_logo_noir.webp" alt="logo supercar">
            </div>
            <h4 class="text-center mt-3">CONNEXION</h4>
            <div class="form-group py-3">
              <label for="email">Adresse e-mail</label>
              <input type="email" class="form-control py-2" id="email" name="email" placeholder="email" autocomplete="email" autofocus required>
            </div>
            <div class="form-group py-3 position-relative password-container">
              <label for="password">Mot de passe</label>
              <input type="password" class="form-control py-2 passwordField" id="password" name="password" placeholder="password" autocomplete="current-password" required>
              <span class="eye-icon">👁️</span>
              <span style="display: none;" class="hide-password">🙈</span>
            </div>
            <p class="d-flex justify-content-end"><a href="">Mot de passe oublié ?</a></p>
            <div class="form-group py-2">
              <button class="btn btn-block col-12 text-white signin-btn">Login</button>
            </div>
            <p class="text-center mt-3">Vous n'avez pas de compte ? <a href="/super-car/supercar/signup">signup</a></p>
          </form>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="../js/signin.js" type="module" defer></script>
  </body>
</html>