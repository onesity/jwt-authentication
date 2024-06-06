<?php

setcookie('token','',time()-3600,'/','', true,true );
header('location:login.php');
?>