<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
$con = mysqli_connect("localhost", "root", "root1234!", "view_matzip");
mysqli_query($con,'SET NAMES utf8');

require 'vendor/autoload.php';
use \Firebase\JWT\JWT;
$secret_key = "this-is-the-secret";

$username = $_POST["username"];

$statement = mysqli_prepare($con, "SELECT id, password FROM member WHERE username = ?");
    mysqli_stmt_bind_param($statement, "s", $username);
    mysqli_stmt_execute($statement);


    mysqli_stmt_store_result($statement);
    mysqli_stmt_bind_result($statement,$id, $password);

    $userdata = array();

    while(mysqli_stmt_fetch($statement)) {
        $userdata["id"] = $id;
        $userdata["password"] = $password;
    }

$data = array(
    'exp' => time() + (360 * 30),
    'iat' => time(),
    'username' => $username,
    'password' => $userdata["password"]
);

$jwt = JWT::encode($data, $secret_key);
echo "encoded jwt: " . $jwt . "<br>";

$statement = mysqli_prepare($con, "INSERT INTO token(token, seq, isusing, create_date, expire_date) VALUES (?,?,'Y',?,?)");
    mysqli_stmt_bind_param($statement, "siii", $jwt, $userdata["id"], $data['iat'], $data['exp']);
    mysqli_stmt_execute($statement) or die('this user is already in use') ;

    mysqli_commit($con);

    $response = array();
    $response["success"] = true;

    echo json_encode($response);

?>
