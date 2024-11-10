<?php
global $DB;
include_once('../php/connexionDB.php');
include_once('../php/utils.php');

// Définir l'en-tête de la réponse JSON
header('Content-Type: application/json; charset=utf-8');

// Structure par défaut de la réponse JSON
$response = [
    "status" => "error",
    "message" => "Erreur lors de la requête",
];

$id_model = isset($_GET['modele']) ? intval($_GET['modele']) : null;

if ($id_model) {
    $query = "SELECT Nom, type, color FROM images WHERE IdModele = ?";
    $stm = mysqli_prepare($DB, $query);
    if ($stm) {
        mysqli_stmt_bind_param($stm, 'i', $id_model);
        mysqli_stmt_execute($stm);
        $result = mysqli_stmt_get_result($stm);
        if ($result && mysqli_num_rows($result) > 0) {
            $images = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $images[] = $row;
            }
            $response = [
                "status" => "success",
                "images" => $images,
            ];
        } else {
            $response["message"] = "Aucune image trouvée pour ce modèle.";
        }
        mysqli_stmt_close($stm);
    } else {
        $response["message"] = "Erreur lors de la préparation de la requête SQL.";
    }
} else {
    $response["message"] = "Identifiant du modèle non valide.";
}

echo json_encode($response);
?>
