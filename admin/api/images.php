<?php
// Database connection
include('../../php/connexionDB.php');
include_once('../php/functions_get_data.php');
header('Content-Type: application/json; charset=utf-8');

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    // Check if brand_id parameter is set
    if (isset($_GET['modele'])) {
        $modele_id = intval($_GET['modele']);
        // Current page
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        // Validate brand_id
        if ($modele_id <= 0) {
            http_response_code(400); // Bad request
            echo json_encode(['error' => 'Invalid brand_id parameter.']);
            exit;
        }
        $modele_exists = is_row_exist($modele_id, 'modele', 'IdModele');

        if (!$modele_exists) {
            http_response_code(404); // Brand not found
            echo json_encode(['error' => 'la marque n\'éxiste pas.']);
            mysqli_close($DB);
            exit;
        }
        echo get_rows_with_clause(
            "images", 
            "IdModele", 
            $modele_id, 
            "int", 
            $limit = 50, 
            $page
        );

        // Close database connection
        mysqli_close($DB);
    }else if(isset($_GET['image'])){
        $image_id = intval($_GET['image']);
        $image_exists = is_row_exist($image_id, 'images', 'IdImage');
        if (!$image_exists) {
            $response = [
                'status' => 'error',
                'message' => 'image non trouvé'
            ];
            echo json_encode($response);
            exit;
        }
        echo get_row_details("images", "IdImage", $image_id);
    }else {
        http_response_code(400); // Bad request
        echo json_encode(['error' => 'paramètre invalid(modele_id ou image.']);
        exit;
    }
}else if(($_SERVER['REQUEST_METHOD'] === 'POST' || $_SERVER['REQUEST_METHOD'] === 'PUT' || $_SERVER['REQUEST_METHOD'] === 'DELETE')){
    ;
}
?>
