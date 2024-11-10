<?php
  // Database connection
  include_once('../../php/connexionDB.php');
  include_once('../../php/utils.php');
  include_once('../php/utils.php');
  include_once('../php/functions_get_data.php');
  include_once('../php/del-update_functions.php');
  session_start();
  // start new session if there is not a session
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
  // Check if the request method is POST
  if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['user'])) {
      $user = $_GET['user'];
      
      // If 'user' is 'all', retrieve all users with pagination
      if ($user == 'all') {
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;  // Default value of 1 if 'page' is not set
        echo get_all_users($page);
      
      // If 'user' is a numeric ID, handle different HTTP methods
      } elseif (is_numeric($user)) {
        $user_id = intval($user);
          echo get_user_details($user_id);  // Fetch user info
      }else{
        $response = [
          'status' => 'error',
          'message' => 'paramètre user est invalid'
          ];
        echo json_encode($response);
        exit;
      }
    }else{
      $page = isset($_GET['page']) ? intval($_GET['page']) : 1;  // Default value of 1 if 'page' is not set
      echo get_all_users($page);
    }
  }elseif(($_SERVER['REQUEST_METHOD'] === 'POST' || $_SERVER['REQUEST_METHOD'] === 'PUT' || $_SERVER['REQUEST_METHOD'] === 'DELETE')){
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
          $new_user_data = $data['user_data'];
          $is_email_already_taken = is_email_already_exist($new_user_data['Email']);
          if($is_email_already_taken){
            $response = return_msg_json("error", 'un compte utilisant cet email exite deja');
            echo json_encode($response);
            exit;
          }
          $new_user_data['MotDePasse'] = password_hash($new_user_data['MotDePasse'], PASSWORD_BCRYPT);
          $insert = insertRecord("utilisateur", $new_user_data);
          if($insert){
            $response = return_msg_json('success', 'utilisateur ajouté avec succès');
          }else{
            $response = return_msg_json('error', 'erreur lors de l\'ajout de l\'utilisateur');
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
          // Handle PUT request
          $user_id = $data['user_id'];
          $authenticated_userId = $data['loggedInUserID'];
          $user_data = $data['user_data'];
          $update_modele = update_record('utilisateur', 'IdUtilisateur', $user_id, $user_data);
          if($update_modele){
            $response = return_msg_json('success', 'les donées ont été mises a jour avec succès');
          }else{
            $response = return_msg_json('error', 'erreur lors de la modification');
          }
        }
        break;
      case 'DELETE':
        $ids = $data['ids'];
        $delete_user = delete_rows("utilisateur", "IdUtilisateur", $ids);
        if($delete_user){
          $response = return_msg_json("success", 'Compte(s) supprimé avec succès');
        }else{
          $response = return_msg_json("error", 'Erreur lors de la suppression');
        }
        break;
      
      default:
        // HTTP method not allowed
        $response = return_msg_json('error', 'HTTP method not allowed');
        break;
    }
    echo json_encode($response);
    exit;
  }
  //https://pdtfvsz7-80.asse.devtunnels.ms/
?>
