<?php
// retrieve all essai in json without pagination to display on the calender
include '../../php/connexionDB.php';
include_once('../../php/utils.php');
$LOGIN_URL = "/super-car/admin/login";
$SESSION_EXPIRED_URL = "/super-car/admin/session_expired";
is_user_authenticated(2, $LOGIN_URL, $SESSION_EXPIRED_URL);
// Préparer la requête SQL
$sql = "SELECT * FROM essais";
$result = mysqli_query($DB, $sql);

if (mysqli_num_rows($result) > 0) {
    $essais = array();
    
    while ($row = mysqli_fetch_assoc($result)) {
        $essais[] = $row;
    }

    header('Content-Type: application/json');
    echo json_encode($essais);
} else {
    echo json_encode(array()); 
}

mysqli_close($DB);
?>
