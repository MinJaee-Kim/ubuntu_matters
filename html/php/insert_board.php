<?php
    error_reporting(E_ALL);
    ini_set('display_errors',1);

    $con = mysqli_connect("localhost", "root", "root1234!", "view_matzip");
    mysqli_query($con,'SET NAMES utf8');

    $bo_title = $_POST["bo_title"];
    $bo_cont = $_POST["bo_cont"];


    $statement = mysqli_prepare($con, "INSERT INTO board(bo_title, bo_cont, nowdate) VALUES (?,?,NOW())");
    mysqli_stmt_bind_param($statement, "ss", $bo_title, $bo_cont);
    mysqli_stmt_execute($statement) or die('this user is already in use') ;

    mysqli_commit($con);

    $response = array();
    $response["success"] = true;

    echo json_encode($response);
?>
