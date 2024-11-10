<?php
  // start new session if there is not a session
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }
  // Database connection
  include_once('../php/connexionDB.php');
  include_once('../php/utils.php');
  header('Content-Type: application/json; charset=utf-8');

  if (!isset($_SESSION['user_id'])) {
    $response = [
      'status' => 'error',
      'message' => 'Vous devez vous connecter pour accéder à cette ressource',
    ];
    // Return the response as JSON
    echo json_encode($response);
    exit;
  } else {
    // get data
    $input = file_get_contents('php://input');
        
    // Convert the received JSON data into an associative array
    $data = json_decode($input, true);

    // Validate if required fields are present
    if (isset($data['date'], $data['heure'], $data['idMarque'], $data['idModele'])) {
      // Get essai data
      $date = $data['date'];
      $heure = $data['heure'];
      $id_marque = intval($data['idMarque']);
      $id_modele = intval($data['idModele']);
      $user_id = intval($_SESSION['user_id']);
      $csrf_token = $data['csrfToken'];
      // Validate CSRF token
      if ($csrf_token !== $_SESSION['csrf_token']) {
        $response = [
          'status' => 'error',
          'message' => 'Token CSRF non valide',
        ];
        echo json_encode($response);
      }else{
        // Insert essai data into database (function new_essai() defiened is super-car/php/utils.php)
        $response_new_essai = new_essai($date, $heure, $id_marque, $id_modele, $user_id);

        if ($response_new_essai) {
          echo json_encode(array(
            'status' => 'success',
            'message' => 'Demande d\'essai ajoutée avec succès'
          ));
        } else {
          $response = [
            'status' => 'error',
            'message' => 'Erreur lors de l\'ajout de l\'essai',
          ];
          echo json_encode($response);
        }
      }
    } else {
      // Handle missing required fields
      echo json_encode(array(
        'status' => 'error',
        'message' => 'Données manquantes'
      ));
    }
  }
?>
