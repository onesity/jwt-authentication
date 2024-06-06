
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <h2>Authentication using JWT token</h2>
</body>
</html>

<?php

require_once('vendor/autoload.php');
$config=require_once('config.php');

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

$secret_key=$config['jwt-secret'];

if(isset($_COOKIE['token'])){
    $token=$_COOKIE['token'];
    $decoded=JWT::decode($token,new Key($secret_key,'HS256'));
  echo "<h1>Welcome back, ". $decoded->data->username ."</h1>
  <button id='logout_btn'> <a href='logout.php'>Logout</a></button>";
}else{
    header('location:login.php');
}


?>