<?php
  include_once('../php/connexionDB.php');
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
  
?>
