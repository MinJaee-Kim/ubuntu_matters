<?php
    error_reporting(E_ALL);
ini_set('display_errors',1);

include_once "./vendor/autoload.php";
use Firebase\JWT\JWT;


$username = "username";
$password = "password";

	$data = array(
    'exp' => time() + (360 * 30),
    'iat' => time(),
    'username' => $username,
    'password' => $password
	);

echo "encoded jwt: " . "<br>";
?>
