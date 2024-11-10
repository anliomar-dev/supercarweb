<!DOCTYPE html>
<html lang="fr">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Admin Login</title>
      <!-- Lien vers le fichier CSS de Bootstrap -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
      <link href="styles/login.css" rel="stylesheet">
      <script src="js/login.js" type="module" defer></script>
  </head>
  <body class="px-3 px-sm-0 px-md-0 px-lg-0 position-relative">
    <div class="alert alert-danger text-center d-none" role="alert"></div>
    <div class="alert alert-success d-none text-center" role="alert"></div>
    <!--overlay for cofirmation box-->
    <div class="position-fixed top-0 start-0 w-100 h-100 overlay d-none">
    </div>
    <div class="spinner-border text-primary position-absolute spinner d-none" role="status" style=";">
      <span class="visually-hidden">Loading...</span>
    </div>
    <div class="login-container mt-5 pt-2 pb-5 px-4 container">
      <h5 class="mt-4 mb-0 text-center">ADMIN</h5>
      <div class="text-center logo-admin-container mt-3">
        <svg class="user-admin-svg shadow-sm" width="102" height="89" viewBox="0 0 102 89" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
          <path d="M0 0H102V89H0V0Z" fill="url(#pattern0_220_464)"/>
          <defs>
            <pattern id="pattern0_220_464" patternContentUnits="objectBoundingBox" width="1" height="1">
              <use xlink:href="#image0_220_464" transform="matrix(0.00444444 0 0 0.00509363 0 -0.0730337)"/>
            </pattern>
            <image id="image0_220_464" width="225" height="225" xlink:href="data:image/png;base64,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"/>
          </defs>
        </svg>  
      </div>
      <form class="login-form">
        <input type="hidden" name="action" value="login">
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control login-input-email" id="email" placeholder="Entrez votre email" autocomplete="email" required>
        </div>
        <div class="form-group py-3 position-relative password-container">
          <label for="password">Mot de passe</label>
          <input type="password" class="form-control py-2 passwordField" id="password" name="password" placeholder="password" autocomplete="current-password" required>
          <span class="eye-icon">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
              <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
            </svg>                         
          </span>
          <span class="hide-password" style="display: none;">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
            </svg>
          </span>
        </div>
        <div class="d-grid pt-2">
          <button type="submit" class="btn btn-login">Login</button>
        </div>
        <div class="text-center pt-2">
          <a href="#" class="text-decoration-none">Mot de passe oublié ?</a>
        </div>
      </form>
    </div>
    <div class="text-center mt-2">
      <p>Retour vers le <a href="http://localhost/super-car/">site</a></p>
    </div>
    <footer class="position-fixed bottom-0 col-12 d-flex flex-wrap justify-content-center align-items-center text-white pt-3" style="background-color: #263238;">
      <p class="mx-3">Copyright © 2024 Supercar ltd.</p>
      <p class="mx-3">All rights reserved</p>
    </footer>
    <!-- Lien vers le fichier JS de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
