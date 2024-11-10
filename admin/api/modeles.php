<?php
// Database connection
include('../../php/connexionDB.php');
include_once('../php/functions_get_data.php');
include_once('../php/del-update_functions.php');
include_once('../../php/utils.php');
include_once('../php/utils.php');
$LOGIN_URL = "/super-car/admin/login";
$SESSION_EXPIRED_URL = "/super-car/admin/session_expired";
is_user_authenticated(2, $LOGIN_URL, $SESSION_EXPIRED_URL);

header('Content-Type: application/json; charset=utf-8');
if($_SERVER['REQUEST_METHOD'] == 'GET'){
    // Check if brand_id parameter is set
    if (isset($_GET['brand_id'])) {
        $brand_id = intval($_GET['brand_id']);
        // Current page
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        // Validate brand_id
        if ($brand_id <= 0) {
            http_response_code(400); // Bad request
            echo json_encode(['error' => 'Invalid brand_id parameter.']);
            exit;
        }
        $brand_exists = is_row_exist($brand_id, 'marque', 'IdMarque');

        if (!$brand_exists) {
            http_response_code(404); // Brand not found
            echo json_encode(['error' => 'la marque n\'éxiste pas.']);
            mysqli_close($DB);
            exit;
        }
        echo get_rows_with_clause(
            "modele", 
            "IdMarque", 
            $brand_id, 
            "int", 
            $limit = 2, 
            $page
        );
    }else if(isset($_GET['modele'])){
        $modele = $_GET['modele'];
        // If 'contact' is 'all', retrieve all contact with pagination
        if ($modele == 'all') {
            $page = isset($_GET['page']) ? intval($_GET['page']) : 1;  // Default value of 1 if 'page' is not set
            echo get_all_rows("modele", 3, $page);
            // If 'contact' is a numeric ID, handle different HTTP methods
        } elseif (is_numeric($modele)) {
            $modele_id = intval($modele);
            // Fetch contact info
            echo get_row_details("modele", "IdModele", $modele_id);
        }else{
            $response = [
                'status' => 'error',
                'message' => 'paramètre modele est invalid'
                ];
            echo json_encode($response);
            exit;
        }
    }else {
        http_response_code(400); // Bad request
        echo json_encode(['error' => 'paramètre invalid(brand_id ou modele_id.']);
        exit;
    }
}else if(($_SERVER['REQUEST_METHOD'] === 'POST' || $_SERVER['REQUEST_METHOD'] === 'PUT' || $_SERVER['REQUEST_METHOD'] === 'DELETE')){
    $method = $_SERVER['REQUEST_METHOD'];
    // Get the request body
    $input = file_get_contents('php://input');  
    // Convert the received JSON data into an associative array
    $data = json_decode($input, true);

    // Handle different HTTP methods
    switch ($method) {
        case 'POST':
            $csrf_token = $data['csrf_token'] ?? '';
            if(!is_csrf_valid($csrf_token, $_SESSION['csrf_token'])){
                $response = return_msg_json("403", 'token csrf non valid');
                echo json_encode($response);
                exit;
            }else{
                // Handle POST request
                $authenticated_userId = $data['loggedInUserID'];
                $new_modele_data = $data['modele_data'];
                $is_modele_already_exist = is_row_exist($new_modele_data['NomModele'], 'modele', 'NomModele');
                if($is_modele_already_exist){
                    $response = return_msg_json("error", 'un modèle qui a exactement le même nom existe dèja');
                    echo json_encode($response);
                    exit;
                }
                $insert = insertRecord("modele", $new_modele_data);
                if($insert){
                    $response = return_msg_json('success', 'le modèle a été ajouté avec succès');
                }else{
                    $response = return_msg_json('error', 'erreur lors de l\'ajout du modèle');
                }
            }
            break;
        case 'PUT':
            $csrf_token = $data['csrf_token'] ?? '';
            if(!is_csrf_valid($csrf_token, $_SESSION['csrf_token'])){
                $response = return_msg_json("403", 'token csrf non valid');
                echo json_encode($response);
                exit;
            }else{
                // Handle POST request
                $authenticated_userId = $data['loggedInUserID'];
                $modele_data = $data['modele_data'];
                $id_modele = intval($data['IdModele']);
                $old_price = floatval($data['oldPrice']);
                $max_price = $old_price * 1.25;
                $new_price = floatval($modele_data['Prix']);
                if($new_price > $max_price){
                    $response = return_msg_json("max", "l'augmention du prix ne doit pas dépasser 25% du prix d\'origine max($max_price). voulez vous garder le prix maximum?", $max_price);
                    echo json_encode($response);
                    exit();
                }elseif($new_price < $old_price){
                    $response = return_msg_json("min", "le prix ne peut pas être inférieur au prix actuel. voulez vous grader le prix actuel?", $old_price);
                    echo json_encode($response);
                    exit();
                }
                $update_modele = update_record('modele', 'IdModele', $id_modele, $modele_data);
                if($update_modele){
                    $response = return_msg_json('success', 'les donées ont été mises a jour avec succès');
                }else{
                    $response = return_msg_json('error', 'erreur lors de la modification');
                }
            }
            break;
        
        case 'DELETE':
            $ids = $data['ids'];
            $delete_modeles = delete_rows("modele", "IdModele", $ids);
            if($delete_modeles){
            $response = return_msg_json("success", 'modele(s) supprimée(s) avec succès');
            }else{
            $response = return_msg_json("error", 'Erreur lors de la suppression du/des modele(s)');
            }
            break;
        default:
            // HTTP method not allowed
            $response = return_msg_json('error', 'HTTP method not allowed');
    }
    echo json_encode($response);
    exit;
}
?>
