<?php 
  include_once('../php/connexionDB.php');
  /**
   * display all brand
   */
  function display_all_brands(){
    global $DB;
    $query = "
        SELECT 
            marque.IdMarque, 
            marque.NomMarque, 
            marque.logo, 
            COUNT(modele.IdModele) AS NombreModeles
        FROM marque
        LEFT JOIN modele ON marque.IdMarque = modele.IdMarque
        GROUP BY marque.IdMarque, marque.NomMarque
    ";
    $curseur = mysqli_query($DB, $query);
    while($row = mysqli_fetch_array($curseur)){
        $IdMarque = $row["IdMarque"];
        $NomMarque = $row["NomMarque"];
        $logo = $row["logo"];
        $NombreModeles = 
            isset($row["NombreModeles"]) && is_numeric($row["NombreModeles"]) && (int)$row["NombreModeles"] > 0 
            ? "+ ". (int)$row["NombreModeles"]. " modèles"
            : "pas de modèle disponible";
        echo "
            <div class='card mx-3 my-4 rounded-5' style='height: 300px; width: 230px'>
              <div 
                class='
                  card_head px-3 
                  d-flex flex-column align-items-center 
                  py-4 position-relative rounded-top-5 h-50 text-white
                ' 
                style='background-color: #000D50;'
              >
                <h3 class='card-title'>$NomMarque</h3>
                <hr class='my-0 w-75' style='background-color: white;'/>
                <div class='mt-1' style='height: 70%;'>
                  <img src='/super-car//medias/images/logos/$logo' alt='logo' class='h-100'>
                </div>
                <div class='position-absolute' 
                style='height: 25px; width: 25px; background-color: white; right: 0; bottom: 0;'>
                  
                </div>
                <div class='position-absolute' 
                style='height: 60px; width: 60px; background-color: #000D50; border-radius: 100%; right: 0; bottom: 0;'>
                  
                </div>
              </div>
              <div class='card_body d-flex flex-column align-items-center justify-content-center position-relative'>
              <div class='position-absolute z-0 start-0 top-0' 
                style='height: 25px; width: 25px; background-color: #000D50;'>
                  
                </div>
                <div class='position-absolute bg-white z-1 top-0 start-0' 
                style='height: 60px; width: 60px; border-radius: 100%;'>
                  
                </div>
                <div class='mt-3 z-2'>
                  <p style=''>$NombreModeles</p>
                </div>
                <div class='mt-3'>
                  <button class='view-MarqueBtn btn primary-custom-btn' data-id='$IdMarque' data-section='update-section'>voir plus</button>
                </div>
              </div>
            </div>
          ";
    }
    mysqli_free_result($curseur);
  }
?>