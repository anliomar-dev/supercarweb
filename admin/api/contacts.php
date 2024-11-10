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
    if (isset($_GET['contact'])) {
      $contact = $_GET['contact'];
      
      // If 'contact' is 'all', retrieve all contact with pagination
      if ($contact == 'all') {
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;  // Default value of 1 if 'page' is not set
        echo get_all_rows("contacts", 2, $page);
      
      // If 'contact' is a numeric ID, handle different HTTP methods
      } elseif (is_numeric($contact)) {
        $contact_id = intval($contact);
          // Fetch contact info
          echo get_row_details("contacts", "IdContact", $contact_id);
      }else{
        $response = [
          'status' => 'error',
          'message' => 'paramètre contact est invalid'
          ];
        echo json_encode($response);
        exit;
      }
    }else{
      $response = [
        'status' => 'error',
        'message' => 'le paramètre contact est manquant'
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
    $first_name = $data['first_name'] ?? '';
    $last_name = $data['last_name'] ?? '';
    $phone = $data['phone'] ?? '';
    $email = $data['email'] ?? '';
    $csrf_token = $data['csrfToken'];
    // create associated array for new user: the name of each key is the same as the name of the column in the database
    $new_contact = [
      'Prenom' => $first_name,
      'Nom' => $last_name,
      'NumTel' => $phone,
      'Email' => $email,
    ];
    
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
        $password = $data['password'] ? $data['password'] : '';
        // check if all fields are not empty
        if (!empty($first_name) && !empty($last_name) 
            && !empty($phone) && !empty($email)) {
        
          // verify is the email is already taken (funciton is_email_already_exist is defined in super-car/php/utils.php)
          $is_contact_already_exist = is_email_already_exist($email);
          if ($is_contact_already_exist){
            $response = [
                'status' => 'error',
                'message' => 'Un contact avec cet email existe deja.'
                ];
          }else{
              
              $result = create_contact($first_name, $last_name, $phone, $email);
              if($result){
                  $response = [
                      'status' => 'success',
                      'message' => 'Votre compte a été crée avec succès.',
                  ];
              }else{
                  $response = [
                      'status' => 'error',
                      'message' => 'erreur lors de l\'ajout du nouveau contact',
                  ];
              }
            }
        }else{
          $response = [
            'status' => 'error',
            'message' => 'tous les champs doivent être remplis'
          ];
        }
        break;
      
      case 'PUT':
        $contact_id = intval($data['contact_id']);
        break;
      
      case 'DELETE':
        $contact_id = intval($data['contact_id']);
        $delete_contact = delete_rows($contact_id, 'contacts', 'IdContact');
        if($delete_contact){
          $response = [
            'status' => 'success',
            'message' => 'Contact supprimé avec succès'
          ];
        }else{
          $response = [
            'status' => 'error',
            'message' => 'erreur lors de la suppression du contact',
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
