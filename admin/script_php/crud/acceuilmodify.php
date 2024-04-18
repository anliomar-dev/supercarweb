<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>

	<?php
        include("server.php");
        $selection = "SELECT TitreVideo, Video FROM acceuil;";
        $curseur = mysqli_query($dbd, $selection);
        $row = mysqli_fetch_array($curseur);
        if ($row) {
            $video = $row["Video"];
            $titre = $row["TitreVideo"];
    ?>
	<div class="container d-flex align-items-center justify-content-center mt-5 mb-5">
		<form class="container border border-black w-75" method="post">
		<h2 class="text-center mt-2 fw-normal text-decoration-underline">Modification de la page acceuil</h2>
			<div class="row d-flex align-items-center justify-content-center mt-4">
				<div class="w-50 mb-1">
					<label for="" style="font-size: 18px;"><strong><u>Titre de vidéo</u>:</strong></label>
					<input type="text" name="nouveau_titre" class="form-control" value="<?php echo $titre;?>"></div>
			</div>
            <div class="row d-flex align-items-center justify-content-center">
				<div class="w-50 mb-1">
					<label for="" style="font-size: 18px;"><strong><u>Vidéo</u>:</strong></label>
                    <img src="<?php echo $video;?>" class="img-thumbnail mb-2" name="image">
					<input class="form-control" type="file" name="nouveau_video">
                </div>
			</div>

		<?php
			}
			mysqli_free_result($curseur);
			mysqli_close($dbd);
		?>

		<?php
			include("server.php");
			$selection = "SELECT CadreModele, CadreImg, CadrePollution, CadrePrix FROM acceuil;";
			$curseur = mysqli_query($dbd, $selection);
			if ($curseur && mysqli_num_rows($curseur) > 0) {
				while ($row = mysqli_fetch_array($curseur)) {
					$cadremodele = $row["CadreModele"];
					$cadreimg = $row["CadreImg"];
					$cadrepollution = $row["CadrePollution"];
					$cadreprix = $row["CadrePrix"];
					if (!empty($cadremodele) && !empty($cadreimg) && !empty($cadrepollution) && !empty($cadreprix)) {
		?>

			<div class="row d-flex align-items-center justify-content-center">
				<div class="w-50 mb-1">
					<label for="" style="font-size: 18px;"><strong><u>Cadre modèle</u>:</strong></label>
					<input type="text" name="nouveau_prix" class="form-control" value="<?php echo $cadremodele;?>">
                </div>
			</div>
			<div class="row d-flex align-items-center justify-content-center">
				<div class="w-50 mb-1">
					<label for="" style="font-size: 18px;"><strong><u>Prix</u>:</strong></label>
					<input type="number" name="nouveau_debut" class="form-control" value="<?php echo $cadreprix;?>"></div>
			</div>
			<div class="row d-flex flex-column align-items-center justify-content-center mb-4">
				<div class="w-50">
					<label for="" style="font-size: 18px;"><strong><u>Image</u>:</strong></label>
					<img src="<?php echo $cadreimg;?>" class="img-thumbnail mb-2" name="image">
					<input class="form-control" type="file" name="nouveau_image">
				</div>
			</div>			
			<div class="row d-flex flex-column align-items-center justify-content-center mb-4">
				<div class="w-50">
					<label for="" style="font-size: 18px;"><strong><u>Pollution image</u>:</strong></label>
					<img src="<?php echo $cadrepollution;?>" class="img-thumbnail mb-2 d-flex flex-column" name="image">
					<input class="form-control" type="file" name="nouveau_image">
				</div>
			</div>
			
			<?php
					}
				}
					mysqli_free_result($curseur);
				} else {
					echo "Aucune donnée disponible.";
				}
				mysqli_close($dbd);
			?>

			<?php
				include("server.php");
				$selection = "SELECT ActualiteImg, ActualiteDescription, ActualiteLink FROM acceuil;";
				$curseur = mysqli_query($dbd, $selection);
				if ($curseur && mysqli_num_rows($curseur) > 0) {
					while ($row = mysqli_fetch_array($curseur)) {
						$actualiteimg = $row["ActualiteImg"];
						$description = $row["ActualiteDescription"];
						$link = $row["ActualiteLink"];
						if (!empty($actualiteimg) && !empty($description) && !empty($link)) {
			?>
			<div class="row d-flex flex-column align-items-center justify-content-center mb-4">
				<div class="w-50">
					<label for="" style="font-size: 18px;"><strong><u>Image</u>:</strong></label>
					<img src="<?php echo $actualiteimg;?>" class="img-thumbnail mb-2" name="image">
					<input class="form-control" type="file" name="nouveau_image">
				</div>
			</div>
			<div class="row d-flex align-items-center justify-content-center">
				<div class="w-50 mb-1">
					<label for="" style="font-size: 18px;"><strong><u>Description</u>:</strong></label>
					<textarea class="form-control" id="exampleFormControlTextarea1" rows="5" style="resize:none;"><?php echo $description;?></textarea>
			</div><div class="row d-flex align-items-center justify-content-center">
				<div class="w-50 mb-1">
					<label for="" style="font-size: 18px;"><strong><u>Lien de l'actualité</u>:</strong></label>
					<input type="text" name="nouveau_debut" class="form-control" value="<?php echo $link;?>"></div>
			</div>
			<?php
			}
		}
			mysqli_free_result($curseur);
		} else {
			echo "Aucune donnée disponible.";
		}
		mysqli_close($dbd);
	?>
			<div class="row d-flex align-items-center justify-content-center mb-1">
				<input class="w-25" type="submit" name="modifier_accueil" value="Modifier">
			</div>
			<div class="row d-flex align-items-center justify-content-center mb-4">
				<button class="w-25"><a href="accueil_admin.php">Retour</a></button>
			</div>
		</form>
	</div>

	<?php
    	include("server.php");
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if (isset($_POST['modifier_accueil'])) {
				modifier_evenements();
			}
		}
	?>
</body>
</html>