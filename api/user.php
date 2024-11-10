<?php
    // Database connection
    include_once('../php/connexionDB.php');
    include_once('../php/utils.php');
    // Set the content type as JSON
    header('Content-Type: application/json; charset=utf-8');

    // Initialize a default response
    $response = [
        'status' => 'error',
        'message' => 'Method not allowed'
    ];

    // Check if the request method is POST, PUT, or DELETE
    if ($_SERVER['REQUEST_METHOD'] === 'POST' || $_SERVER['REQUEST_METHOD'] === 'PUT' || $_SERVER['REQUEST_METHOD'] === 'DELETE') {
        // Get the request body
        $input = file_get_contents('php://input');
        
        // Convert the received JSON data into an associative array
        $data = json_decode($input, true);
        
        // Check if the JSON data is valid
        if (json_last_error() === JSON_ERROR_NONE) {
            // Get the action option to perform
            $action = $data['action'];

            switch ($action) {
                //case create for creating nuw user
                case 'create':
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        $first_name = $data['first_name'];
                        $last_name= $data['last_name'];
                        $address = $data['address'];
                        $phone = $data['phone'];
                        $email = $data['email'];
                        $password = $data['password'];
                        //verify id the email is already taken(funciton is_email_already_exist is defined in super-car/php/utils.php)
                        $is_email_already_taken = is_email_already_exist($email);
                        if ($is_email_already_taken){
                            $response = [
                                'status' => 'error',
                                'message' => 'Un compte avec cet email existe deja.'
                                ];
                        }else{
                            //create new user(funciton create_uesr() is defined in super-car/php/utils.php)
                            $result = create_user($first_name, $last_name, $address, $phone, $email, $password);
                            if($result){
                                $response = [
                                    'status' => 'success',
                                    'message' => 'Votre compte a été crée avec succès.',
                                ];
                            }else{
                                $response = [
                                    'status' => 'error',
                                    'message' => 'cannot create account: internal server error',
                                ];
                            }
                        }
                    } else {
                        $response['message'] = 'Http Method not allowed.';
                    }
                    break;
                case 'login':
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        $email = $data['email'];
                        $password = $data['password'];
                        //create new user(funciton login() is defined in super-car/php/utils.php)
                        $is_authenticated = login($email, $password);
                        if($is_authenticated){
                            $response = [
                                'status' => 'success',
                                'message' => 'Authentification réussi',
                            ];
                        }else{
                            $response = [
                                'status' => 'error',
                                'message' => 'Invalid email or password',
                            ];
                        }
                    } else {
                        $response['message'] = 'Method not allowed for login';
                    }
                    break;
                default:
                    $response = [
                        'status' => 'error',
                        'message' => 'Unrecognized action'
                    ];
                    break;
            }
        } else {
            $response = [
                'status' => 'error',
                'message' => 'Invalid JSON format'
            ];
        }
    }

    // Return the response as JSON
    echo json_encode($response);
?>
