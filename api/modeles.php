<?php
// Database connection
include('../php/connexionDB.php');
header('Content-Type: application/json; charset=utf-8');

// Check if brand_id parameter is set
if (isset($_GET['brand_id'])) {
    $brand_id = intval($_GET['brand_id']);

    // Validate brand_id
    if ($brand_id <= 0) {
        http_response_code(400); // Bad request
        echo json_encode(['error' => 'Invalid brand_id parameter.']);
        exit;
    }

    // Check if the brand exists
    $check_brand_query = "SELECT COUNT(*) as count FROM marque WHERE IdMarque = ?";
    $check_stmt = mysqli_prepare($DB, $check_brand_query);
    mysqli_stmt_bind_param($check_stmt, "i", $brand_id);
    mysqli_stmt_execute($check_stmt);
    $result = mysqli_stmt_get_result($check_stmt);
    $brand_exists = mysqli_fetch_assoc($result)['count'] > 0;

    if (!$brand_exists) {
        http_response_code(404); // Brand not found
        echo json_encode(['error' => 'The brand does not exist.']);
        mysqli_close($DB);
        exit;
    }

    // Get total number of models for pagination
    $sql = "SELECT COUNT(*) AS total FROM modele WHERE IdMarque = ?";
    $stmt_sql = mysqli_prepare($DB, $sql);
    mysqli_stmt_bind_param($stmt_sql, "i", $brand_id);
    mysqli_stmt_execute($stmt_sql);
    $count = mysqli_stmt_get_result($stmt_sql);
    $total = mysqli_fetch_assoc($count)['total'];
    $limit = 2;
    $total_pages = ceil($total / $limit);

    // Current page
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($page - 1) * $limit;

    // Query to retrieve models with pagination
    $query = "SELECT modele.*, marque.*
            FROM modele
            LEFT JOIN marque ON modele.IdMarque = marque.IdMarque
            WHERE modele.IdMarque = ?
            ORDER BY modele.IdModele
            LIMIT ? OFFSET ?";

    $stmt = mysqli_prepare($DB, $query);
    mysqli_stmt_bind_param($stmt, "iii", $brand_id, $limit, $offset);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result) {
        $models = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $model_id = $row['IdModele'];
            // Add the model to the array
            if (!isset($models[$model_id])) {
                $models[$model_id] = [
                    'IdModele' => $row['IdModele'],
                    'NomModele' => $row['NomModele'] ? $row['NomModele'] : 'Name not available',
                    'IdMarque' => $row['IdMarque'],
                    'NomMarque' => $row['NomMarque'],
                    'Annee' => $row['Annee'],
                    'Prix' => $row['Prix'],
                    'TypeMoteur' => $row['TypeMoteur'],
                    'logo' => $row['logo'],
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
                            LIMIT 3";
            $image_stmt = mysqli_prepare($DB, $image_query);

            if ($image_stmt) {
                mysqli_stmt_bind_param($image_stmt, "i", $model_id);
                mysqli_stmt_execute($image_stmt);
                $image_result = mysqli_stmt_get_result($image_stmt);

                while ($row = mysqli_fetch_assoc($image_result)) {
                    $models[$model_id]['images'][] = [
                        'id' => $row['IdImage'],
                        'Nom' => $row['Nom'],
                        'type' => $row['type'],
                        'color' => $row['color']
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
                'page' => $page,
                'total_pages' => $total_pages,
                'models' => $data
            ]);
        }
    } else {
        http_response_code(500); // Server error
        echo json_encode(['error' => 'Error retrieving data.']);
    }

    // Close database connection
    mysqli_close($DB);
} else {
    http_response_code(400); // Bad request
    echo json_encode(['error' => 'Please specify an identifier.']);
}
?>
