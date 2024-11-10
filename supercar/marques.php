<?php
  // start new session if there is not a session
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="../bootstrap-5.3.3-dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="../stylesheets/navbar.css" rel="stylesheet">
  <title>Marques</title>
  <style>
    .primary-custom-btn {
      background-color: #28a745;
      color: white;
    }
    .primary-custom-btn:hover{
      background-color: #218739;
      color: white;
    }

    .card:hover{
      box-shadow: 0 10px 5px #28a745;
      transform: translateY(-10px)
    }
    .card{
      transition: all 0.3s ease-in-out;
    }
      .userDropdown{
          width: 25px;
          height: 25px;
          fill: white;
      }
  </style>
</head>
<body>
  <?php
      include_once("../components/navbar.php");
      include_once("../php/all_marques.php");
  ?>
  <main class="container mt-3 d-flex justify-content-center flex-wrap">
    <?php
      display_brands()
    ?>
  </main>
  <script src="../js/marques.js" type="module" defer></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
  </script>
</body>
</html>