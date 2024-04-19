<?php
	include("../fonctions.php");
	verifierAuthentification("../index.php", "../session_expire.html");
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if (isset($_POST['modifier_accueil3'])) {
		modifier_accueil3();
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
					$selection = "SELECT ActualiteImg, ActualiteDescription, ActualiteLink FROM acceuil WHERE ID = 4;";
					$curseur = mysqli_query($dbd, $selection);
					while ($row = mysqli_fetch_array($curseur)) {
						$actualiteimg = $row["ActualiteImg"];
						$description = $row["ActualiteDescription"];
						$link = $row["ActualiteLink"];
				?>
				<div class="row d-flex flex-column align-items-center justify-content-center mb-4">
					<div class="w-50">
						<label for="" style="font-size: 18px;"><strong><u>Image</u>:</strong></label>
						<img src="<?php echo $actualiteimg;?>" class="img-thumbnail mb-2" name="image">
						<input class="form-control" type="file" name="nouveau_actimg">
					</div>
				</div>
				<div class="row d-flex align-items-center justify-content-center">
					<div class="w-50 mb-1">
						<label for="" style="font-size: 18px;"><strong><u>Description</u>:</strong></label>
						<textarea name="nouveau_description" class="form-control" id="exampleFormControlTextarea1" rows="5" style="resize:none;"><?php echo $description;?></textarea>
				</div><div class="row d-flex align-items-center justify-content-center">
					<div class="w-50 mb-1">
						<label for="" style="font-size: 18px;"><strong><u>Lien de l'actualité</u>:</strong></label>
						<input type="text" name="nouveau_link" class="form-control" value="<?php echo $link;?>"></div>
				</div>
				<?php
					}
					mysqli_close($dbd);
				?>
                <?php
					include("../server.php");
					$selection = "SELECT ActualiteImg, ActualiteDescription, ActualiteLink FROM acceuil WHERE ID = 5;";
					$curseur = mysqli_query($dbd, $selection);
					while ($row = mysqli_fetch_array($curseur)) {
						$actualiteimg = $row["ActualiteImg"];
						$description = $row["ActualiteDescription"];
						$link = $row["ActualiteLink"];
				?>
				<div class="row d-flex flex-column align-items-center justify-content-center mb-4">
					<div class="w-50">
						<label for="" style="font-size: 18px;"><strong><u>Image</u>:</strong></label>
						<img src="<?php echo $actualiteimg;?>" class="img-thumbnail mb-2" name="image">
						<input class="form-control" type="file" name="nouveau_actimg2">
					</div>
				</div>
				<div class="row d-flex align-items-center justify-content-center">
					<div class="w-50 mb-1">
						<label for="" style="font-size: 18px;"><strong><u>Description</u>:</strong></label>
						<textarea name="nouveau_description2" class="form-control" id="exampleFormControlTextarea1" rows="5" style="resize:none;"><?php echo $description;?></textarea>
				</div><div class="row d-flex align-items-center justify-content-center">
					<div class="w-50 mb-1">
						<label for="" style="font-size: 18px;"><strong><u>Lien de l'actualité</u>:</strong></label>
						<input type="text" name="nouveau_link2" class="form-control" value="<?php echo $link;?>"></div>
				</div>
				<?php
					}
					mysqli_close($dbd);
				?>
                <?php
					include("../server.php");
					$selection = "SELECT ActualiteImg, ActualiteDescription, ActualiteLink FROM acceuil WHERE ID = 6;";
					$curseur = mysqli_query($dbd, $selection);
					while ($row = mysqli_fetch_array($curseur)) {
						$actualiteimg = $row["ActualiteImg"];
						$description = $row["ActualiteDescription"];
						$link = $row["ActualiteLink"];
				?>
				<div class="row d-flex flex-column align-items-center justify-content-center mb-4">
					<div class="w-50">
						<label for="" style="font-size: 18px;"><strong><u>Image</u>:</strong></label>
						<img src="<?php echo $actualiteimg;?>" class="img-thumbnail mb-2" name="image">
						<input class="form-control" type="file" name="nouveau_actimg3">
					</div>
				</div>
				<div class="row d-flex align-items-center justify-content-center">
					<div class="w-50 mb-1">
						<label for="" style="font-size: 18px;"><strong><u>Description</u>:</strong></label>
						<textarea name="nouveau_description3" class="form-control" id="exampleFormControlTextarea1" rows="5" style="resize:none;"><?php echo $description;?></textarea>
				</div>
                <div class="row d-flex align-items-center justify-content-center">
					<div class="w-50 mb-1">
						<label for="" style="font-size: 18px;"><strong><u>Lien de l'actualité</u>:</strong></label>
						<input type="text" name="nouveau_link3" class="form-control" value="<?php echo $link;?>"></div>
				</div>
				<?php
					}
					mysqli_close($dbd);
				?>
				<div class="row d-flex align-items-center justify-content-center mb-1">
					<input class="w-25" type="submit" name="modifier_accueil3" value="Modifier">
				</div>
				<div class="row d-flex align-items-center justify-content-center mb-4">
					<button class="w-25"><a href="acceuil_admin.php">Retour</a></button>
				</div>
		</form>
	</div>
</body>
</html>