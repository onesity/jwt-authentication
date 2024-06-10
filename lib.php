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

function send_email()
{

    // Load Composer's autoloader
//     require 'vendor/autoload.php';

//     // Create a new PHPMailer instance
//     $mail = new PHPMailer(true);

//     try {
//         // Server settings
//         $mail->isSMTP();                                      // Set mailer to use SMTP
//         $mail->Host = 'smtp.gmail.com';                     // Specify main and backup SMTP servers
//         $mail->SMTPAuth = true;                               // Enable SMTP authentication
//         $mail->Username = 'krishan.yatharthriti@gmail.com';           // SMTP username
//         $mail->Password = 'uryv bsmd uawg nfsu';                    // SMTP password
//         $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
//         $mail->Port = 465;                                    // TCP port to connect to

//         // Recipients
//         $mail->setFrom('krishan.yatharthriti@gmail.com');
//         $mail->addAddress('nishit.yatharthriti@gmail.com');     // Add a recipient

//         // Content
//         $mail->isHTML(true);                                  // Set email format to HTML
//         $mail->Subject = 'Here is the subject';
//         $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
//         $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

//         $mail->send();
//         echo 'Message has been sent';
//     } catch (Exception $e) {
//         echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
//     }
//     $to = 'nishit.yatharthriti@gmail.com';
// $subject = 'Subject of the email';
// $message = 'This is the body of the email.';
// $headers = 'From: krishan.yatharthriti@gmail.com' . "\r\n" .
//            'Reply-To: krishan.yatharthriti@gmail.com' . "\r\n" .
//            'X-Mailer: PHP/' . phpversion();

// if(mail($to, $subject, $message, $headers)) {
//     echo 'Email sent successfully!';
// } else {
//     echo 'Email sending failed.';
// }
}

?>