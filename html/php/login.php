<?php
    error_reporting(E_ALL);
    ini_set('display_errors',1);
    $con = mysqli_connect("localhost", "root", "root1234!", "view_matzip");
    mysqli_query($con,'SET NAMES utf8');

    $username = $_POST["username"];

    $statement = mysqli_prepare($con, "SELECT * FROM member WHERE username = ?");
    mysqli_stmt_bind_param($statement, "s", $username);
    mysqli_stmt_execute($statement);


    mysqli_stmt_store_result($statement);
    mysqli_stmt_bind_result($statement,$id, $username, $password, $nickname, $user_photo_url, $status_message, $authority, $enabled);

    $response = array();
    $response["success"] = false;

    while(mysqli_stmt_fetch($statement)) {
        $response["success"] = true;
        $response["success"] = true;
        $response["username"] = $username;
        $response["password"] = $password;
        $response["nickname"] = $nickname;
        $response["user_photo_url"] = $user_photo_url;
        $response["status_message"] = $status_message;
        $response["authority"] = $authority;
        $response["enabled"] = $enabled;
    }

    echo json_encode($response);
?>
