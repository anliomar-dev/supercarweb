<?php
// Database connection
global $DB;
include('../php/connexionDB.php');
header('Content-Type: application/json; charset=utf-8');

if(isset($_GET['brand_id'])){
$brand_id = intval($_GET['brand_id']);

// Validate brand_id
if ($brand_id <= 0) {
    http_response_code(400); // Bad request
    echo json_encode(['error' => 'Invalid brand_id parameter.']);
    exit;
}

// Prepare the SQL query
$query = "SELECT modele.*, marque.*
        FROM modele
        LEFT JOIN marque ON modele.IdMarque = marque.IdMarque
        WHERE modele.IdMarque = ?
        ORDER BY modele.IdModele";
$stmt = mysqli_prepare($DB, $query);
mysqli_stmt_bind_param($stmt, "i", $brand_id);
mysqli_stmt_execute($stmt);

// Get the result
$result = mysqli_stmt_get_result($stmt);

if ($result) {
    $models = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $model_id = $row['IdModele'];
        // Add the model to the array
        if (!isset($models[$model_id])) {
            $models[$model_id] = [
                'IdModele' => $row['IdModele'],
                'NomModele' => $row['NomModele'],
                'NomMarque' => $row['NomMarque'],
                'IdMarque' => $row['IdMarque'],
                'images' => []
            ];
        }
    }

    // Retrieve up to 3 images per model
    foreach ($models as $model_id => $model_data) {
        $image_query = "SELECT * FROM images 
                        WHERE IdModele = ? 
                        AND type ='outside'
                        ORDER BY IdImage
                        LIMIT 1";
        $image_stmt = mysqli_prepare($DB, $image_query);

        if ($image_stmt) {
            mysqli_stmt_bind_param($image_stmt, "i", $model_id);
            mysqli_stmt_execute($image_stmt);
            $image_result = mysqli_stmt_get_result($image_stmt);

            while ($row = mysqli_fetch_assoc($image_result)) {
                $models[$model_id]['images'][] = [
                    'Nom' => $row['Nom'],
                ];
            }
        }
    }
    // Convert data to JSON
    $data = array_values($models);
    if (empty($data)) {
        http_response_code(404);
        echo json_encode(['error' => 'No models associated with this brand.']);
    } else {
        echo json_encode([
            'models' => $data
        ]);
    }
}else{
    echo json_encode(['error' => 'No models found for the given brand_id.']);
}

// Close statement and connection
mysqli_stmt_close($stmt);
mysqli_close($DB);
} else {
http_response_code(400); // Bad request
echo json_encode(['error' => 'brand_id is required']);
}
?>
