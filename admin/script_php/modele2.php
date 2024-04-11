<?php
	include("fonctions.php");
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
	<?php
		if(isset($_GET['id'])) {
			$id = $_GET['id'];
		}
		if(isset($_GET['modele_noms'])) {
			$modele = $_GET['modele_noms'];
		}
		if(isset($_GET['prix_modele'])) {
			$prix = $_GET['prix_modele'];
		}

		if(isset($_GET['id'])) {
			$id = mysqli_real_escape_string($dbd, $_GET['id']);
			$selection = "SELECT * FROM voitures WHERE IdModele = $id";
			$curseur = mysqli_query($dbd, $selection);
			while($row = mysqli_fetch_array($curseur)){
				$idvoiture = $row["IdVoiture"];
				$couleur = $row["Couleur"];
				$typemoteur = $row["TypeMoteur"];
				$carburant = $row["Carburant"];
				$km = $row["Km"];
				$boitevitesse = $row["BoiteVitesse"];
			}
			mysqli_free_result($curseur);
		}
		mysqli_close($dbd);
	?>

	<div class="container d-flex align-items-center justify-content-center" style="height: 100vh;">
		<form class="container border border-black w-50" method="post">
		<h2 class="text-center mt-2 fw-normal text-decoration-underline">Modification</h2>
			<div class="row d-flex align-items-center justify-content-center mt-5">
				<div class="w-50 mb-1"><label for="">Nom modèle :</label><input type="text" class="form-control" name="nouveau_nom" value="<?php echo $modele;?>"></div>
			</div>
			<div class="row d-flex align-items-center justify-content-center">
				<div class="w-50 mb-1"><input type="number" class="form-control" name="nouveau_prix" value="<?php echo $prix;?>"></div>
			</div>
			<div class="row d-flex align-items-center justify-content-center">
				<div class="w-50 mb-1"><input type="text" class="form-control" name="nouveau_couleur" value="<?php echo $couleur;?>"></div>
			</div>
			<div class="row d-flex align-items-center justify-content-center">
				<div class="w-50 d-flex mb-1"><select class="form-select" name="nouveau_TP">
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
							<option>Électrique</option>
						<?php elseif($typemoteur == ""): ?>
							<option selected></option>
							<option>Thermique</option>
							<option>Électrique</option>
							<option>Hybride rechargeable</option>
						<?php endif; ?>
				</select></div>
			</div>
			<div class="row d-flex align-items-center justify-content-center">
				<div class="w-50 mb-1"><select class="form-select" name="nouveau_carburant">
					<?php if($carburant == "Essence"): ?>
						<option selected><?php echo $carburant ?></option>
						<option>-</option>
					<?php elseif($carburant == "-"): ?>
						<option selected><?php echo $carburant ?></option>
						<option>Essence</option>
					<?php endif; ?>
				</select></div>
			</div>
			<div class="row d-flex align-items-center justify-content-center">
				<div class="w-50 mb-1"><input type="number" class="form-control" name="nouveau_km" value="<?php echo $km;?>"></div>
			</div>
			<div class="row d-flex align-items-center justify-content-center">
				<div class="w-50"><input type="text" class="form-control mb-2" name="nouveau_BV" value="<?php echo $boitevitesse;?>"></div>
			</div>
			<div class="row d-flex align-items-center justify-content-center mb-1">
				<input class="w-25" type="submit" name="modifier" value="Modifier">
			</div>
			<div class="row d-flex align-items-center justify-content-center mb-4">
				<button class="w-25"><a href="modele_admin.php">Retour</a></button>
			</div>
		</form>
	</div>
	<?php
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if (isset($_POST['modifier'])) {
				modifier();
			}
		}
	?>
</body>
</html>