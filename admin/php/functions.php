<?php
  include_once('connexionDB.php');
  // Database connection
  

  function is_ressource_exists($db, $param, $table, $row_id_name){
    $page_404 = "/404.php";
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
  header('Location: /admin/access_denied.html');
}
}
?>
