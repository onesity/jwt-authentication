<?php

require_once('vendor/autoload.php');
require_once("lib.php");

use Firebase\JWT\JWT;

header('Content-Type:application/json');
session_start();

$data = json_decode(file_get_contents('php://input'), true);
$action = $data['action'];

if ($action == 'signup' || $action == 'otp_verification') {
    global $otp;
    if ($action == 'signup') {

        $email = $data['email'];
        $password = $data['password'];

        $existing_query = "select * from user where email='$email'";
        $existing_query_result = mysqli_query($conn, $existing_query);

        if (mysqli_num_rows($existing_query_result) > 0) {
            $response = ['success' => false, 'msg' => 'Email already registered!'];
        } else {
            global $otp;
            $username = $data['username'];
            $timecreated = time();
            $role = 'user';
            $confirmed = 0;

            $querry = "insert into  user(username,email,password,role,confirmed,timecreated) values('$username','$email','$password','$role','$confirmed','$timecreated')";
            $subject = 'OTP for the registartion';
            $otp = rand(100000, 999999);
            $_SESSION['email'] = $data['email'];
            $_SESSION['otp'] = $otp;
            $_SESSION['otp_exipration_time'] = time() + 180;
            $body = "Your one time password for the account creation is  $otp, Please verify and do not share it with anyone.
            Thank You ";
            send_email($email, $subject, $body);

            $res = mysqli_query($conn, $querry);
            if ($res) {
                $response = ['success' => true, 'msg' => "An OTP is sent to your email $email. Please verify it."];
            } else {
                $response = ['success' => false, 'msg' => 'Something went wrong,please try again later!'];
            }
        }
    } else {
        if (time() > $_SESSION['otp_exipration_time']) {
            unset($_SESSION['otp']);
            unset($_SESSION['otp_exipration_time']);
            $response = ['success' => false, 'msg' => 'OTP expired!'];
        } else {
            $user_email = $_SESSION['email'];
            $user_otp = $data['otp'];
            if ($user_otp == $_SESSION['otp']) {
                $querry = "update user set confirmed=1 where email='$user_email'";
                mysqli_query($conn, $querry);
                unset($_SESSION['otp']);
                unset($_SESSION['otp_exipration_time']);
                unset($_SESSION['email']);
                $response = ['success' => true, 'msg' => 'Your account created successfully!'];
            } else {
                $response = ['success' => false, 'msg' => 'Please enter correct OTP!'];
            }
        }
    }
    echo json_encode($response);
    exit;
}

if ($action == 'login') {

    $email = $data['email'];
    $password = $data['password'];

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

if ($action == 'resend_otp') {
    unset($_SESSION['otp']);
    unset($_SESSION['otp_exipration_time']);
    $otp = rand(100000, 999999);
    $_SESSION['otp'] = $otp;
    $_SESSION['otp_exipration_time'] = time() + 180;
    $email = $_SESSION['email'];
    $subject = 'OTP for the registartion';
    $body = "Your one time password for the account creation is  $otp, Please verify and do not share it with anyone.
    Thank You ";
    send_email($email, $subject, $body);
    $response = ['success' => true, 'msg' => "An OTP is resent to your email $email. Please verify it."];
    echo json_encode($response);
    exit;
}

if ($action == 'reset_password') {
    $email = $data['email'];
    $_SESSION['email'] = $email;
    $query = "select * from user where email='$email'";
    $res = mysqli_query($conn, $query);
    if (mysqli_num_rows($res) == 0) {
        $response = ['success' => false, 'msg' => "Email not registered!"];
    } else {
        $otp = rand(100000, 999999);
        $_SESSION['otp'] = $otp;
        $_SESSION['otp_exipration_time'] = time() + 180;
        $email = $_SESSION['email'];
        $subject = 'One time password for password reset for your account.';
        $body = "Your one time password for the password reset request is  $otp, Please verify and do not share it with anyone.
        Thank You ";
        send_email($email, $subject, $body);
        $response = ['success' => true, 'msg' => "An OTP is sent to your email $email to reset your password. Please verify it."];
    }
    echo json_encode($response);
    exit;
}
if ($action == 'verify_otp') {
    $otp = $_SESSION['otp'];
    $otp_expiration_time = $_SESSION['otp_exipration_time'];
    $_SESSION['is_otp_verified']=false;
    if (time() > $otp_expiration_time) {
        $response = ['success' => false, 'msg' => 'OTP is expired!'];
    } else {
        if ($otp == $data['otp']) {
            unset($_SESSION['otp']);
            unset($_SESSION['otp_exipration_time']);
            $_SESSION['is_otp_verified']=true;
            $response = ['success' => true, 'msg' => 'OTP verified!'];
        } else {
            $response = ['success' => false, 'msg' => 'Incorrect OTP!'];
        }
    }
    echo json_encode($response);
    exit;
}

if($action='upadte_password'){
    $email=$_SESSION['email'];
    $isOtpVerified=$_SESSION['is_otp_verified'];
    $password=$data['password'];
    if($isOtpVerified==true ){
        $query="update user set password='$password' where email='$email'";
        $res=mysqli_query($conn,$query);
        if($res!=false){
            $response = ['success' => true, 'msg' => 'Password updated successfully!'];
        }else{
            $response = ['success' => false, 'msg' => 'Email is not found!'];
        }
    }else{
        $response = ['success' => false, 'msg' => 'Please verify OTP!'];
    }
    echo json_encode($response);
    exit;
}