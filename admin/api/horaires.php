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
    if (isset($_GET['horaire'])) {
      $horaire = $_GET['horaire'];
      
      // If 'event' is 'all', retrieve all events with pagination
      if ($horaire == 'all') {
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;  // Default value of 1 if 'page' is not set
        echo get_all_rows("horaires", 8, $page);
      
      // If 'event' is a numeric ID, handle different HTTP methods
      } elseif (is_numeric($horaire)) {
        $horaire_id = intval($horaire);
          // Fetch event info
          echo get_row_details("horaires", "IdHoraire", $horaire_id);
      }else{
        $response = [
          'status' => 'error',
          'message' => 'paramètre horaire est invalid'
          ];
        echo json_encode($response);
        exit;
      }
    }else{
      $response = [
        'status' => 'error',
        'message' => 'le paramètre horaire est manquant'
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
        $horaire_id = intval($data['horaire_id']);
        break;
      
      case 'DELETE':
        $horaire_id = intval($data['horaire_id']);
        $delete_horaires = delete_rows($horaire_id, 'horaires', 'IdHoraire');
        if($delete_horaires){
          $response = [
            'status' => 'success',
            'message' => 'horaire supprimé avec succès'
          ];
        }else{
          $response = [
            'status' => 'error',
            'message' => 'erreur lors de la suppression.',
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
