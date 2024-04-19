<?php
	include("../fonctions.php");
	verifierAuthentification("../index.php", "../session_expire.html");
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if (isset($_POST['modifier_accueil'])) {
			modifier_accueil();
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

	<?php
        $selection = "SELECT TitreVideo, Video, Lien FROM acceuil WHERE ID = 1;";
        $curseur = mysqli_query($dbd, $selection);
		while($row = mysqli_fetch_array($curseur)) {	
            $video = $row["Video"];
            $titre = $row["TitreVideo"];
			$lien = $row["Lien"]
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
					<label style="font-size: 18px;"><strong><u>Vidéo</u>:</strong></label>
					<video autoplay loop muted src="<?php echo $video; ?>" class="img-thumbnail mb-2 d-flex flex-column"></video>
					<input type="file" class="form-control d-flex flex-column" name="nouveau_video">
				</div>
			</div>
			<div class="row d-flex align-items-center justify-content-center mt-4">
				<div class="w-50 mb-1">
					<label for="" style="font-size: 18px;"><strong><u>Lien de button</u>:</strong></label>
					<input type="text" name="nouveau_lien" class="form-control" value="<?php echo $lien;?>">
				</div>
			</div>

			<?php
				}
				mysqli_free_result($curseur);
				mysqli_close($dbd);
			?>
				<div class="row d-flex align-items-center justify-content-center mb-1">
					<input class="w-25" type="submit" name="modifier_accueil" value="Modifier">
				</div>
				<div class="row d-flex align-items-center justify-content-center mb-4">
					<button class="w-25"><a href="acceuil_admin.php">Retour</a></button>
				</div>
		</form>
	</div>
</body>
</html>