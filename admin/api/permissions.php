<?php
  // Database connection
  include_once('../../php/connexionDB.php');
  include_once('../php/functions.php');
  include_once('../../php/utils.php');
  include_once('../php/functions_get_data.php');
  
  // Set the content type as JSON
  header('Content-Type: application/json; charset=utf-8');

  // Initialize response array
  $response = [
    'status' => 'error',
    'message' => 'HTTP method not allowed'
  ];
  // Check if the request method is GET
  if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['perm'])) {
      $perm = $_GET['perm'];
      
      // If 'event' is 'all', retrieve all events with pagination
      if ($perm == 'all') {
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;  // Default value of 1 if 'page' is not set
        echo get_all_rows("permissions", 10, $page);
      
      // If 'event' is a numeric ID, handle different HTTP methods
      } elseif (is_numeric($perm)) {
        $perm_id = intval($perm);
          // Fetch event info
          echo get_row_details("permissions", "IdPermission", $perm_id);
      }else{
        $response = [
          'status' => 'error',
          'message' => 'paramètre perm est invalid'
          ];
        echo json_encode($response);
        exit;
      }
    }else{
      $response = [
        'status' => 'error',
        'message' => 'le paramètre perm est manquant'
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
        $group_id = intval($data['group_id']);
        break;
      
      case 'DELETE':
        $perm_id = intval($data['perm_id']);
        $delete_perms = delete_rows($goup_id, 'permissions', 'IdPermission');
        if($delete_groups){
          $response = [
            'status' => 'success',
            'message' => 'permission supprimée avec succès'
          ];
        }else{
          $response = [
            'status' => 'error',
            'message' => 'erreur lors de la suppression de la permission.',
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
