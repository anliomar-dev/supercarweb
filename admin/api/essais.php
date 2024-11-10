<?php
  // Database connection
  include_once('../../php/connexionDB.php');
  include_once('../php/utils.php');
  include_once('../../php/utils.php');
  include_once('../php/functions_get_data.php');
  include_once('../php/del-update_functions.php');
  $LOGIN_URL = "/super-car/admin/login";
  $SESSION_EXPIRED_URL = "/super-car/admin/session_expired";
  is_user_authenticated(2, $LOGIN_URL, $SESSION_EXPIRED_URL);
  // Set the content type as JSON
  header('Content-Type: application/json; charset=utf-8');

  // Initialize response array
  $response = [
    'status' => 'error',
    'message' => 'HTTP method not allowed'
  ];
  // Check if the request method is GET
  if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['essai'])) {
      $essai = $_GET['essai'];
      
      // If 'event' is 'all', retrieve all events with pagination
      if ($essai == 'all') {
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;  // Default value of 1 if 'page' is not set
        echo get_all_rows("essais", 2, $page);
      
      // If 'event' is a numeric ID, handle different HTTP methods
      } elseif (is_numeric($essai)) {
        $essai_id = intval($essai);
          // Fetch event info
          echo get_row_details("essais", "IdEssai", $essai_id);
      }else{
        $response = [
          'status' => 'error',
          'message' => 'paramètre essai est invalid'
          ];
        echo json_encode($response);
        exit;
      }
    }else{
      $response = [
        'status' => 'error',
        'message' => 'le paramètre essai est manquant'
      ];
      echo json_encode($response);
      exit;
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
        break;
      
      case 'PUT':
        // Validate the CSRF token
        if(!is_csrf_valid($csrf_token, $_SESSION['csrf_token'])){
          $response = return_msg_json("403", 'token csrf non valid');
          echo json_encode($response);
          exit;
        }
        $essai_id = intval($data['essai_id']);
        break;
      
      case 'DELETE':
        $ids = $data['ids'];
        $delete_essais = delete_rows('essais', 'IdEssai', $ids);
        if($delete_essais){
          $response = return_msg_json("success", 'Essai(s) supprimées avec succès');
        }else{
          $response = return_msg_json("error", 'erreur lors de la suppression des essais');
        }
        break;
      
      default:
        // HTTP method not allowed
        $response = [
          'status' => 'error',
          'message' => 'HTTP method not allowed'
        ];
        break;
    }
    echo json_encode($response);
    exit;
  }
  //https://pdtfvsz7-80.asse.devtunnels.ms/
?>
