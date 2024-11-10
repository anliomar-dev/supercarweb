<?php
  // start new session if there is not a session
  $LOGIN_URL = "/super-car/supercar/signin";
  $SESSION_EXPIRED_URL = "/super-car/supercar/session_expired";
  include_once('../php/utils.php');
  is_user_authenticated(10, $LOGIN_URL, $SESSION_EXPIRED_URL);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="../bootstrap-5.3.3-dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="../stylesheets/navbar.css" rel="stylesheet">
  <link href="../stylesheets/essai.css" rel="stylesheet">
  <title>demande d'essai</title>
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
    include_once("../components/navbar.php");
  ?>
  <span class="alert alert-success position-absolute z-5 mt-3 d-flex" role="alert" style="display: none;">
      <p class="m-0 success-message">jhjhjjhkjhkjjkhjk</p>
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5 close-alert-success">
          <path d="M6.28 5.22a.75.75 0 0 0-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 1 0 1.06 1.06L10 11.06l3.72 3.72a.75.75 0 1 0 1.06-1.06L11.06 10l3.72-3.72a.75.75 0 0 0-1.06-1.06L10 8.94 6.28 5.22Z" />
      </svg>
  </span>
  <span class="alert alert-danger position-absolute z-5 mt-3 d-flex" role="alert" style="display: none;">
      <p class="m-0 error-message"></p>
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5 close-alert-danger">
          <path d="M6.28 5.22a.75.75 0 0 0-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 1 0 1.06 1.06L10 11.06l3.72 3.72a.75.75 0 1 0 1.06-1.06L11.06 10l3.72-3.72a.75.75 0 0 0-1.06-1.06L10 8.94 6.28 5.22Z" />
      </svg>
  </span>
  <main class="">
    <!-- signup form -->
    <div class="form_container d-flex justify-content-center flex-wrap pt-3 mt-5">
        <div class="d-flex flex-column mx-3 bg-white px-5 py-3 rounded-3 shadow authData my-2">
          <h3 class="mb-5 text-center mt-3">connecté en tant que</h3>
          <div>
              <label for="readonly-firstName">Prenom</label>
              <input class="form-control" id="readonly-firstName" type="text" value="<?php echo $_SESSION['first_name'];?>" aria-label="Disabled input example" disabled readonly>
          </div>
          <div>
              <label for="readonly-firstName">Nom</label>
              <input class="form-control" id="readonly-firstName" type="text" value="<?php echo $_SESSION['last_name'];?>" aria-label="Disabled input example" disabled readonly>
          </div>
          <div>
              <label for="readonly-email">Email</label>
              <input class="form-control" id="readonly-email" type="text" value="<?php echo $_SESSION['email'];?>" aria-label="Disabled input example" disabled readonly>
          </div>
        </div>
        <div class="essai-form mx-3 my-2">
            <h2 class="text-center font-weight-bold">Reservez un essai</h2>
            <form style="width: 100%;" id="essaiForm">
                <div class="row mt-3 pt-2">
                    <div class="form-group col-md-6">
                        <label for="date">Date</label>
                        <input type="date" class="form-control" id="date" placeholder="Date" autocomplete="" autofocus required>
                    </div>
                    <div class="form-group col-md-6 position-relative">
                        <label for="heure">Heure</label>
                        <div class="d-flex">
                          <button type="button" class="btn-clock rounded-start-2 primary-custom-btn border-0 px-2 d-flex justify-content-center align-items-center" style="height: 38px">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 clock-svg">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                          </button>
                          <input type="text" class="form-control" name="heure" id="Heure" placeholder="Heure (cliquez l'horloge)" required>
                        </div>
                        <div class="available-hours-modale position-absolute overflow-y-scroll bg-white px-3 pb-3 ms-3 w-75 start-0 top-2 shadow rounded-3 border" style="height: 190px; display: none;">
                          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5 close-horaires my-2">
                            <path d="M6.28 5.22a.75.75 0 0 0-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 1 0 1.06 1.06L10 11.06l3.72 3.72a.75.75 0 1 0 1.06-1.06L11.06 10l3.72-3.72a.75.75 0 0 0-1.06-1.06L10 8.94 6.28 5.22Z" />
                          </svg>
                          <p class="">
                            <strong style="font-size: 13px;"><u>Horaires disponibles pour cette date</u></strong>
                          </p>
                          <div class="available-hours-container">
                            
                          </div>
                        </div>
                    </div>
                </div>
                <div class="form-group col-md-12">
                    <label for="marque">Marque</label>
                    <select name="marque" id="marque" class="form-control">
                      <?php
                        include("../php/all_marques.php");
                        option_brands();
                      ?>
                    </select>
                </div>
                <div class="form-group col-md-12">
                    <label for="modele">Modèle</label>
                    <div class="d-flex">
                      <button type="button" 
                        class="rounded-start-2 primary-custom-btn border-0 px-2 
                        d-flex justify-content-center align-items-center" 
                        style="height: 37.5px; width: 50px;"
                        data-bs-toggle="modal" data-bs-target="#scrollModal"
                        >
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                          <path fill="white" d="M171.3 96L224 96l0 96-112.7 0 30.4-75.9C146.5 104 158.2 96 171.3 96zM272 192l0-96 81.2 0c9.7 0 18.9 4.4 25 12l67.2 84L272 192zm256.2 1L428.2 68c-18.2-22.8-45.8-36-75-36L171.3 32c-39.3 0-74.6 23.9-89.1 60.3L40.6 196.4C16.8 205.8 0 228.9 0 256L0 368c0 17.7 14.3 32 32 32l33.3 0c7.6 45.4 47.1 80 94.7 80s87.1-34.6 94.7-80l130.7 0c7.6 45.4 47.1 80 94.7 80s87.1-34.6 94.7-80l33.3 0c17.7 0 32-14.3 32-32l0-48c0-65.2-48.8-119-111.8-127zM434.7 368a48 48 0 1 1 90.5 32 48 48 0 1 1 -90.5-32zM160 336a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"/>
                        </svg>
                      </button>
                      <input type="text" class="form-control" id="modele" data-id="" placeholder="modele" value=""  required>
                    </div>
                </div>
                <input type="hidden" id="user_id" name="user_id" value="<?php echo $_SESSION['user_id'];?>">
                <input type="hidden" id="csrf_token" name="csrf_token" value="<?php echo $_SESSION['csrf_token'];?>">
                <button type="submit" id="" class="btn col-12 primary-custom-btn mt-2">Reserver</button>
                <button type="reset" class="btn col-12 btn-reset mt-2">reset</button>
            </form>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="scrollModal" data-bs-backdrop="scrollModal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="scrollModal" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content px-3">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="scrollModal">models</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            
          </div>
          <div class="modal-footer">
            <nav aria-label="...">
              <ul class="pagination pagination-sm">
                
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </main>
  <script src="../js/essai.js" type="module" defer></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
  </script>
</body>
</html>