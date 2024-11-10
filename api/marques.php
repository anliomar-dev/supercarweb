<?php
include('../php/connexionDB.php');

$query = "
    SELECT 
        marque.IdMarque, 
        marque.NomMarque, 
        COUNT(modele.IdModele) AS NombreModeles
    FROM marque
    LEFT JOIN modele ON marque.IdMarque = modele.IdMarque
    GROUP BY marque.IdMarque, marque.NomMarque
";

// execute query
$curseur = mysqli_query($DB, $query);

// check if query is executed seccessfully
if (!$curseur) {
    http_response_code(500); // internal server error
    echo json_encode(['error' => 'Erreur lors de la récupération des données']);
    exit;
}

// 
$donnees = mysqli_fetch_all($curseur, MYSQLI_ASSOC);

// close connexion db
mysqli_close($DB);

// header
header('Content-Type: application/json');

// convert and return data in json 
echo json_encode($donnees);
?>

