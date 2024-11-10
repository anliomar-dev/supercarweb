<?php
  // Database connection
  include_once('../../php/connexionDB.php');
  include_once('../php/utils.php');
  include_once('../../php/utils.php');
  include_once('../php/functions_get_data.php');
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
    if (isset($_GET['event'])) {
      $event = $_GET['event'];
      
      // If 'event' is 'all', retrieve all events with pagination
      if ($event == 'all') {
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;  // Default value of 1 if 'page' is not set
        echo get_all_rows("evennement", 2, $page);
      
      // If 'event' is a numeric ID, handle different HTTP methods
      } elseif (is_numeric($event)) {
        $event_id = intval($event);
          // Fetch event info
          echo get_row_details("evennement", "IdEvennement", $event_id);
      }else{
        $response = [
          'status' => 'error',
          'message' => 'paramètre event est invalid'
          ];
        echo json_encode($response);
        exit;
      }
    }else{
      $response = [
        'status' => 'error',
        'message' => 'le paramètre event est manquant'
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
    
    // Check if the CSRF token is valid
    if($csrf_token !== $_SESSION['csrf_token']){
        $response = [
          'status' => 'error',
          'message' => 'token  csrf non valid'
        ];
        echo json_encode($response);
        exit;
    }

    // Handle different HTTP methods
    switch ($method) {
      case 'POST':
        break;
      
      case 'PUT':
        $event_id = intval($data['event_id']);
        break;
      
      case 'DELETE':
        $event_id = intval($data['event_id']);
        $delete_events = delete_rows($event_id, 'evennement', 'IdEvennement');
        if($delete_events){
          $response = [
            'status' => 'success',
            'message' => 'evennement supprimé avec succès'
          ];
        }else{
          $response = [
            'status' => 'error',
            'message' => 'erreur lors de la suppression de l\'évennement.',
          ];
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
