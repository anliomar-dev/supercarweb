<?php
  include('../php/connexionDB.php');

  /**
   * display all brand
   */
  function display_events(){
    global $DB;
    $query = "
      SELECT * 
      FROM evennement 
      WHERE DATEDIFF(DateFin, CURDATE()) > 0 
    ";
    $curseur = mysqli_query($DB, $query);
    while($row = mysqli_fetch_array($curseur)){
        $IdEvent = $row["IdEvennement"];
        $title = $row["Titre"];
        $debut = $row["DateDebut"];
        $fin = $row["DateFin"];
        $description = $row["Description"];
        $image = $row["Image"];
        $location = $row["location"];
        echo "
            <div class='card mx-3 my-3' style='width: 18rem;'>
              <img src='../medias/images/evennements/$image' class='card-img-top h-50' alt='$title'>
              <div class='card-body'>
                <h5 class='card-title'>$title</h5>
                <p class='card-text overflow-hidden' style='height: 68px;'>
                  $description
                </p>
                <a href='' class='btn primary-custom-btn'>plus de details</a>
              </div>
            </div>
          ";
    }
    mysqli_free_result($curseur);
  }
?>