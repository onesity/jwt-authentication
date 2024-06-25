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

function sidenavbar(){
    echo '
      <div class="left-div">
      <h3 id="navigation_heading">Navigation</h3>
            <table id="nav_table">
                <tr id=\'table_row_home\' selected="true">
                    <td id="row_data" >
                    <i class="bi bi-house"></i><a href="index.php" id="nav_link">Home</a>
                    </td>
                </tr>
                <tr id=\'table_row_category\' selected="false">
                    <td id="row_data">
                    <i class="bi bi-house"></i><a href="category.php" id="nav_link">Category</a>
                    </td>
                </tr>
                <tr id=\'table_row_trip\' selected="false">
                    <td id="row_data">
                    <i class="bi bi-house"></i><a href="locations.php" id="nav_link">Trips</a>
                    </td>
                </tr>
                <tr id=\'table_row_bookings\' selected="false">
                    <td id="row_data">
                    <i class="bi bi-house"></i><a href="#" id="nav_link">Bookings</a>
                    </td>
                </tr>
                <tr id=\'table_row_payments\' selected="false">
                    <td id="row_data">
                    <i class="bi bi-house"></i><a href="#" id="nav_link">Payments</a>
                    </td>
                </tr>
            </table>
        </div>

        <script>
        window.addEventListener(\'load\', () => {
        const hamburger_btn = document.getElementById(\'hamburger_btn\');
        const left_div = document.querySelector(\'.left-div\');
            const right_div = document.querySelector(\'.right-div\');
            let toggle = 0;
            hamburger_btn.addEventListener(\'click\', () => {
                if (toggle == 0) {
                    left_div.style.width = \'0\';
                    left_div.style.transition = \'1s\';
                    right_div.style.width = \'100%\';
                    right_div.style.marginLeft = \'0\';
                    // hamburger_btn.style.marginLeft=\'10%\';
                    // right_div.style.marginLeft= \'0\';
                    hamburger_btn.innerHTML = \'&#9776\'
                    toggle = 1;
                } else {
                    left_div.style.width = \'16%\';
                    left_div.style.transition = "1s";
                    right_div.style.marginLeft = \'1%\';
                    right_div.style.width = \'81%\';
                    hamburger_btn.innerHTML = \'&#x2716;\'
                    toggle = 0;
                }
            })

        })
        const nav_table=document.querySelectorAll("tr");
        nav_table.forEach((e)=>{
            let selected =document.querySelector(\'[selected="true"]\')
            selected.style.backgroundColor=\'lightblue\';
            e.addEventListener(\'click\',(s)=>{
                let selected =document.querySelector(\'[selected="true"]\')
                selected.style.backgroundColor=\'white\';
                selected.setAttribute(\'selected\',false);
                e.style.backgroundColor=\'lightblue\';
                e.setAttribute(\'selected\',true);
            })
        })
        </script>
        ';
}




   


