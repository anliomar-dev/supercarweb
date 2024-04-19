<?php
	include("../fonctions.php");
	verifierAuthentification("../index.php", "../session_expire.html"); 
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if (isset($_POST['modifier_accueil2'])) {
		modifier_accueil2();
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>

	<div class="container d-flex align-items-center justify-content-center mt-5 mb-5">
		<form class="container border border-black w-75" method="post">
			<h2 class="text-center mt-2 fw-normal text-decoration-underline">Modification de la page acceuil</h2>
			<?php
				$selection = "SELECT CadreModele, CadreImg, CadrePollution, CadrePrix, CadreLien FROM acceuil WHERE ID = 2;";
				$curseur = mysqli_query($dbd, $selection);
				while ($row = mysqli_fetch_array($curseur)) {
					$cadremodele = $row["CadreModele"];
					$cadreimg = $row["CadreImg"];
					$cadrepollution = $row["CadrePollution"];
					$cadreprix = $row["CadrePrix"];
                    $cadrelien = $row["CadreLien"];
			?>
				<div class="row d-flex align-items-center justify-content-center">
					<div class="w-50 mb-1">
						<label for="" style="font-size: 18px;"><strong><u>Cadre modèle</u>:</strong></label>
						<input type="text" name="nouveau_modele" class="form-control" value="<?php echo $cadremodele;?>">
					</div>
				</div>
				<div class="row d-flex align-items-center justify-content-center">
					<div class="w-50 mb-1">
						<label for="" style="font-size: 18px;"><strong><u>Prix</u>:</strong></label>
						<input type="number" name="nouveau_prix" class="form-control" value="<?php echo $cadreprix;?>"></div>
				</div>
                <div class="row d-flex align-items-center justify-content-center">
					<div class="w-50 mb-1">
						<label for="" style="font-size: 18px;"><strong><u>Lien button</u>:</strong></label>
						<input type="text" name="nouveau_lien" class="form-control" value="<?php echo $cadrelien;?>">
					</div>
				</div>
				<div class="row d-flex flex-column align-items-center justify-content-center mb-4">
					<div class="w-50">
						<label for="" style="font-size: 18px;"><strong><u>Image</u>:</strong></label>
						<img src="<?php echo $cadreimg;?>" class="img-thumbnail mb-2" name="image">
						<input class="form-control" type="file" name="nouveau_img">
					</div>
				</div>			
				<div class="row d-flex flex-column align-items-center justify-content-center mb-4">
					<div class="w-50">
						<label for="" style="font-size: 18px;"><strong><u>Pollution image</u>:</strong></label>
						<img src="<?php echo $cadrepollution;?>" class="img-thumbnail mb-2 d-flex flex-column" name="image">
						<input class="form-control" type="file" name="nouveau_polluimg">
					</div>
				</div>
				
				<?php
					}
					mysqli_close($dbd);
				?>
                <?php
				include("../server.php");
				$selection = "SELECT CadreModele, CadreImg, CadrePollution, CadrePrix, CadreLien FROM acceuil WHERE ID = 3;";
				$curseur = mysqli_query($dbd, $selection);
				while ($row = mysqli_fetch_array($curseur)) {
					$cadremodele = $row["CadreModele"];
					$cadreimg = $row["CadreImg"];
					$cadrepollution = $row["CadrePollution"];
					$cadreprix = $row["CadrePrix"];
                    $cadrelien = $row["CadreLien"];
			?>
				<div class="row d-flex align-items-center justify-content-center">
					<div class="w-50 mb-1">
						<label for="" style="font-size: 18px;"><strong><u>Cadre modèle</u>:</strong></label>
						<input type="text" name="nouveau_modele2" class="form-control" value="<?php echo $cadremodele;?>">
					</div>
				</div>
				<div class="row d-flex align-items-center justify-content-center">
					<div class="w-50 mb-1">
						<label for="" style="font-size: 18px;"><strong><u>Prix</u>:</strong></label>
						<input type="number" name="nouveau_prix2" class="form-control" value="<?php echo $cadreprix;?>"></div>
				</div>
                <div class="row d-flex align-items-center justify-content-center">
					<div class="w-50 mb-1">
						<label for="" style="font-size: 18px;"><strong><u>Lien button</u>:</strong></label>
						<input type="text" name="nouveau_lien2" class="form-control" value="<?php echo $cadrelien;?>">
					</div>
				</div>
				<div class="row d-flex flex-column align-items-center justify-content-center mb-4">
					<div class="w-50">
						<label for="" style="font-size: 18px;"><strong><u>Image</u>:</strong></label>
						<img src="<?php echo $cadreimg;?>" class="img-thumbnail mb-2" name="image">
						<input class="form-control" type="file" name="nouveau_img2">
					</div>
				</div>			
				<div class="row d-flex flex-column align-items-center justify-content-center mb-4">
					<div class="w-50">
						<label for="" style="font-size: 18px;"><strong><u>Pollution image</u>:</strong></label>
						<img src="<?php echo $cadrepollution;?>" class="img-thumbnail mb-2 d-flex flex-column" name="image">
						<input class="form-control" type="file" name="nouveau_polluimg2">
					</div>
				</div>
				
				<?php
					}
					mysqli_close($dbd);
				?>
				<div class="row d-flex align-items-center justify-content-center mb-1">
					<input class="w-25" type="submit" name="modifier_accueil2" value="Modifier">
				</div>
				<div class="row d-flex align-items-center justify-content-center mb-4">
					<button class="w-25"><a href="acceuil_admin.php">Retour</a></button>
				</div>
		</form>
	</div>
</body>
</html>