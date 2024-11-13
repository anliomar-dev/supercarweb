<?php
  include_once('connexionDB.php');
  // Database connection
    /**
   * Check if a row exists in the database.
   *
   * @param int $id The ID to check.
   * @param string $table_name The name of the table.
   * @param string $row_id The name of the column representing the ID.
   * @return bool True if the row exists, false otherwise.
   */
  function is_row_exist($id, $table_name, $row_id) {
    global $DB; 

    $query = "SELECT 1 FROM $table_name WHERE $row_id = ? LIMIT 1";
    $stmt = mysqli_prepare($DB, $query);

    if ($stmt === false) {
        die('Erreur lors de la préparation de la requête : ' . mysqli_error($DB));
    }
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $exists = mysqli_num_rows($result) > 0;
    mysqli_stmt_close($stmt);

    return $exists;
  }

  function is_ressource_exists($db, $param, $table, $row_id_name){
    $page_404 = "/super-car/404.php";
    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
      if (isset($_GET[$param])) {
        $param_value = $_GET[$param];
        if ($param_value == 'all') {
          $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
          
        } elseif (is_numeric($param_value)) {
          $id = intval($param_value);
          $row_exist = is_row_exist($id, $table, $row_id_name);
          if (!$row_exist) {
            header("location: $page_404");
          }
          
        }else{
          header("location: $page_404");
        }
      }
    }
  }
  
  
  /**
 * Check if the user is authenticated and redirect to the login page if they are not authenticated
 * or redirect to the session expired page if the authentication session is expired
 */
function is_user_authenticated($times, $login_url, $session_expired) {
  // Session expiration timestamp
  $tempsExpiration = $times * 60; // 5 minutes
  // Start a new session if there is no session
  if (session_status() == PHP_SESSION_NONE) {
      session_start();
  }

  // Check if the session is active
  if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $tempsExpiration)) {
      // Logout user if the authentication session is expired
      session_unset();
      session_destroy();
      // Redirect to session expired page
      header("Location: $session_expired");
      exit();
  }

  // Check if the user is authenticated
  if (!isset($_SESSION['email'])) {
      // If the user is not authenticated, redirect to the signin page
      header("Location: $login_url");
      exit();
  }

  // Update the timestamp of the last activity
  $_SESSION['last_activity'] = time();
}
?>
