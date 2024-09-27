<?php
	include("../fonctions.php");
	verifierAuthentification("../index.html", "../session_expire.html");
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if (isset($_POST['modifier_modele'])) {
			modifier_modele();
		}
	}
	if(isset($_GET["id"])){
		$IdModele = $_GET["id"];
		$selection = "SELECT * FROM modele 
		where IdModele = $IdModele";
		$curseur = mysqli_query($dbd, $selection);
		while($row = mysqli_fetch_array($curseur)){
			$IdModele = $row["IdModele"];
			$modele = $row["NomModele"];
			$prix = $row["Prix"];
			$annee = $row["Annee"];
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
	<div class="container d-flex align-items-center justify-content-center" style="height: 100vh;">
		<form class="container border border-black w-50" method="post">
		<h2 class="text-center mt-2 fw-normal text-decoration-underline">Modification</h2>
			<div class="row d-flex align-items-center justify-content-center mt-4">
				<div class="w-50 mb-1">
					<label for="" style="font-size: 18px;"><strong><u>Modèle</u>:</strong></label>
					<input type="text" name="nouveau_nom" class="form-control" value="<?php echo $modele;?>"></div>
			</div>
            <div class="row d-flex align-items-center justify-content-center">
				<div class="w-50 mb-1">
					<label for="" style="font-size: 18px;"><strong><u>Prix</u>:</strong></label>
					<input title="le prix doit au minimum <?php echo $prix;?> et ne peut pas être augmenter de plus de 25% (<?php echo $prix * 1.25;?>) en une seul fois" type="number" name="nouveau_prix" class="form-control" value="<?php echo $prix;?>" min="<?php echo $prix;?>" max="<?php echo $prix * 1.25;?>"></div>
			</div>
			<div class="row d-flex align-items-center justify-content-center mb-4">
				<div class="w-50 mb-1">
					<label for="" style="font-size: 18px;"><strong><u>Année</u>:</strong></label>
					<input type="number" name="nouveau_annee" class="form-control" value="<?php echo $annee;?>"></div>
			</div>
            
			<div class="row d-flex align-items-center justify-content-center mb-1">
				<input class="w-25" type="submit" name="modifier_modele" value="Modifier">
			</div>
			<div class="row d-flex align-items-center justify-content-center mb-4">
				<button class="w-25"><a href="modele_admin.php">Retour</a></button>
			</div>
		</form>
	</div>
</body>
</html>