<?php
define('DB_HOST', 'LocalHost');
define('DB_USER', 'a25patnimram_apidaw');       
define('DB_PASS', 'Patrick_18');        
define('DB_NAME', 'a25patnimram_apidaw');       

$conexion = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if (!$conexion) {
    die('Error de connexió: ' . mysqli_connect_error());
}

mysqli_set_charset($conexion, 'utf8');
