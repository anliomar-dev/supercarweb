<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="../bootstrap-5.3.3-dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="../stylesheets/navbar.css" rel="stylesheet">
  <link href="../stylesheets/evennements.css" rel="stylesheet">
  <title>evennements</title>
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
  <main class="">
    <h2 class="text-center mt-5 mb-3">Evennements</h2>
    <div class="container py-3 d-flex justify-content-center flex-wrap mt-3">
      <?php
        include_once('../php/all_events.php');
        display_events();
      ?>
    </div>
  </main>
  <script src="../js/essai.js" type="module" defer></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
  </script>
</body>
</html>