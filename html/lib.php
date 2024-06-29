<?php

require_once('../vendor/autoload.php');
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

function send_email($email, $subject, $body,)
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
        $mail->addAddress($email);    

        // Content
        $mail->isHTML(true);                          
        $mail->Subject = $subject;
        $mail->Body    = $body;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        return true;
    } catch (Exception $e) {
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }
}

function sidenavbar()
{
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




function success_modal($msg)
{
    echo '
    <style>
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 20px;
    background-color: #f4f4f4;
}

button {
    padding: 10px 20px;
    font-size: 16px;
    cursor: pointer;
    border: none;
    background-color: #4CAF50;
    color: white;
    border-radius: 5px;
}

.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1000; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgba(0,0,0,0.5); /* Black w/ opacity */
    align-items: center;
    justify-content: center;
    display: flex;
}

.modal-content {
    background-color: #fff;
    margin: auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
    max-width: 500px;
    text-align: center;
    border-radius: 10px;
    position: relative;
}

.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
    position: absolute;
    top: 10px;
    right: 20px;
    cursor: pointer;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}
</style>

    <!-- Modal Structure -->
    <div id="successModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Success!</h2>
            <p>' . $msg . '</p>
        </div>
    </div>

    <script>
    var modal = document.getElementById(\'successModal\');
    modal.style.display = \'flex\';

    // Close modal after 3 seconds and reload the page
    setTimeout(function() {
        modal.style.display = \'none\';
    window.location.href=\'locations.php\';
    }, 3000);

document.querySelector(\'.close\').addEventListener(\'click\', function() {
    var modal = document.getElementById(\'successModal\');
    modal.style.display = \'none\';
});

// Close the modal if the user clicks anywhere outside of the modal content
window.onclick = function(event) {
    var modal = document.getElementById(\'successModal\');
    if (event.target == modal) {
        modal.style.display = \'none\';
    }
}
</script>
';
}
