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
    if (isset($_GET['group'])) {
      $group = $_GET['group'];
      
      // If 'event' is 'all', retrieve all events with pagination
      if ($group == 'all') {
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;  // Default value of 1 if 'page' is not set
        echo get_all_rows("groupes", 2, $page);
      
      // If 'event' is a numeric ID, handle different HTTP methods
      } elseif (is_numeric($group)) {
        $group_id = intval($group);
          // Fetch event info
          echo get_row_details("groupes", "IdGroupe", $group_id);
      }else{
        $response = [
          'status' => 'error',
          'message' => 'paramètre group est invalid'
          ];
        echo json_encode($response);
        exit;
      }
    }else{
      $response = [
        'status' => 'error',
        'message' => 'le paramètre group est manquant'
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
        $group_id = intval($data['event_id']);
        $delete_groups = delete_rows($goup_id, 'groupes', 'IdGroupe');
        if($delete_groups){
          $response = [
            'status' => 'success',
            'message' => 'groupe supprimé avec succès'
          ];
        }else{
          $response = [
            'status' => 'error',
            'message' => 'erreur lors de la suppression du groupe.',
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
