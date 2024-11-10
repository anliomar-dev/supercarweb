<?php
  // Database connection
  include_once('../../php/connexionDB.php');
  include_once('../php/utils.php');
  include_once('../../php/utils.php');
  include_once('../php/functions_get_data.php');
  include_once('../php/del-update_functions.php');
  session_start();
  $LOGIN_URL = "/super-car/admin/login";
  $SESSION_EXPIRED_URL = "/super-car/admin/session_expired";
  //is_user_authenticated(2, $LOGIN_URL, $SESSION_EXPIRED_URL);
  // Set the content type as JSON
  header('Content-Type: application/json; charset=utf-8');

  // Initialize response array
  $response = [
    'status' => 'error',
    'message' => 'HTTP method not allowed'
  ];
  // Check if the request method is GET
  if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['marque'])) {
      $marque = $_GET['marque'];
      
      // If 'marque' is 'all', retrieve all marque with pagination
      if ($marque == 'all') {
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;  // Default value of 1 if 'page' is not set
        echo get_all_rows("marque", 30, $page);
      
      // If 'marque' is a numeric ID, handle different HTTP methods
      } elseif (is_numeric($marque)) {
        $marque_id = intval($marque);
          // Fetch event info
          echo get_row_details("marque", "IdMarque", $marque_id);
      }else{
        $response = [
          'status' => 'error',
          'message' => 'paramètre marque est invalid'
          ];
        echo json_encode($response);
        exit;
      }
    }else{
      $page = isset($_GET['page']) ? intval($_GET['page']) : 1;  // Default value of 1 if 'page' is not set
      echo get_all_rows("marque", 30, $page);
    }
  }elseif(($_SERVER['REQUEST_METHOD'] === 'POST' || $_SERVER['REQUEST_METHOD'] === 'PUT' || $_SERVER['REQUEST_METHOD'] === 'DELETE')){
    $method = $_SERVER['REQUEST_METHOD'];
    // Get the request body
    $input = file_get_contents('php://input');  
    // Convert the received JSON data into an associative array
    $data = json_decode($input, true);
    // Retrieve the CSRF token sent by the client
    $csrf_token = $data['csrf_token'] ?? '';
    // Handle different HTTP methods
    switch ($method) {
      case 'POST':
        // Validate the CSRF token
        if(!is_csrf_valid($csrf_token, $_SESSION['csrf_token'])){
          $response = return_msg_json("403", 'token csrf non valid');
          echo json_encode($response);
          exit;
        }
        $brand_data = $data['brand_data'];
        $brand_name = $brand_data['NomMarque'];
        $is_brand_already_exist = is_row_exist($brand_name, "marque", "NomMarque");
        if($is_brand_already_exist){
          $response = return_msg_json("400", 'marque deja existante');
          echo json_encode($response);
          exit;
        }
        $brand_logo = $brand_data['logo'];
        $insert = insertRecord("marque", ["NomMarque" => $brand_name, "logo"=> $brand_logo]);
        if($insert['success']){
          $response = return_msg_json('success', 'la marque a été ajouté avec succès');
        }else{
          $response = return_msg_json('error', 'erreur lors de l\'ajout de la marque');
        }
        break;
      case 'PUT':
        // Validate the CSRF token
        if(!is_csrf_valid($csrf_token, $_SESSION['csrf_token'])){
          $response = return_msg_json("403", 'token csrf non valid');
          echo json_encode($response);
          exit;
        }
        $marque_id = intval($data['IdMarque']);
        $authenticated_userId = $data['loggedInUserID'];
        $brand_data = $data['brand_data'];
        $update = update_record('marque', 'IdMarque', $marque_id, $brand_data);

        $response = $update ? return_msg_json('success', 'les donées ont été mises a jour avec succès') :
        $response = return_msg_json('error', 'erreur lors de la modification');
        break;
      case 'DELETE':
        $ids = $data['ids'];
        $delete_marques = delete_rows('marque', 'IdMarque', $ids);
        if($delete_marques){
          $response = return_msg_json("success", 'marques supprimées avec succès');
        }else{
          $response = return_msg_json("error", 'erreur lors de la suppression des marques');
        }
        break;
      default:
        // HTTP method not allowed
        $response = return_msg_json("error", 'méthode non autorisée');
        break;
    }
    echo json_encode($response);
    exit;
  }
  //https://pdtfvsz7-80.asse.devtunnels.ms/
?>
