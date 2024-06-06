<?php


require_once('vendor/autoload.php');
$config=require_once('config.php');
use Firebase\JWT\JWT;

$secret_key=$config['jwt-secret'];
$payload=[
    'iss'=>'mg_flexer',
    'iat'=>time(),
    'exp'=>time()+3600,
    'email'=>'mgflexer@gmail.com'
];

$jwt=JWT::encode($payload,$secret_key,'HS256');
echo "JWT: " . $jwt;




?>