<?php
    include_once('connexionDB.php');
    function login($email, $password) {
        global $DB;
        $response = [
            'status' => 'error',
            'message' => 'email et/ou mot de passe invalid'
        ];
        // query
        $query = "SELECT * FROM utilisateur WHERE Email = ?";
        // prepare query
        $stmt = mysqli_prepare($DB, $query);
        mysqli_stmt_bind_param($stmt, 's', $email);
        // execute query
        mysqli_stmt_execute($stmt);

        // get the result of the query
        $result = mysqli_stmt_get_result($stmt);

        // check if there a user registered with this email
        if ($user = mysqli_fetch_assoc($result)) {
            // check the password
            if (password_verify($password, $user['MotDePasse'])) {
                // the user is authenticated
                session_start();
                // session variables
                $_SESSION['user_id'] = $user['IdUtilisateur'];
                $_SESSION['email'] = $user['Email'];
                $_SESSION['first_name'] = $user['Prenom'];
                $_SESSION['last_name'] = $user['Nom'];
                $_SESSION['is_admin'] = $user['est_admin'];
                $_SESSION['is_superadmin'] = $user['est_superadmin'];
    
                // generate CSRF token
                if (empty($_SESSION['csrf_token'])) {
                    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
                }
                // close query
                mysqli_stmt_close($stmt);
                return true;
            } else {
                // incorrect password
                mysqli_stmt_close($stmt);
                return false;
            }
        } else {
            // no user found with this email
            mysqli_stmt_close($stmt);
            return false;
        }
    }


function create_user(
    $firstname, 
    $lastname, 
    $address, 
    $phone, 
    $email, 
    $password
    ){
        global $DB;
        
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Prepare the SQL query
        $query = 'INSERT INTO utilisateur (Nom, Prenom, Adresse, NumTel, Email, MotDePasse)
                VALUES (?, ?, ?, ?, ?, ?)';
        
        // Prepare the statement
        if ($stmt = mysqli_prepare($DB, $query)) {
            // Bind the parameters
            mysqli_stmt_bind_param($stmt, 'ssssss', $firstname, $lastname, $address, $phone, $email, $hashed_password);
            
            // Execute the statement
            $result = mysqli_stmt_execute($stmt);
            // Close the statement
            mysqli_stmt_close($stmt);
            return $result;
        } else {
            // If the statement preparation failed
            echo "Failed to prepare the SQL statement.";
            return false;
        }
    }

    function is_email_already_exist($email){
        global $DB;
        $check_email_query = "SELECT email FROM utilisateur WHERE email = ?";
        // prepare query
        $stmt = mysqli_prepare($DB, $check_email_query);
        mysqli_stmt_bind_param($stmt, 's', $email);
        // execute query
        mysqli_stmt_execute($stmt);
        // get the result of the query
        $result = mysqli_stmt_get_result($stmt);
        // Check if any row is returned
        $email_exists = mysqli_num_rows($result) > 0;
        // Close the statement
        mysqli_stmt_close($stmt);

        // Return true if email exists, false otherwise
        return $email_exists;
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


function logout($login_url){
    if (isset($_POST["logout"])){
        session_unset();
        session_destroy();
        // redirect user to the signin page
        header("Location: $login_url");
        exit();
    }
}

/**
 * insert a new line in the table essai
 */
function new_essai($date, $heure, $idMarque, $idModele, $idUtilisateur){
    global $DB;

    $query = "INSERT INTO essais 
        (DateEssai, Heure, IdMarque, IdModele, IdUtilisateur)
        VALUES (?, ?, ?, ?, ?)
    ";
    $stmt = mysqli_prepare($DB, $query);
    if($stmt){
        mysqli_stmt_bind_param($stmt, "ssiii", $date, $heure, $idMarque, $idModele, $idUtilisateur);
        $result = mysqli_stmt_execute($stmt);
        // Close the statement
        mysqli_stmt_close($stmt);
    return $result;
    }else{
        return false;
    }
}

/**
 * check is a user is an admin( the account can be use in admin panel)
 *  @param int $user_id
 * @return  bool
 */
function is_user_admin($is_admin){
    // Check if the user is an admin.
    return $is_admin;
}

function is_user_not_admin_redirect($is_admin){
    // Check if the user is an admin.
    if(!$is_admin){
        // If the user is not an admin, redirect them to the login page.
        header('Location: /super-car/admin/access_denied.html');
    }
}
?>
