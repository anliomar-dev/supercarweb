<?php
    include '../php/connexionDB.php';
    global $DB;
    // Démarrer une session si elle n'est pas déjà active
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $modele_found = false;
    // Vérification de l'ID modèle et gestion de la redirection 404
    if (isset($_GET['modele']) && is_numeric($_GET['modele'])) {
        $modele_id = (int)$_GET['modele']; // Conversion sécurisée en entier
        $query = "SELECT 
            modele.*, 
            marque.NomMarque, 
            GROUP_CONCAT(DISTINCT images.color) AS colors
            FROM 
                modele
            JOIN 
                marque ON modele.IdMarque = marque.IdMarque
            LEFT JOIN 
                images ON images.IdModele = modele.IdModele
            WHERE 
                modele.IdModele = ?
            GROUP BY 
                modele.IdModele;
          ";
        $stmt = mysqli_prepare($DB, $query);
        mysqli_stmt_bind_param($stmt, 'i', $modele_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if($result && mysqli_num_rows($result) > 0){
            $modele_found = true;
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $modele = $row["NomModele"];
            $marque = $row["NomMarque"];
            $id = $row["IdModele"];
            $prix = $row["Prix"];
            $annee = $row["Annee"];
            $type = $row["TypeMoteur"];
            $carburant = $row["Carburant"];
            $description = $row["Description"];
            $transmission = $row["BoiteVitesse"];
           if($row["colors"]){
               $colors = explode(',', $row["colors"]);
           }
        }else{
            header("Location: /super-car/404.php"); // Redirection vers la page 404
            exit();
        }
    } else {
        header("Location: /super-car/404.php"); // Redirection vers la page 404
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../bootstrap-5.3.3-dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../stylesheets/navbar.css" rel="stylesheet">
    <link href="../stylesheets/model_details.css" rel="stylesheet">
    <script src="../js/model-details.js" type="module" defer></script>
    <title><?php echo $modele;?></title>
    <style>
        .img-carousel{
            max-height: 390px;
        }
        .thumbnail{
            max-height: 100px;
            max-width: 100px;
        }
    </style>
</head>
<body class="position-relative bg-dark-subtle">
<?php
include_once("../components/navbar.php");
?>

<div class="container my-5">
    <div class="row">
        <!-- Image principale -->
        <div class="col-md-6 images-container">
            <div id='carouselExampleIndicators' class='carousel slide'>
                <div class='carousel-indicators'>

                </div>
                <div class='carousel-inner'>

                </div>
                <button class='carousel-control-prev' type='button' data-bs-target='#carouselExampleIndicators' data-bs-slide='prev'>
                    <span class='carousel-control-prev-icon' aria-hidden='true'></span>
                    <span class='visually-hidden'>Previous</span>
                </button>
                <button class='carousel-control-next ' type='button' data-bs-target='#carouselExampleIndicators' data-bs-slide='next'>
                    <span class='carousel-control-next-icon' aria-hidden='true'></span>
                    <span class='visually-hidden'>Next</span>
                </button>
            </div>
            <div class="d-flex justify-content-center thumbnail-container my-3">

            </div>
        </div>
        <!-- Informations sur la voiture -->
        <div class="col-md-6">
            <h1 class="mb-3 brand-name"><?php echo $marque;?></h1>
            <h4 class="text-muted">Modèle : <span class="fw-bold"><?php echo $modele;?></span></h4>

            <div>
                <?php
                    if($row["colors"]){
                        echo "
                        <p class='mb-0 mt-2'>Images</p>
                        <select class='form-select mt-2 type-images-options' aria-label='Default select example'>
                            <option value='outside' selected>extérieur</option>
                            <option value='inside''>intérieur</option>
                        </select>
                        ";
                    }
                ?>
            </div>

            <div class="d-flex align-items-center my-3 colors-options">
                <?php
                    if($row["colors"]){
                        foreach ($colors as $color) {
                            echo "<div class='color-circle border-1' data-color='$color' style='background-color: $color;'></div>";
                        }
                    }
                ?>
            </div>

            <div class="details-card mt-4">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Modèle :</strong> <?php if($modele_found){echo $modele;}?></p>
                        <p><strong>Année :</strong> <?php if($modele_found){ echo $annee;} ?></p>
                        <p><strong>Prix :</strong> <?php if($modele_found){echo $prix;} ?>€</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Transmission :</strong> <?php if($modele_found){echo $transmission ;}?></p>
                        <p><strong>Type :</strong> <?php echo $type; ?></p>
                        <?php 
                            if($carburant){
                                echo "<p><strong>carburant :</strong>$carburant;</p>";
                            }
                        ?>
                    </div>
                </div>
                <button class="btn text-success more-details-btn">plus de details ...</button>
                <!-- /.tertiary -->
                <hr>
                <div class="d-none description-container">
                    <h5>Description</h5>
                    <p class="overflow-y-scroll description" style="max-height: 250px">
                        <?php if($modele_found){echo $description;} ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
</body>
</html>