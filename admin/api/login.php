<?php
    // Database connection
    include_once('../../php/connexionDB.php');
    include_once('../php/utils.php');
    // Set the content type as JSON
    header('Content-Type: application/json; charset=utf-8');
    // Initialize a default response
    $response = return_msg_json("error", 'Method not allowed');
    // Check if the request method is POST, PUT, or DELETE
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Get the request body
      $input = file_get_contents('php://input');
      
      // Convert the received JSON data into an associative array
      $data = json_decode($input, true);
      
      // Check if the JSON data is valid
      if (json_last_error() === JSON_ERROR_NONE) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          $email = trim($data['email']);
          $password = trim($data['password']);
          //create new user(funciton login() is defined in super-car/php/utils.php)
          $is_authenticated = login_admin($email, $password);
          if($is_authenticated){
            $response = return_msg_json("success", 'Authentification réussi');
          }else{
            $response = return_msg_json("error", 'email et/ou mot de passe incorrect');
          }
        } 
      } else {
        $response = return_msg_json("error", 'Invalid JSON format');
      }
    }else {
      $response = return_msg_json("error", 'Method not allowed for login');
    }
    // Return the response as JSON
    echo json_encode($response);
?>
