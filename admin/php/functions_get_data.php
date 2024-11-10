<?php
  // Database connection
  include_once('../../php/connexionDB.php');
  include_once('../php/utils.php');

    /**
   * Returns all users in JSON format.
   *
   * @param int $page The page number for pagination.
   * @return json The JSON containing the list of users.
   */
  function get_all_users(int $page){
    global $DB;
    
    // Modify the query to fetch user details
    $count = "SELECT count(IdUtilisateur) AS total FROM utilisateur";
    
    // Execute the query
    $result = mysqli_query($DB, $count);
    $row = mysqli_fetch_assoc($result);
    $total = $row['total'];
    $limit = 10;
    $total_pages = ceil($total / $limit);
    $offset = ($page - 1) * $limit;
    if($page > $total_pages || $page <= 0 || !is_numeric($page)){
      // Initialize a default response
      $response = [
        'status' => 'error',
        'message' => 'invalid parameter page'
      ];
      return json_encode($response);
      mysqli_close($DB);
      exit;
    }

    $users = "SELECT * FROM utilisateur LIMIT ? OFFSET ?";
    $stmt = mysqli_prepare($DB, $users);
    mysqli_stmt_bind_param($stmt, "ii", $limit, $offset);
    mysqli_stmt_execute($stmt);
    $users_result = mysqli_stmt_get_result($stmt);
    if($users_result){
      // Initialize an array to hold all users
      $users = [];
      // Fetch each row and append to the $users array
      while ($row = mysqli_fetch_assoc($users_result)) {
        $users[] = [
          'id' => $row['IdUtilisateur'],
          'first_name' => $row['Prenom'],
          'last_name' => $row['Nom'],
          'email' => $row['Email']
        ];
      }
      
      // Return the array of users as JSON
      echo json_encode([
        'page' => $page,
        'total_pages' => $total_pages,
        'users' => $users
    ]);
    }
  }


  /**
 * Returns the details of the user whose ID is passed as a parameter.
 *
 * @param int $user_id The ID of the user to retrieve.
 * @return string JSON encoded data containing user information.
 */
  function get_user_details(int  $user_id){

    global $DB;
    if(is_numeric($user_id)){
      $user_id = intval($user_id);
      if(!is_user_exist($user_id)){
        $response = [
          'status' => 'error',
          'message' => 'Utilisateur non trouvé'
        ];
        echo json_encode($response);
        exit;
      }
      $user = "SELECT * FROM utilisateur WHERE IdUtilisateur = ?";
      $stmt = mysqli_prepare($DB, $user);
      mysqli_stmt_bind_param($stmt, "i", $user_id);
      mysqli_stmt_execute($stmt);

      $result = mysqli_stmt_get_result($stmt);
      if($row = mysqli_fetch_assoc($result)){
        $user = [
          "user_id" => $row['IdUtilisateur'],
          "first_name" => $row['Prenom'],
          "last_name" => $row['Nom'],
          "email" => $row['Email'],
          "address" => $row['Adresse'],
          "phone" => $row['NumTel'],
          "is_admin" => $row['est_admin'],
          "is_superadmin" => $row['est_superadmin']
        ];
        return json_encode($user);
      }else{
        $response = [
          'status' => 'error',
          'message' => 'Utilisateur non trouvé'
        ];
        echo json_encode($response);
      }

    }else{
      $response = [
        'status' => 'error',
        'message' => 'l\'id de l\'utilisateur doit être un nombre entier'
      ];
      echo json_encode($response);
    }
  }

  /**
   * Returns all modeles in JSON format.
   *
   * @param int $brand_id The id brand we want to get all modeles.
   * @return json The JSON containing the list of modeles.
   */
  function get_all_models_by_brand(int $brand_id, $pages){
    global $DB;
    // Get total number of models for pagination
    $sql = "SELECT COUNT(*) AS total FROM modele WHERE IdMarque = ?";
    $stmt_sql = mysqli_prepare($DB, $sql);
    mysqli_stmt_bind_param($stmt_sql, "i", $brand_id);
    mysqli_stmt_execute($stmt_sql);
    $count = mysqli_stmt_get_result($stmt_sql);
    $total = mysqli_fetch_assoc($count)['total'];
    $limit = 2;
    $total_pages = ceil($total / $limit);

    $offset = ($page - 1) * $limit;

    // Query to retrieve models with pagination
    $query = "SELECT modele.*, marque.*
            FROM modele
            LEFT JOIN marque ON modele.IdMarque = marque.IdMarque
            WHERE modele.IdMarque = ?
            ORDER BY modele.IdModele
            LIMIT ? OFFSET ?";

    $stmt = mysqli_prepare($DB, $query);
    mysqli_stmt_bind_param($stmt, "iii", $brand_id, $limit, $offset);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result) {
        $models = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $model_id = $row['IdModele'];
            // Add the model to the array
            if (!isset($models[$model_id])) {
                $models[$model_id] = [
                    'IdModele' => $row['IdModele'],
                    'NomModele' => $row['NomModele'] ? $row['NomModele'] : 'Name not available',
                    'IdMarque' => $row['IdMarque'],
                    'NomMarque' => $row['NomMarque'],
                    'Annee' => $row['Annee'],
                    'Prix' => $row['Prix'],
                    'TypeMoteur' => $row['TypeMoteur'],
                    'logo' => $row['logo'],
                ];
            }
        }

        // Convert data to JSON
        $data = array_values($models);
        if (empty($data)) {
            http_response_code(404);
            echo json_encode(['error' => 'aucun modèle trouvé.']);
        } else {
            echo json_encode([
                'page' => $page,
                'total_pages' => $total_pages,
                'models' => $data
            ]);
        }
    } else {
        http_response_code(500); // Server error
        echo json_encode(['error' => 'Error retrieving data.']);
    }
  }


    /**
   * Returns paginated rows for a specific table in JSON format.
   *
   * @param string $table_name The name of the table.
   * @param int $limit The number of rows per page.
   * @param int $page The current page number.
   * @return string JSON containing the paginated list of data or an error message.
   */
  function get_all_rows(string $table_name, int $limit, int $page): string {
    global $DB;

    // Calculer l'offset pour la pagination
    $offset = ($page - 1) * $limit;

    // Préparer la requête SQL pour récupérer les lignes
    $query = "SELECT * FROM $table_name LIMIT ? OFFSET ?";
    $stmt = mysqli_prepare($DB, $query);
    
    if ($stmt === false) {
        die('Erreur lors de la préparation de la requête : ' . mysqli_error($DB));
    }

    // Lier les paramètres limit et offset
    mysqli_stmt_bind_param($stmt, "ii", $limit, $offset);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    $data = [];

    // Récupérer les lignes et les ajouter dans le tableau $data
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    // Récupérer le nombre total de lignes pour calculer le nombre de pages
    $total_query = "SELECT COUNT(*) as total FROM $table_name";
    $total_result = mysqli_query($DB, $total_query);
    $total_rows = mysqli_fetch_assoc($total_result)['total'];
    $total_pages = ceil($total_rows / $limit);

    // Retourner les données ou un message d'erreur si aucune ligne trouvée
    return !empty($data) ? json_encode([
        "page" => $page,
        "total_pages" => $total_pages,
        "data" => $data
    ]) : json_encode([
        "status" => "error",
        "message" => "Aucune donnée trouvée dans $table_name pour cette page"
    ]);
  }


    /**
   * Returns the details of the conhtact whose ID is passed as a parameter.
   *
   * @param int $contact_id The ID of the contact to retrieve.
   * @return string JSON encoded data containing contact information.
   */
  function get_row_details(string $table_name, string $row_id, int $id){
    global $DB;

    // Préparer la requête SQL
    $query = "SELECT * FROM $table_name WHERE $row_id = ?";
    $stmt = mysqli_prepare($DB, $query);

    if ($stmt === false) {
        die('Erreur lors de la préparation de la requête : ' . mysqli_error($DB));
    }

    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    // Vérifier si une ligne est trouvée
    if ($row = mysqli_fetch_assoc($result)) {
        return json_encode($row);
    } else {
        return json_encode([
            "status" => "error",
            "message" => "$table_name non trouvé"
        ]);
    }
  }


    /**
   * Returns rows for a specific table filtered by a foreign key with pagination.
   *
   * @param string $table_name The name of the table to query.
   * @param string $clause_row The name of the column to filter on.
   * @param mixed $clause_value The value to filter the results by.
   * @param string $name_row The data type of the clause value ('int' or 'string').
   * @param int $limit The number of results per page.
   * @param int $page The current page number.
   * @return string JSON containing the list of rows or an error message.
   */
  function get_rows_with_clause(
    string $table_name, 
    string $clause_row, 
    $clause_value, 
    string $name_row = "int", 
    int $limit = 2, 
    int $page = 1
  ) {
    global $DB;

    // Calculate the offset for pagination
    $offset = ($page - 1) * $limit;

    // Prepare the SQL query with the foreign key and pagination
    $query = "SELECT * FROM $table_name WHERE $clause_row = ? LIMIT ? OFFSET ?";
    $stmt = mysqli_prepare($DB, $query);
    
    if ($stmt === false) {
        // Handle query preparation error
        return json_encode([
            "status" => "error",
            "message" => "Error preparing the query"
        ]);
    }

    // Bind parameters (clause_value, limit, and offset) to the query
    if ($name_row === 'int') {
        mysqli_stmt_bind_param($stmt, "iii", $clause_value, $limit, $offset);
    } else {
        mysqli_stmt_bind_param($stmt, "sii", $clause_value, $limit, $offset);
    }

    // Execute the query
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    $data = [];

    // Fetch all rows and add them to the $data array
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    // Retrieve the total number of rows for pagination
    $total_query = "SELECT COUNT(*) as total FROM $table_name WHERE $clause_row = ?";
    $total_stmt = mysqli_prepare($DB, $total_query);
    
    // Bind parameter for the total query
    if ($name_row === 'int') {
        mysqli_stmt_bind_param($total_stmt, "i", $clause_value);
    } else {
        mysqli_stmt_bind_param($total_stmt, "s", $clause_value);
    }

    mysqli_stmt_execute($total_stmt);
    $total_result = mysqli_stmt_get_result($total_stmt);
    $total_rows = mysqli_fetch_assoc($total_result)['total'];
    $total_pages = ceil($total_rows / $limit);

    // Check if there are results and return the response in JSON format
    return !empty($data) ? json_encode([
        "page" => $page,
        "total_pages" => $total_pages,
        "data" => $data
    ]) : json_encode([
        "status" => "error",
        "message" => "No data found"
    ]);
  }
?>
