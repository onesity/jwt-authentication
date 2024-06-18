<?php


require_once('vendor/autoload.php');
$config = require_once('config.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

function is_login()
{
    global $config;
    $secret_key = $config['jwt-secret'];

    if (isset($_COOKIE['token'])) {
        $token = $_COOKIE['token'];
        $decoded = JWT::decode($token, new Key($secret_key, 'HS256'));
        return $decoded;
    } else {
        return false;
    }
}

function send_email($email,$subject,$body,)
{

    // Load Composer's autoloader
    require 'vendor/autoload.php';
    $google_app_password='ydll eyta jwst kyjv';

    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';                     // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'nishit.yatharthriti@gmail.com';           // SMTP username
        $mail->Password = 'ydll eyta jwst kyjv';                    // SMTP password
        $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 465;                                    // TCP port to connect to

        // Recipients
        $mail->setFrom($email);
        $mail->addAddress($email);     // Add a recipient

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    =$body;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        return true;
    } catch (Exception $e) {
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }
   
}

?>