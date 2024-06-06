<?php

require_once('vendor/autoload.php');
$config = require_once('config.php');

use Firebase\JWT\JWT;

header('Content-Type:application/json');

$data = json_decode(file_get_contents('php://input'), true);
$action = $data['action'];
$email = $data['email'];
$password = $data['password'];

if ($action == 'signup') {

    $existing_query = "select * from user where email='$email'";
    $existing_query_result = mysqli_query($conn, $existing_query);
    if (mysqli_num_rows($existing_query_result) > 0) {
        $response = ['success' => false, 'msg' => 'Email already registered!'];
    } else {
        $username = $data['username'];
        $timecreated = time();
        $role = 'user';

        $querry = "insert into  user(username,email,password,role,timecreated) values('$username','$email','$password','$role','$timecreated')";

        $res = mysqli_query($conn, $querry);
        if ($res) {
            $response = ['success' => true, 'msg' => 'Your account has been created successfully!'];
        } else {
            $response = ['success' => false, 'msg' => 'Something went wrong,please try again later!'];
        }
    }
    echo json_encode($response);
    exit;
}

if ($action == 'login') {
    $query = "select * from user where email='$email'";
    $res = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($res);

    if (mysqli_num_rows($res) != 0) {
        if ($password == $user['password']) {
            $secret_key = $config['jwt-secret'];
            $token = JWT::encode(
                array(
                    'iat' => time(),
                    'nbf' => time(),
                    'exp' => time() + 3600,
                    'data' => array(
                        'userid' => $user['id'],
                        'username' => $user['username'],
                        'email' => $user['email'],
                        'role' => $user['role'],
                    )
                ),
                $secret_key,
                'HS256'
            );
            setcookie('token', $token, time() + 3600, "/", "", true, true);
            $response = ['login' => true, 'msg' => 'Login successfully!'];
        } else {
            $response = ['login' => false, 'msg' => 'Please enter the correct username/password'];
        }
    } else {
        $response = ['login' => false, 'msg' => 'Please enter the correct username/password!'];
    }

    echo json_encode($response);
    exit;
}
