<?php
	include("../fonctions.php");
	verifierAuthentification("../index.html", "../session_expire.html");
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if (isset($_POST['modifier_voitures'])) {
			modifier_voitures();
		}
	}
	if(isset($_GET['id'])) {
		$IdVoiture = $_GET['id'];
		$selection = "SELECT * FROM voitures WHERE IdVoiture = $IdVoiture";
		$curseur = mysqli_query($dbd, $selection);
		while($row = mysqli_fetch_array($curseur)){
			$IdVoiture = $row["IdVoiture"];
			$IdModele = $row["IdModele"];
			$IdMarque = $row["IdMarque"];
			$couleur = $row["Couleur"];
			$typemoteur = $row["TypeMoteur"];
			$carburant = $row["Carburant"];
			$km = $row["Km"];
			$boitevitesse = $row["BoiteVitesse"];
			$image =$row["Image"];
		}
		$selection1 = "SELECT NomModele FROM modele WHERE IdModele = $IdModele";
		$curseur = mysqli_query($dbd, $selection1);
		while($row = mysqli_fetch_array($curseur)){
			$modele = $row["NomModele"];
		}
		mysqli_free_result($curseur);
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
		<h2 class="text-center mt-2 fw-normal text-decoration-underline">Modification de <?php echo $modele;?></h2>
			<div class="row d-flex align-items-center justify-content-center mt-4">
				<div class="w-50 mb-1 mt-1"><label for="" style="font-size: 18px;"><strong><u>Couleur</u>:</strong></label>
				<input type="text" class="form-control" name="nouveau_couleur" value="<?php echo $couleur;?>">
			</div>
			</div>
			<div class="row d-flex align-items-center justify-content-center">
				<div class="w-50 mb-1">
				<label for="" style="font-size: 18px;"><strong><u>Type de moteur</u>:</strong></label>	
				<select class="form-select" name="nouveau_TP">
					<?php if($typemoteur == "Thermique"): ?>
							<option selected><?php echo $typemoteur ?></option>
							<option>Electrique</option>
							<option>Hybride rechargeable</option>
						<?php elseif($typemoteur == "Electrique"): ?>
							<option selected><?php echo $typemoteur ?></option>
							<option>Thermique</option>
							<option>Hybride rechargeable</option>
						<?php elseif($typemoteur == "Hybride rechargeable"): ?>
							<option selected><?php echo $typemoteur ?></option>
							<option>Thermique</option>
							<option>Electrique</option>
						<?php elseif($typemoteur == ""): ?>
							<option selected></option>
							<option>Thermique</option>
							<option>Electrique</option>
							<option>Hybride rechargeable</option>
						<?php endif; ?>
				</select></div>
			</div>
			<div class="row d-flex align-items-center justify-content-center">
				<div class="w-50 mb-1">
					<label for="" style="font-size: 18px;"><strong><u>Carburant</u>:</strong></label>
					<select class="form-select" name="nouveau_carburant">
					<?php if($carburant == "essence"): ?>
						<option selected><?php echo $carburant ?></option>
						<option>Diesel</option>
					<?php elseif($carburant == ""): ?>
						<option selected><?php echo $carburant ?></option>
						<option>Essence</option>
						<option>Diesel</option>
					<?php endif; ?>
				</select></div>
			</div>
			<div class="row d-flex align-items-center justify-content-center">
				<div class="w-50 mb-1">
					<label for="" style="font-size: 18px;"><strong><u>KM</u>:</strong></label>
					<input type="number" class="form-control" name="nouveau_km" value="<?php echo $km;?>">
				</div>
			</div>
			<div class="row d-flex align-items-center justify-content-center">
				<div class="w-50">
					<label for="" style="font-size: 18px;"><strong><u>Boite de vitesse</u>:</strong></label>
					<input type="text" class="form-control mb-2" name="nouveau_BV" value="<?php echo $boitevitesse;?>">
				</div>
			</div>
			<div class="row d-flex flex-column align-items-center justify-content-center mb-4">
				<div class="w-50">
					<label for="" style="font-size: 18px;"><strong><u>Image</u>:</strong></label>
					<img src="<?php echo $image;?>" class="img-thumbnail mb-2">
					<input class="form-control" type="file" name="nouveau_image">
				</div>
			</div>
			<div class="row d-flex align-items-center justify-content-center mb-1">
				<input class="w-25" type="submit" name="modifier_voitures" value="Modifier">
			</div>
			<div class="row d-flex align-items-center justify-content-center mb-4">
				<button class="w-25"><a href="voitures_admin.php">Retour</a></button>
			</div>
		</form>
	</div>
</body>
</html>