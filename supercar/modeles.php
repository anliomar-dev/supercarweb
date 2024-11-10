<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="../bootstrap-5.3.3-dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="../stylesheets/navbar.css" rel="stylesheet">
  <link href="../stylesheets/modeles.css" rel="stylesheet">
  <title>Modèles</title>
 
</head>
<body class="position-relative">
  <?php
    include_once("../components/navbar.php");
    include_once("../php/all_marques.php");
  ?>
  <div class="toggle-side-bar position-absolute z-5 toggle-container" style="max-width: 235px;">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
      <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12H12m-8.25 5.25h16.5" />
    </svg>
    <!--<span class="position-absolute bottom-0 border bg-white py-2 px-3 z-5 shadow mt-2 ms-2 rounded-3 pop-over">click to open options</span>-->
  </div>
  <div class="sidbar ms-2 pt-2 pb-5 px-3 rounded-2 position-fixed" style="background-color: #000D50; width: auto; z-index: 1000; top: 120px;">
    <div class="close-side-bar d-flex justify-content-between pb-3 pt-2">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 close-sidebar">
        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
      </svg>
    </div>
    <select name="" id="filterOptions" class="form-select">
      <option value="brows-by-type">parcourir par type</option>
      <option value="filter">filtrer par le prix</option>
      <option value="search">Search</option>
    </select>
    <button type="button" class="mt-2 bg-transparent text-white show-all-models-btn">Tous les modèles</button>
    <!--parcourir par type -->
    <div class="brows-by-type mt-2 pt-3">
      <h5 class="text-white px-2"><u>Parcourir par type</u></h5>
      <div class="buttons mt-3">
        <div class="btn-container my-2 px-2">
          <button class="btn primary-custom-btn fs-6 filterByEngine" data-type="Thermique">Thermique</button>
        </div>
        <div class="btn-container my-2 px-2">
          <button class="btn primary-custom-btn fs-6 filterByEngine" data-type="électrique">électrique</button>
        </div>
        <div class="btn-container my-2 px-2">
          <button class="btn primary-custom-btn fs-6 filterByEngine" data-type="Hybride">Hybride</button>
        </div>
      </div>
    </div>
    <!-- filter by Prix -->
    <div class="filter mt-3 pt-3" style="display: none">
      <h5 class="text-white px-2 pb-2"><u>Filtrer par le prix</u></h5>
      <form action="">
        <div class="form-group my-2">
          <label for="min" class="text-white">Prix manimum</label>
          <div class="d-flex">
            <input type="number" name="min-price" id="min" class="form-control filter-price-field" placeholder="prix minimum" min="0">
            <button type="button" class="primary-custom-btn searchButton" data-compare="min">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5 serachIcon">
                <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 1 0 0 11 5.5 5.5 0 0 0 0-11ZM2 9a7 7 0 1 1 12.452 4.391l3.328 3.329a.75.75 0 1 1-1.06 1.06l-3.329-3.328A7 7 0 0 1 2 9Z" clip-rule="evenodd" />
              </svg>
            </button>
          </div>
        </div>
        <div class="form-group my-2">
          <label for="max" class="text-white">Prix maximum</label>
          <div class="d-flex">
            <input type="number" name="max-price" id="max" class="form-control filter-price-field" placeholder="Prix maximum" min="0">
            <button type="button" class="primary-custom-btn searchButton" data-compare="max">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5 serachIcon">
                <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 1 0 0 11 5.5 5.5 0 0 0 0-11ZM2 9a7 7 0 1 1 12.452 4.391l3.328 3.329a.75.75 0 1 1-1.06 1.06l-3.329-3.328A7 7 0 0 1 2 9Z" clip-rule="evenodd" />
              </svg>
            </button>
          </div>
        </div> 
      </form>
    </div>
    <!--search model-->
    <div class="search mt-3" style="display: none">
      <form action="" class="search-form border py-2 px-3 rounded-3 shadow d-flex justify-content-center align-items-center" style="width: 300px;">
      <input type="text" class="form-control w-100" name="search" id="search" placeholder="search a model">
      </form>
    </div>
  </div>
  <main class="z-3 container-fluid d-flex justify-content-center flex-wrap models-container">
    <template id="template-model">
      <div class="z-3 card pt-3 pb-2 px-3 mt-5 rounded-4 mx-4" style="width: 300px">
        <div class="w-100 d-flex justify-content-between">
          <div class="image border-end" style="width: 30%">
            <img class="w-100 brand-logo" src="" alt="">
          </div>
          <div class="brand d-flex justify-content-center align-items-center" style="width: 70%">
            <h5 style="color: #000D50;" id="model-name"></h5>
          </div>
        </div>
        <p class="ms-2 py-0 my-0" style="color: #000D50;" id="model-brand"></p>
        <div class="card_body mt-2 rounded-3">
          <img class="w-100 rounded-3 w-100" id="image-model" src="" alt="" style="height: 165px;">
        </div>
        <div class="footer mt-1 py-2 px-2">
          <h4 class="mx-0 px-0" style="color: #000D50;">Details</h4>
          <div class="row card-details">
            <div class="col-6 border py-1 card-details-items"><strong style="color:#000D50;">Année</strong></div>
            <div class="col-6 border py-1 card-details-items" id="model-year"></div>
            <div class="col-6 border py-1 card-details-items"><strong style="color:#000D50;">Prix</strong></div>
            <div class="col-6 border py-1 card-details-items" id="model-price"></div>
            <div class="col-6 border py-1 card-details-items"><strong style="color:#000D50;">Moteur</strong></div>
            <div class="col-6 border py-1 card-details-items" id="model-engine"></div>
            <div class="col-12 mt-2">
              <div class="row py-2">
                <a href="" class="test btn col-6 mx-auto primary-custom-btn essaiBtn">Essayer</a>
                <a href="/supercar/modele?modele=" class="more-details btn col-6 mx-auto" style="color:#000D50;"><strong>Voir plus</strong></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </template>
  </main>
  <nav aria-label="Page navigation example" class="d-flex justify-content-center mt-5">
    <ul class="pagination">
      
    </ul>
  </nav>
  <script src="../js/modeles.js" type="module" defer></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>