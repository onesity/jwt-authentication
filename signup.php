<?php
include('header.php');
// require_once("lib.php");
// send_email();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>

    <link rel="stylesheet" href="style.css">
    <style>
        #username_error,
        #email_error,
        #password_error {
            color: red;
            margin-left: 20px;
            display: none;
        }

        #otp_field {

            width: 300px;
            height: 30px;
            margin-left: 20px;
            margin-top: 10px;

        }

   
    </style>
</head>

<body>
    <div class="form-div">
        <h2 id="form-heading">Create your account</h2>
        <form action="" id="signup_form">
            <input type="test" placeholder="username" name="username" id="username">
            <br>
            <span id="username_error">username error</span>
            <br><br>
            <input type="text" placeholder="email" name="email" id="email">
            <br>
            <span id="email_error">email error</span>
            <br><br>
            <input type="text" placeholder="password" name="password" id="password">
            <br>
            <span id="password_error">password error</span>
            <br><br>
            <input type="button" id='signup' placeholder="submit" value="Signup">
            <br><br>
            <span id="login-link">Already registered?</span>
            <a href="login.php"> Login</a>
        </form>
    </div>
    <script type='module' src="script.js"></script>
</body>

</html>
<?php
include('footer.php');

?>