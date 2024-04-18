<?php
	include("../fonctions.php");
	verifierAuthentification("../index.html", "../session_expire.html");
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if (isset($_POST['modifier_evenements'])) {
			modifier_evenements();
		}
	}

	if(isset($_GET["id"])){
		$IdEvenement = $_GET["id"];
		$selection = "SELECT * FROM evenement
		where IdEvenement = $IdEvenement
		order by DateDebut DESC";
		$curseur = mysqli_query($dbd, $selection);
		while($row = mysqli_fetch_array($curseur)){
			$IdEvenement = $row["IdEvenement"];
			$theme = $row["théme"];
			$debut = $row["DateDebut"];
			$fin = $row["DateFin"];
			$image = $row["image"];
			$prix = $row["Prix"];
			$location = $row["location"];
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
		<h2 class="text-center mt-2 fw-normal text-decoration-underline">Modification</h2>
			<div class="row d-flex align-items-center justify-content-center mt-4">
				<div class="w-50 mb-1">
					<label for="" style="font-size: 18px;"><strong><u>Localisation</u>:</strong></label>
					<input type="text" name="nouveau_location" class="form-control" value="<?php echo $location;?>"></div>
			</div>
            <div class="row d-flex align-items-center justify-content-center">
				<div class="w-50 mb-1">
					<label for="" style="font-size: 18px;"><strong><u>Thème</u>:</strong></label>
					<input type="text" name="nouveau_theme" class="form-control" value="<?php echo $theme;?>"></div>
			</div>
			<div class="row d-flex align-items-center justify-content-center">
				<div class="w-50 mb-1">
					<label for="" style="font-size: 18px;"><strong><u>Prix</u>:</strong></label>
					<input type="number" name="nouveau_prix" class="form-control" value="<?php echo $prix;?>"></div>
			</div>
			<div class="row d-flex align-items-center justify-content-center">
				<div class="w-50 mb-1">
					<label for="" style="font-size: 18px;"><strong><u>Date début</u>:</strong></label>
					<input type="date" name="nouveau_debut" class="form-control" value="<?php echo $debut;?>"></div>
			</div>
			<div class="row d-flex align-items-center justify-content-center">
				<div class="w-50">
					<label for="" style="font-size: 18px;"><strong><u>Date fin</u>:</strong></label>
					<input type="date" name="nouveau_fin" class="form-control mb-2" value="<?php echo $fin;?>"></div>
			</div>
			<div class="row d-flex flex-column align-items-center justify-content-center mb-4">
				<div class="w-50">
					<label for="" style="font-size: 18px;"><strong><u>Image</u>:</strong></label>
					<img src="../../images/evenements_images/<?php echo $image;?>" class="img-thumbnail mb-2" name="image">
					<input class="form-control" type="file" name="nouveau_image">
				</div>
			</div>
			<div class="row d-flex align-items-center justify-content-center mb-1">
				<input class="w-25" type="submit" name="modifier_evenements" value="Modifier">
			</div>
			<div class="row d-flex align-items-center justify-content-center mb-4">
				<button class="w-25"><a href="evenements_admin.php">Retour</a></button>
			</div>
		</form>
	</div>
</body>
</html>